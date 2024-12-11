<?php
include 'header.php';
require_once '../includes/clients.inc.php';
?>
<div class="container-md mt-5">
    <!-- Edit Form -->
    <div>
        <h1>Edit Client Details</h1>
    </div>
    <ul class="nav nav-tabs">
        <li class="nav-item active"><a class="nav-link active" data-toggle="tab" href="#general" id="general_tab">General</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#clients" id="contacts_edit_tab">Contacts</a></li>
    </ul>
    <div class="tab-content">
        <div id="general" class="tab-pane active">

            <!-- Default Form -->
            <form action="" method="post" id="contact_edit">
                <div class="mb-3">
                    <label for="contact_name" class="form-label">Client Name</label>
                    <input type="text" class="form-control" id="client_name" name="contact_name" placeholder="Enter contact name" readonly>
                </div>
                <div class="mb-3">
                    <label for="contact_surname" class="form-label">Client Code</label>
                    <input type="text" class="form-control" id="client_code" name="contact_surname" placeholder="Enter contact surname" readonly>
                </div>
                <div class="mb-3" style="display: none;">
                    <label for="client_id_edit" class="form-label">ID</label>
                    <input type="text" class="form-control" id="client_id_edit" name="client_id" placeholder="Enter contact surname">

                </div>

                <button type="submit" class="btn btn-primary" name="submit" id="update_contact">Save Contact</button>
                <!-- <button type="button" class="btn btn-success" name="submit" style="display: none;" data-toggle="modal" data-target="#exampleModalCenter" id="modalTriggerButton">Link to a client</button> -->

                <!-- <button type="submit" class="btn btn-success" name="" style="display: none;" id="modalTriggerButton">Link to a contact</button> -->
            </form>
            <div id="error-container" class="error-container" style="color: red; font-size:14px; margin: 5px 0;"></div>


        </div>


        <div id="clients" class="tab-pane fade">
            <div class="modal contactsModal fade modal-lg" id="contactsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Contacts</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body modal-lg bd-example-modal-lg">
                            <div class="container-md">
                                <!-- Search Field -->
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="searchContacts" placeholder="Search by name or code...">
                                </div>
                                <!-- Client Table -->
                                <form action="" method="post" id="linking_form" class="form">
                                    <!-- Hidden input for contact_id -->
                                    <input type="" name="client_id" value="" id="client_id_input" style="display: none;">
                                    <table class="table table-striped table-bordered" id="contactsTable">
                                        <tbody>
                                            <tr>
                                                <td colspan="4">No contacts found.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="save_link" data-toggle="modal">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="floating_button_container" style="float: inline-end; margin: 1em 0">
                <button class="btn btn-primary" id="editModalTriggerButton" data-toggle="modal" data-target="#contactsModal">Link New Contact</button>
            </div>
            <div id="contacts_table_container">

                <table class="table">
                    <p>No client(s) found.</p>
                </table>
            </div>

        </div>
    </div>


</div>
<script src="../scripts/clients/fetch-client-by-id.js"></script>
<script src="../scripts/contacts/update-contact.js"></script>
<script src="../scripts/clients/components/client-contact-edit.js"></script>
<script src="../scripts/clients/launch-edit-modal.js"></script>
<script src="../scripts/clients/components/linked-contacts-table.js"></script>
<script src="../scripts/clients/save-selected-contacts.js"></script>
<script src="../scripts/helper-functions/delete-link.js"></script>
<script src="../scripts/helper-functions/error-handlers.js"></script>
<script src="../scripts/clients/search-for-available-contacts.js"></script>

<script>
    // document.addEventListener('DOMContentLoaded', () => {

    // });



    async function ConfirmDelete(client_id, contact_id) {
        console.log("IDS RECIEVED", client_id, contact_id);
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

            console.log("inside")
            const result = await response.json();
            console.log("inside", result)

            if (result.deleted === true) {
                alert('Link has been deleted');
            } else {
                console.error("Server Error:", result.message);
            }
        } catch (error) {
            console.error("An unexpected error occurred:", error);

        }

    }
</script>
<?php include 'footer.php'; ?>