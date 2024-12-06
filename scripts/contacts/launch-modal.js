document
  .getElementById("modalTriggerButton")
  .addEventListener("click", async function () {
    console.log("clicked");
    const contactIdInput = document.getElementById("contact_id_input");
    if (!contactIdInput || !contactIdInput.value) {
      alert("contact ID is required!");
      return;
    }
    const contactId = contactIdInput.value;
    console.log("Client ID:", contactId);
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
        const tableBody = document.querySelector(".form #contactsTable tbody");
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
  });

document
  .getElementById("updateDetailsModal")
  .addEventListener("click", async function () {
    
  });
