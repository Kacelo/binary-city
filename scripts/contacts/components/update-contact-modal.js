function launchUserUpdateModal(contact_id) {
  const modal = document.createElement("updateModal");
  modal.innerHTML = `
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Update Contact Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="contactDetailsForm">
            <input type="hidden" id="contact_id" name="contact_id" value="">
            <div class="form-group">
              <label for="contact_name">Contact Name</label>
              <input type="text" class="form-control" id="contact_name" name="contact_name" required>
            </div>
            <div class="form-group">
              <label for="contact_surname">Contact Surname</label>
              <input type="text" class="form-control" id="contact_surname" name="contact_surname" required>
            </div>
            <div class="form-group">
              <label for="contact_email">Contact Email</label>
              <input type="email" class="form-control" id="contact_email" name="contact_email" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="saveContactDetails">Save Changes</button>
        </div>
      </div>
    </div>
  </div>
    `;
  const div = document.createElement("div");

  div.appendChild(modal);
}

// function fetchContactDetails(contactId) {
//   try {
//     const response = await fetch(
//         `../includes/fetch-available-clients.inc.php?contact_id=${encodeURIComponent(
//           contactId
//         )}`
//       );
//   } catch (error) {
    
//   }
// }

function displayUpdateModal(contact_name, contact_surname, contact_email, contact_id) {
  document.addEventListener("click", async (event) => {
    if (event.target.classList.contains("launchContactDetailsUpdate")) {
      const contactId = event.target.getAttribute("data-contact-id");

      try {

        // Render modal in the container
        const modalContainer = document.getElementById("contactDetailsUpdate");
        modalContainer.innerHTML =
          document.getElementById("modalTemplate").innerHTML;

        // Fill form with fetched details
        document.getElementById("contact_id").value = contactId;
        document.getElementById("contact_name").value = contact_name;
        document.getElementById("contact_surname").value =contact_surname;
        document.getElementById("contact_email").value = contact_email;

        // Show the modal
        $("#exampleModalCenter").modal("show");
      } catch (error) {
        console.error("Failed to fetch contact details:", error);
        alert("Error fetching contact details.");
      }
    }
  });
}
// Save contact details
document.addEventListener("click", (event) => {
    if (event.target.id === "saveContactDetails") {
      const form = document.getElementById("contactDetailsForm");
      if (form.checkValidity()) {
        const formData = new FormData(form);

        // Simulate saving data (replace this with an actual API call)
        console.log("Saving contact details:", Object.fromEntries(formData));
        alert("Contact details saved successfully!");

        // Hide the modal
        $("#exampleModalCenter").modal("hide");
      } else {
        form.reportValidity();
      }
    }
  });
