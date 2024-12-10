async function ConfirmDelete(client_id, contact_id) {
    alert('Are you sure want to delete this client link ?');
    try {
        const response = await fetch('../includes/unlink-contact-client.inc.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                client_id: client_id,
                contact_id: contact_id
            })
        });
        const result = await response.json();
        if (result.deleted === true) {
            alert('Link has been deleted');
        } else {
            console.error("Server Error:", result.message);
        }
    } catch (error) {
        console.error("An unexpected error occurred:", error);

    }

}
