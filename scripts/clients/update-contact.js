document
  .getElementById("contact_edit")
  .addEventListener("submit", async function (e) {
    e.preventDefault(); // Prevent the default form submission
    const formData = new FormData(this); // Collect form data
    console.log("this:", formData);

    try {
      const response = await fetch("../includes/update-contact-details.php", {
        method: "POST",
        body: formData,
      });
      const result = await response.json(); // Parse JSON response
      console.log("Result", result);
      if (result[0].success === true) {
        alert("Contact Has been Updated Successfully");
        const contactEmailInput = document.getElementById("contact_email");
        const contactNameInput = document.getElementById("contact_name");
        const contactSurnameInput = document.getElementById("contact_surname");
      } else if (result.errors) {
        displayErrors(result.errors);
      } else {
        console.error("Failed response:", result);
        alert(result[0].message || "Submission failed.");
      }
    } catch (error) {
      console.error("An error occurred:", error);
      alert("An unexpected error occurred. Please try again.");
    }
  });
