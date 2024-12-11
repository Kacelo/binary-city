document.addEventListener("DOMContentLoaded", async () => {
  const urlParams = new URLSearchParams(window.location.search);
  const contactEmail = urlParams.get("contact_email"); // or extract from path
  console.log("I am here", contactEmail);
  if (contactEmail) {
    try {
      const response = await fetch(
        `../includes/fetch-contact-by-email.inc.php?contact_email=${encodeURIComponent(
          contactEmail
        )}`
      );
      if (!response.ok) {
        console.error(
          "Failed to fetch contact details:",
          response.status,
          response.statusText
        );
        alert("Error fetching contact details. Please try again.");
        return;
      }
      console.log(response);
      const data = await response.json();

      console.log("data", data);

      if (data.status === "success") {
        document.getElementById("contact_name").value =
          data.contact.contact_name;
        document.getElementById("contact_surname").value =
          data.contact.contact_surname;
        document.getElementById("contact_email").value =
          data.contact.contact_email;
        const id = document.getElementById("contact_id_edit").value =
        data.contact.contact_id;

        console.log('where is the ID?', id)

      }
    } catch (error) {
      console.error("Error fetching contact details:", error);
    }
  } else {
    alert("No contact ID provided in URL.");
  }
});
