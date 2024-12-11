document.getElementById('contact_create').addEventListener('submit', async function(e) {
    e.preventDefault(); // Prevent the default form submission
    const formData = new FormData(this); // Collect form data
    console.log("this:", formData)

    try {
        // AJAX
        const response = await fetch('../includes/create-contacts.inc.php', {
            method: 'POST',
            body: formData,
        });

        const result = await response.json(); // Parse JSON response
        console.log("Result", result)

        if (result.status === 'success') {

            const contactEmailInput = document.getElementById('contact_email');
            const contactNameInput = document.getElementById('contact_name');
            const contactSurnameInput = document.getElementById('contact_surname');

            const saveClientBtn = document.getElementById('save_client');
            const linkClientBtn = document.getElementById('modalTriggerButton');
            const errorContainer = document.getElementById("error-container");
            errorContainer.innerHTML = "";
            if (contactEmailInput && contactNameInput && contactSurnameInput) {
                contactEmailInput.value = result.data.data.contact_email;
                contactNameInput.value = result.data.data.contact_name;
                contactSurnameInput.value = result.data.data.contact_surname

                linkClientBtn.style = "display: visible";
                saveClientBtn.style = "display:none";
            } else {
                console.error('Input with ID "disabledTextInput" not found.');
            }

            const contactIdInput = document.getElementById('contact_id_input');
            if (contactIdInput) {
                console.log("data res", contactIdInput, result.data.data.contact_id)
                contactIdInput.value = result.data.data.contact_id;
            }
        } else if (result.errors) {
            displayErrors(result.errors)
        } else {
            console.error('Failed response:', result);
            alert(result.message || 'Submission failed.');
        }
    } catch (error) {
        console.error('An error occurred:', error);
        alert('An unexpected error occurred. Please try again.');
    }
});