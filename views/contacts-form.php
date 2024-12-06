<?php
include 'header.php';
require_once '../includes/clients.inc.php';
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
                    <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Enter contact name">
                </div>
                <div class="mb-3">
                    <label for="contact_surname" class="form-label">Surname</label>
                    <input type="text" class="form-control" id="contact_surname" name="contact_surname" placeholder="Enter contact surname">
                </div>
                <div class="mb-3">
                    <label for="contact_email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Enter contact email">
                </div>
                <button type="submit" class="btn btn-primary" name="submit" id="save_client">Save Contact</button>
                <button type="button" class="btn btn-success" name="submit" style="display: none;" data-toggle="modal" data-target="#exampleModalCenter" id="modalTriggerButton">Link to a client</button>

                <!-- <button type="submit" class="btn btn-success" name="" style="display: none;" id="modalTriggerButton">Link to a contact</button> -->
            </form>
            <div id="error-container" class="error-container" style="color: red; font-size:14px; margin: 5px 0;"></div>


        </div>

        <div id="menu1" class="tab-pane fade">
            <div id="contacts_table_container">
                <table class="table">
                    <p>No client(s) found.</p>
                </table>
            </div>

        </div>
    </div>

</div>
<script src="../scripts/contacts/add-new-contact.js"></script>
<script src="../scripts/contacts/launch-modal.js"></script>
<script src="../scripts/contacts/components/linked-clients-table.js"></script>
<script src="../scripts/contacts/save-selected-clients.js"></script>
<script src="../scripts/helper-functions/delete-link.js"></script>
<script src="../scripts/helper-functions/error-handlers.js"></script>
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