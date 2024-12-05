function renderContactsTable(contacts, clientId) {
  const tableContainer = document.getElementById("contacts_table_container");

  // Clear previous content
  tableContainer.innerHTML = "";

  if (contacts.length > 0) {
    // Create table element
    const table = document.createElement("table");
    table.className = "table table-bordered";

    // Create table header
    const thead = document.createElement("thead");
    thead.innerHTML = `
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th></th>
        </tr>
    `;
    table.appendChild(thead);

    // Create table body
    const tbody = document.createElement("tbody");

    contacts.forEach((contact) => {
      const row = document.createElement("tr");
      row.innerHTML = `
            <td>${contact.full_name}</td>
            <td>${contact.contact_email}</td>
            <td><a onclick="return ConfirmDelete(${clientId.value},${contact.contact_id});" class="" id="unlinkClient">Unlink Contact</a></td>
        `;
      tbody.appendChild(row);
    });

    table.appendChild(tbody);
    tableContainer.appendChild(table); // Append table to the container
  } else {
    tableContainer.innerHTML = "<p>No contacts found.</p>";
  }
}

document
  .getElementById("contacts_tab")
  .addEventListener("click", async function () {
    const clientId = document.getElementById("client_id_input");
    if (clientId.value !== 0) {
      try {
        const response = await fetch(
          "../includes/fetch-linked-contacts.inc.php",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              client_id: clientId.value,
            }),
          }
        );
        const result = await response.json();
        console.log("Response from server:", result);

        if (result.status === "success") {
          console.log("Contacts:", result.linkedContacts);
          // You can now populate the modal or a table with the contacts
          const contacts = result.linkedContacts;
          renderContactsTable(contacts, clientId); // Example: Update a table or modal with the fetched data
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
