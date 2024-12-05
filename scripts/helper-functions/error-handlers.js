function displayErrors(errors) {
    if (Object.keys(errors).length > 0) {
        const errorContainer = document.getElementById("error-container");
        errorContainer.innerHTML = "";

        // Iterate through the errors object
        for (const [field, message] of Object.entries(errors)) {
            const errorRow = document.createElement("div");
            errorRow.innerHTML = `<p>${message}</p>`;
            errorRow.className = "form-error";
            errorContainer.appendChild(errorRow);
        }
    }
}