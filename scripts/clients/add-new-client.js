
//
document.getElementById('client_create').addEventListener('submit', async function(e) {
    e.preventDefault(); // Prevent the default form submission

    const formData = new FormData(this); // Collect form data

    // Log FormData contents
    for (const [key, value] of formData.entries()) {
        console.log(`${key}: ${value}`);
    }
    try {
        // AJAX
        const response = await fetch('../includes/clients-create.inc.php', {
            method: 'POST',
            body: formData,
        });

        const result = await response.json(); // Parse JSON response

        if (result.status === 'success') {
            const clientCodeInput = document.getElementById('disabledTextInput');
            const clientNameInput = document.getElementById('client_name');
            const saveClientBtn = document.getElementById('save_client');
            const linkClientBtn = document.getElementById('modalTriggerButton');
            const errorContainer = document.getElementById("error-container");
            errorContainer.innerHTML = ""; 
            if (clientCodeInput && clientNameInput) {
                clientCodeInput.value = result.data.client_code;
                clientNameInput.value = result.data.client_name;
                linkClientBtn.style = "display: visible";
                saveClientBtn.style = "display:none";
            } else {
                console.error('Input with ID "disabledTextInput" not found.');
            }

            const clientIdInput = document.getElementById('client_id_input');
            if (clientIdInput) {
                clientIdInput.value = result.data.client_id;
            }
        } else if (result.errors) {
            displayErrors(result.errors)
        } else {
            console.error('Failed response:', result);
            alert(result.message || 'Submission failed.');
        }
    } catch (error) {
        console.error('An error occurred:', error);
    }
});