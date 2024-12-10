function renderClientsTable(clients, contactId) {
  const tableContainer = document.getElementById("contacts_table_container");
  
  // Clear previous content
  tableContainer.innerHTML = "";

  if (clients.length > 0) {
    // Create table element
    const table = document.createElement("table");
    table.className = "table table-bordered";

    // Create table header
    const thead = document.createElement("thead");
    thead.innerHTML = `
          <tr>
              <th>Client Name</th>
              <th>Client Code</th>
              <th></th>
          </tr>
      `;
    table.appendChild(thead);

    // Create table body
    const tbody = document.createElement("tbody");
    clients.forEach((client) => {
      const row = document.createElement("tr");
      row.innerHTML = `
              <td>${client.client_name}</td>
              <td>${client.client_code}</td>
              <td><a onclick="return ConfirmDelete(${client.client_id},${contactId.value});" class="" id="unlinkClient">Unlink Client</a></td>
          `;
      tbody.appendChild(row);
    });

    table.appendChild(tbody);
    tableContainer.appendChild(table); // Append table to the container
  } else {
    tableContainer.innerHTML = "<p>No clients found.</p>";
  }
}

document
  .getElementById("clients_edit_tab")
  .addEventListener("click", async function () {
    const contactId = document.getElementById("contact_id_edit");
    console.log("contact ID", contactId);
    if (contactId.value !== 0) {
      try {
        const response = await fetch(
          "../includes/fetch-linked-clients.inc.php",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              contact_id: contactId.value,
            }),
          }
        );
        const result = await response.json();
        console.log("Response from server:", result);

        if (result.status === "success") {
          console.log("Contacts:", result);
          // You can now populate the modal or a table with the contacts
          const clients = result.linkedClients;
          console.log(clients)
          renderClientsTable(clients, contactId); // Example: Update a table or modal with the fetched data
          // populateContactsTable(result.data);
        } else {
          console.error("Server Error:", result.message);
          // alert(result.message || "An error occurred while fetching contacts.");
        }
      } catch (error) {
        console.error("An unexpected error occurred:", error);
        // alert("An unexpected error occurred. Please try again.");
      }
    }
  });
