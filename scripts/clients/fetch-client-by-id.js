document.addEventListener("DOMContentLoaded", async () => {
  const urlParams = new URLSearchParams(window.location.search);
  const client_id = urlParams.get("client_id"); // or extract from path
  console.log("I am here", client_id);
  if (client_id) {
    try {
      const response = await fetch(
        `../includes/fetch-client-by-id.inc.php?client_id=${encodeURIComponent(
          client_id
        )}`
      );
      if (!response.ok) {
        console.error(
          "Failed to fetch client details:",
          response.status,
          response.statusText
        );
        alert("Error fetching client details. Please try again.");
        return;
      }
      console.log(response);
      const data = await response.json();

      console.log("data", data);

      if (data.status === "success") {
        document.getElementById("client_name").value =
          data.client.client_name;
        document.getElementById("client_code").value =
          data.client.client_code;
        const id = document.getElementById("client_id_edit").value =
        data.client.client_id;

        console.log('where is the ID?', id)

      }
    } catch (error) {
      console.error("Error fetching client details:", error);
    }
  } else {
    alert("No client ID provided in URL.");
  }
});
