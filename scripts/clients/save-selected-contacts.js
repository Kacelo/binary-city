document.getElementById("save_link").addEventListener('click', async function() {
    const clientId = document.getElementById("client_id_input");
    const selectedContacts = Array.from(document.querySelectorAll('#contactsTable input[type="checkbox"]:checked'))
        .map(checkbox => checkbox.value);
    if (selectedContacts.length === 0) {
        alert('No contacts selected.');
        return;
    }
    try {

        const response = await fetch('../includes/link-clients-to-contacts.inc.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                client_id: clientId.value,
                contact_ids: selectedContacts,
            }),
        });

        if (response.status === 200) {
            alert('Contacts linked successfully!');
            $('#exampleModalCenter').modal('hide');
        } else {
            alert(result.message || 'Failed to link contacts.');
        }
    } catch (error) {
        console.log(error)
    }
})