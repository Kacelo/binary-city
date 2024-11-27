<?php
include 'header.php';
require_once '../includes/clients.inc.php';
// require_once '../includes/contacts-create.inc.php';

// session_start();
?>
<div class="container-md mt-5">
    <h1>Create a new client</h1>
    <ul class="nav nav-tabs">
        <li class="nav-item active"><a class="nav-link active" data-toggle="tab" href="#home">General</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1" id="contacts_tab">Contacts</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane active">
            <div class="modal contactsModal fade modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Contacts</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body modal-lg bd-example-modal-lg">
                            <div class="container-md mt-5">
                                <form action="" method="post" id="linking_from" class="form">
                                    <!-- Hidden input for client_id -->
                                    <input type="hidden" name="client_id" value="" id="client_id_input">
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
            <form action="" method="post" id="client_create">
                <div class="mb-3">
                    <label for="client_name" class="form-label">Client Name</label>
                    <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Enter client name" required>
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Client Code</label>
                    <input type="text" id="disabledTextInput" class="form-control" value="" placeholder="Client Code" readonly>
                </div>
                <button type="submit" class="btn btn-primary" name="submit" id="save_client">Save Client</button>
                <button type="button" class="btn btn-success" name="submit" style="display: none;" data-toggle="modal" data-target="#exampleModalCenter" id="modalTriggerButton">Link to a contact</button>

                <!-- <button type="submit" class="btn btn-success" name="" style="display: none;" id="modalTriggerButton">Link to a contact</button> -->
            </form>
        </div>

        <div id="menu1" class="tab-pane fade">
            <div id="contacts_table_container">
                <table class="table">
                    <td colspan="4"></td>
                    <P>No contact(s) found.</P>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
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
                console.log(result)
                const clientCodeInput = document.getElementById('disabledTextInput');
                const clientNameInput = document.getElementById('client_name');
                const saveClientBtn = document.getElementById('save_client');
                const linkClientBtn = document.getElementById('modalTriggerButton');
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
        const clientIdInput = document.getElementById('client_id_input');

        if (!clientIdInput || !clientIdInput.value) {
            alert("Client ID is required!");
            return;
        }

        const clientId = clientIdInput.value;
        console.log("Client ID:", clientId);

        try {
            // get request to pass ID as parameter to fetch availabe contacts
            const response = await fetch(`../includes/fetch-available-contacts.inc.php?client_id=${encodeURIComponent(clientId)}`);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const contacts = await response.json();
            console.log("Available contacts:", contacts.availableContacts);

            if (contacts.availableContacts && contacts.availableContacts.length > 0) {
                const tableBody = document.querySelector('.form #contactsTable tbody');
                tableBody.innerHTML = ''; // Clear existing rows

                contacts.availableContacts.forEach(contact => {
                    const row = document.createElement('tr');
                    console.log(contact);
                    row.innerHTML = `
                    <td>${contact.contact_name}</td>
                    <td>${contact.contact_email}</td>
                    <td><input type="checkbox" class="form-check-input" value="${contact.contact_id}"></td>
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
        const clientId = document.getElementById("client_id_input");
        // console.log(clientId.value)
        const selectedContacts = Array.from(document.querySelectorAll('#contactsTable input[type="checkbox"]:checked'))
            .map(checkbox => checkbox.value);
        console.log(selectedContacts)
        if (selectedContacts.length === 0) {
            alert('No contacts selected.');
            return;
        }
        try {
            console.log("before:")

            const response = await fetch('../includes/link-contacts.inc.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    client_id: clientId.value,
                    contact_ids: selectedContacts,
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
        const clientId = document.getElementById("client_id_input");
        if (clientId.value !== 0) {
            try {
                const response = await fetch("../includes/fetch-linked-contacts.inc.php", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        client_id: clientId.value,
                    }),
                })
                console.log("response:", clientId.value)

                // console.log(response)
                // if (!response.ok) {
                //     console.error("Error fetching contacts:", response.statusText);
                //     alert("Failed to fetch contacts. Please try again.");
                //     return;
                // }
                const result = await response.json();
                console.log("Response from server:", result);

                if (result.status === "success") {
                    console.log("Contacts:", result.linkedContacts);
                    // You can now populate the modal or a table with the contacts
                    const contacts = result.linkedContacts;
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

    function deleteContact(client_id) {

    }

    function renderContactsTable(contacts) {
        const tableContainer = document.getElementById("contacts_table_container");

        // Clear previous content
        tableContainer.innerHTML = "";

        if (contacts.length > 0) {
            // Create table element
            const table = document.createElement("table");
            table.className = "table table-bordered";

            // Create table header
            const thead = document.createElement("thead");
            thead.innerHTML = `
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        `;
            table.appendChild(thead);

            // Create table body
            const tbody = document.createElement("tbody");

            contacts.forEach(contact => {
                const row = document.createElement("tr");
                row.innerHTML = `
                <td>${contact.full_name}</td>
                <td>${contact.contact_email}</td>
                <td><a href="#" class="btn btn-primary btn-sm">Click Me</a></td>
            `;
                tbody.appendChild(row);
            });

            table.appendChild(tbody);
            tableContainer.appendChild(table); // Append table to the container
        } else {
            tableContainer.innerHTML = "<p>No contacts found.</p>";
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