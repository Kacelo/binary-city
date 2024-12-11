document
  .getElementById("editModalTriggerButton")
  .addEventListener("click", async function () {
    console.log("clicked edit");
    const clientIdInput = document.getElementById("client_id_edit");
    const contactIdInput = document.getElementById("client_id_input");

    console.log("client ID:", clientIdInput.value, contactIdInput);
    if (!clientIdInput || !clientIdInput.value) {
      alert("contact ID is required!");
      return;
    }
    const clientId = clientIdInput.value;
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
      console.log("Response:", contacts);
      if (contacts.availableContacts && contacts.availableContacts.length > 0) {
        const contactIdInput = document.getElementById("client_id_input");
        if (contactIdInput) {
          console.log("data res")
          contactIdInput.value = clientId;
        }
        const tableBody = document.querySelector(".form #contactsTable tbody");
        tableBody.innerHTML = ""; // Clear existing rows
        console.log(tableBody);
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
        //   document.getElementById("contactsModal").style.display = "block";
      } else {
        alert("No available contacts found.");
      }
    } catch (error) {
      console.error("Error fetching contacts:", error);
    }
  });
