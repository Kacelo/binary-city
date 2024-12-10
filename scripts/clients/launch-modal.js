document.getElementById('modalTriggerButton').addEventListener('click', async function() {
    const clientIdInput = document.getElementById('client_id_input');

    if (!clientIdInput || !clientIdInput.value) {
        alert("Client ID is required!");
        return;
    }

    const clientId = clientIdInput.value;

    try {
        // get request to pass ID as parameter to fetch availabe contacts
        const response = await fetch(`../includes/fetch-available-contacts.inc.php?client_id=${encodeURIComponent(clientId)}`);
        console.log('response', response)
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const contacts = await response.json();

        if (contacts.availableContacts && contacts.availableContacts.length > 0) {
            const tableBody = document.querySelector('.form #contactsTable tbody');
            tableBody.innerHTML = ''; // Clear existing rows

            contacts.availableContacts.forEach(contact => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${contact.contact_name}</td>
                <td>${contact.contact_email}</td>
                <td><input type="checkbox" class="form-check-input" value="${contact.contact_id}"></td>
            `;
                tableBody.appendChild(row);
            });

            // Show the modal
            document.getElementById('contactsModal').style.display = 'block';
        } else {
            alert('No available contacts found.');
        }
    } catch (error) {
        console.error("Error fetching contacts:", error);
    }
});