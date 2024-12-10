document.getElementById("save_link").addEventListener('click', async function() {
    const contactId = document.getElementById("contact_id_input");
    const selectedClients = Array.from(document.querySelectorAll('#contactsTable input[type="checkbox"]:checked'))
        .map(checkbox => checkbox.value);
    console.log(selectedClients)
    if (selectedClients.length === 0) {
        alert('No contacts selected.');
        return;
    }
    console.log("Contact Id:", contactId.value, 'selected clients:', selectedClients)

    try {
        console.log("before:")

        const response = await fetch('../includes/link-contact-to-client.inc.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                contact_id: contactId.value,
                client_ids: selectedClients,
            }),
        });
        console.log("response:", response.status)
        if (response.status === 200) {
            alert('Clients linked successfully!');
            $('#clientsModal').modal('hide');
        } else {
            alert(result.message || 'Failed to link contacts.');
        }
    } catch (error) {
        console.log(error)
    }
})