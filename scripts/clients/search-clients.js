document.addEventListener("DOMContentLoaded", () => {
    const searchField = document.getElementById("searchContacts");
    const tableBody = document.querySelector(".form #contactsTable tbody");
  
    searchField.addEventListener("input", async () => {
      const clientIdInput = document.getElementById("client_id_input");
      const clientId = clientIdInput.value;
      console.log("contactId:", clientId);
      const searchTerm = searchField.value.trim();
      console.log(searchTerm);
      if (searchTerm.length >= 2) {
        console.log("returning searched");
  
        try {
          const response = await fetch(
            `../includes/search-unlinked-contacts.inc.php?client_id=${encodeURIComponent(
              clientId
            )}&search_term=${encodeURIComponent(searchTerm)}`
          );
          const data = await response.json();
          console.log("DATA:", data, clientId);
          if (data.status === "success") {
            populateTable(data.searchResults);
          } else {
            tableBody.innerHTML = `<tr><td colspan="4">${
              data.message || "No contacts found."
            }</td></tr>`;
          }
        } catch (error) {
          console.error("Error fetching contacts:", error);
          tableBody.innerHTML = `<tr><td colspan="4">Error fetching contacts.</td></tr>`;
        }
      } else if (searchTerm.length >= 1) {
        tableBody.innerHTML = `<tr><td colspan="4">Type at least 2 characters to search.</td></tr>`;
      } else if (searchTerm.length == 0) {
        console.log("returning available");
        try {
          const response = await fetch(
            `../includes/fetch-available-contacts.inc.php?client_id=${encodeURIComponent(
              clientId
            )}`
          );
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          const contacts = await response.json();
          console.log("Response:", contacts.availableContacts);
          if (contacts.availableContacts && contacts.availableContacts.length > 0) {
            const tableBody = document.querySelector(
              ".form #contactsTable tbody"
            );
            tableBody.innerHTML = ""; // Clear existing rows
  
            contacts.availableContacts.forEach((contact) => {
              const row = document.createElement("tr");
              console.log(contact);
              row.innerHTML = `
                        <td>${contact.contact_name}</td>
                        <td>${contact.contact_surname}</td>
                        <td>${contact.contact_email}</td>
                        <td><input type="checkbox" class="form-check-input" value="${contact.contact_id}"></td>
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
    function populateTable(contacts) {
      console.log("results", contacts);
      if (contacts.length > 0) {
        const tableBody = document.querySelector(".form #contactsTable tbody");
        tableBody.innerHTML = "";
        contacts.map((contact) => {
          const row = document.createElement("tr");
          console.log("contact:", contact);
          row.innerHTML = `
                   <td>${contact.contact_name}</td>
                        <td>${contact.contact_surname}</td>
                        <td>${contact.contact_email}</td>
                        <td><input type="checkbox" class="form-check-input" value="${contact.contact_id}"></td>
                `;
          tableBody.appendChild(row);
        });
      } else {
        tableBody.innerHTML = `<tr><td colspan="4">No clients found.</td></tr>`;
      }
    }
  });
  