<?php
include 'header.php';
require_once '../includes/clients.inc.php';
// require_once '../includes/contacts-create.inc.php';

// session_start();
?>
<div class="container-md mt-5">
    <h1>Create a new contact</h1>
    <ul class="nav nav-tabs">
        <li class="nav-item active"><a class="nav-link active" data-toggle="tab" href="#home">General</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1" id="contacts_tab">Clients</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane active">
            <div class="modal contactsModal fade modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Clients</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body modal-lg bd-example-modal-lg">
                            <div class="container-md mt-5">
                                <form action="" method="post" id="linking_from" class="form">
                                    <!-- Hidden input for client_id -->
                                    <input type="hidden" name="client_id" value="" id="contact_id_input">
                                    <table class="table table-striped-columns table-bordered" id="contactsTable">
                                        <tbody>
                                            <tr>
                                                <td colspan="4">No contacts found.</td>
                                            </tr>
                                        </tbody>

                                    </table>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" id="save_link">Save changes</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Default Form -->
            <form action="" method="post" id="contact_create">
                <div class="mb-3">
                    <label for="contact_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Enter contact name" required>
                </div>
                <div class="mb-3">
                    <label for="contact_surname" class="form-label">Surname</label>
                    <input type="text" class="form-control" id="contact_surname" name="contact_surname" placeholder="Enter contact name" required>
                </div>
                <div class="mb-3">
                    <label for="contact_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="contact_email" name="contact_email" placeholder="Enter contact email" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit" id="save_client">Save Contact</button>
                <button type="button" class="btn btn-success" name="submit" style="display: none;" data-toggle="modal" data-target="#exampleModalCenter" id="modalTriggerButton">Link to a contact</button>

                <!-- <button type="submit" class="btn btn-success" name="" style="display: none;" id="modalTriggerButton">Link to a contact</button> -->
            </form>
        </div>

        <div id="menu1" class="tab-pane fade">
            <div id="contacts_table_container">
                <table class="table">
                <p>No Contact(s) found.</p>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('contact_create').addEventListener('submit', async function(e) {
        e.preventDefault(); // Prevent the default form submission

        const formData = new FormData(this); // Collect form data

        // Log FormData contents
        for (const [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }
        try {
            // AJAX
            const response = await fetch('../includes/create-contacts.inc.php', {
                method: 'POST',
                body: formData,
            });

            const result = await response.json(); // Parse JSON response

            if (result.status === 'success') {
                console.log("Result",result)

                const contactEmailInput = document.getElementById('contact_email');
                const contactNameInput = document.getElementById('contact_name');
                const contactSurnameInput = document.getElementById('contact_surname');

                const saveClientBtn = document.getElementById('save_client');
                const linkClientBtn = document.getElementById('modalTriggerButton');
                console.log("ress",result.data.contact_id)
                console.log(contactEmailInput, contactNameInput, contactSurnameInput);

                if (contactEmailInput && contactNameInput && contactSurnameInput) {
                    contactEmailInput.value = result.data.data.contact_email;
                    contactNameInput.value = result.data.data.contact_name;
                    contactSurnameInput.value =  result.data.data.contact_surname
                    console.log("ress", contactSurnameInput )

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
            } else {
                console.error('Failed response:', result);
                alert(result.message || 'Submission failed.');
            }
        } catch (error) {
            console.error('An error occurred:', error);
            alert('An unexpected error occurred. Please try again.');
        }
    });
    // document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('modalTriggerButton').addEventListener('click', async function() {
        console.log("clicked");
        const contactIdInput = document.getElementById('contact_id_input');
        if (!contactIdInput || !contactIdInput.value) {
            alert("contact ID is required!");
            return;
        }
        const contactId = contactIdInput.value;
        console.log("Client ID:", contactId);
        try {
            const response = await fetch(`../includes/fetch-available-clients.inc.php?contact_id=${encodeURIComponent(contactId)}`);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const contacts = await response.json();
            console.log("Response:", contacts.availableClients);
            if (contacts.availableClients && contacts.availableClients.length > 0) {
                const tableBody = document.querySelector('.form #contactsTable tbody');
                tableBody.innerHTML = ''; // Clear existing rows

                contacts.availableClients.forEach(contact => {
                    const row = document.createElement('tr');
                    console.log(contact);
                    row.innerHTML = `
                    <td>${contact.client_name}</td>
                    <td>${contact.client_code}</td>
                    <td><input type="checkbox" class="form-check-input" value="${contact.client_id}"></td>
                `;
                    tableBody.appendChild(row);
                });

                // Show the modal
                document.getElementById('contactsModal').style.display = 'block';
            } else {
                alert('No available contacts found.');
            }
        } catch (error) {
            console.error("Error fetching contacts:", error);
        }
    });
    // });
    document.getElementById("save_link").addEventListener('click', async function() {
        const contactId = document.getElementById("contact_id_input");
        // console.log(contactId.value)
        const selectedClients = Array.from(document.querySelectorAll('#contactsTable input[type="checkbox"]:checked'))
            .map(checkbox => checkbox.value);
        console.log(selectedClients)
        if (selectedClients.length === 0) {
            alert('No contacts selected.');
            return;
        }
        try {
            console.log("before:")

            const response = await fetch('../includes/contact-to-client.inc.php', {
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

            // const result = await response.json();
            // console.log(result);
            if (response.status === 200) {
                alert('Contacts linked successfully!');
                // $('#exampleModalCenter').modal('hide');
            } else {
                alert(result.message || 'Failed to link contacts.');
            }
        } catch (error) {
            console.log(error)
        }
    })
    document.getElementById("contacts_tab").addEventListener("click", async function() {
        console.log("I have been clicked")
        const contactId = document.getElementById("contact_id_input");
        console.log(contactId)
        if (contactId.value !== 0) {
            try {
                const response = await fetch("../includes/fetch-linked-clients.inc.php", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        contact_id: contactId.value,
                    }),
                })
                console.log("response:", contactId.value)

                // console.log(response)
                // if (!response.ok) {
                //     console.error("Error fetching contacts:", response.statusText);
                //     alert("Failed to fetch contacts. Please try again.");
                //     return;
                // }
                const result = await response.json();
                console.log("Response from server:", result);

                if (result.status === "success") {
                    console.log("Contacts:", result.linkedClients);
                    // You can now populate the modal or a table with the contacts
                    const contacts = result.linkedClients;
                    renderContactsTable(contacts); // Example: Update a table or modal with the fetched data
                    // populateContactsTable(result.data);
                } else {
                    console.error("Server Error:", result.message);
                    // alert(result.message || "An error occurred while fetching contacts.");
                }
            } catch (error) {
                console.error("An unexpected error occurred:", error);
                // alert("An unexpected error occurred. Please try again.");
            }
        }

    })

    function renderContactsTable(clients) {
        const tableContainer = document.getElementById("contacts_table_container");

        // Clear previous content
        tableContainer.innerHTML = "";

        if (clients.length > 0) {
            // Create table element
            const table = document.createElement("table");
            table.className = "table table-bordered";

            // Create table header
            const thead = document.createElement("thead");
            thead.innerHTML = `
            <tr>
                <th>Cleint Name</th>
                <th>Client Code</th>
                <th></th>
            </tr>
        `;
            table.appendChild(thead);

            // Create table body
            const tbody = document.createElement("tbody");

            clients.forEach(client => {
                const row = document.createElement("tr");
                row.innerHTML = `
                <td>${client.client_name}</td>
                <td>${client.client_code}</td>
                <td><a href="#" class="btn btn-primary btn-sm">Unlink contact</a></td>
            `;
                tbody.appendChild(row);
            });

            table.appendChild(tbody);
            tableContainer.appendChild(table); // Append table to the container
        } else {
            tableContainer.innerHTML = "<p>No clients found.</p>";
        }
    }
    //     function showUser(client_id) {
    //   if (str == "") {
    //     document.getElementById("txtHint").innerHTML = "";
    //     return;
    //   } else {
    //     var xmlhttp = new XMLHttpRequest();
    //     xmlhttp.onreadystatechange = function() {
    //       if (this.readyState == 4 && this.status == 200) {
    //         document.getElementById("txtHint").innerHTML = this.responseText;
    //       }
    //     };
    //     xmlhttp.open("GET","../includes/fetch-linked-contacts.inc.php?q="+str,true);
    //     xmlhttp.send();
    //   }
    // }
</script>

<?php include 'footer.php'; ?>