document.addEventListener("DOMContentLoaded", () => {
  const searchField = document.getElementById("searchClients");
  const tableBody = document.querySelector(".form #contactsTable tbody");

  searchField.addEventListener("input", async () => {
    const contactIdInput = document.getElementById("contact_id_input");
    const contactId = contactIdInput.value;
    console.log("contactId:", contactId);
    const searchTerm = searchField.value.trim();
    console.log(searchTerm);
    if (searchTerm.length >= 2) {
      console.log("returning searched");

      try {
        const response = await fetch(
          `../includes/search-unlinked-clients.inc.php?contact_id=${encodeURIComponent(
            contactId
          )}&search_term=${encodeURIComponent(searchTerm)}`
        );
        const data = await response.json();
        console.log("DATA:", data, contactId);
        if (data.status === "success") {
          populateTable(data.searchResults);
        } else {
          tableBody.innerHTML = `<tr><td colspan="4">${
            data.message || "No clients found."
          }</td></tr>`;
        }
      } catch (error) {
        console.error("Error fetching clients:", error);
        tableBody.innerHTML = `<tr><td colspan="4">Error fetching clients.</td></tr>`;
      }
    } else if (searchTerm.length >= 1) {
      tableBody.innerHTML = `<tr><td colspan="4">Type at least 2 characters to search.</td></tr>`;
    } else if (searchTerm.length == 0) {
      console.log("returning available");
      try {
        const response = await fetch(
          `../includes/fetch-available-clients.inc.php?contact_id=${encodeURIComponent(
            contactId
          )}`
        );
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        const contacts = await response.json();
        console.log("Response:", contacts.availableClients);
        if (contacts.availableClients && contacts.availableClients.length > 0) {
          const tableBody = document.querySelector(
            ".form #contactsTable tbody"
          );
          tableBody.innerHTML = ""; // Clear existing rows

          contacts.availableClients.forEach((contact) => {
            const row = document.createElement("tr");
            console.log(contact);
            row.innerHTML = `
                      <td>${contact.client_name}</td>
                      <td>${contact.client_code}</td>
                      <td><input type="checkbox" class="form-check-input" value="${contact.client_id}"></td>
                  `;
            tableBody.appendChild(row);
          });

          // Show the modal
          document.getElementById("contactsModal").style.display = "block";
        } else {
          alert("No available contacts found.");
        }
      } catch (error) {
        console.error("Error fetching contacts:", error);
      }
    }
  });
  function populateTable(clients) {
    console.log("results", clients);
    if (clients.length > 0) {
      const tableBody = document.querySelector(".form #contactsTable tbody");
      tableBody.innerHTML = "";
      clients.map((client) => {
        const row = document.createElement("tr");
        console.log("contact:", client);
        row.innerHTML = `
                  <td>${client.client_name}</td>
                  <td>${client.client_code}</td>
                  <td><input type="checkbox" class="form-check-input" value="${client.client_id}"></td>
              `;
        tableBody.appendChild(row);
      });
    } else {
      tableBody.innerHTML = `<tr><td colspan="4">No clients found.</td></tr>`;
    }
  }
});
