<?php
include 'header.php';
require_once '../includes/clients.inc.php';
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
                    <label for="client_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Enter client name">
                </div>
                <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Client Code</label>
                    <input type="text" id="disabledTextInput" class="form-control" value="" placeholder="Client Code" readonly>
                </div>
                <button type="submit" class="btn btn-primary" name="submit" id="save_client">Save Client</button>
                <button type="button" class="btn btn-success" name="submit" style="display: none;" data-toggle="modal" data-target="#exampleModalCenter" id="modalTriggerButton">Link to a contact</button>

                <!-- <button type="submit" class="btn btn-success" name="" style="display: none;" id="modalTriggerButton">Link to a contact</button> -->
            </form>
            <div id="error-container" class="error-container" style="color: red; font-size:14px; margin: 5px 0;"></div>

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
<script src="../scripts/clients/add-new-client.js"></script>
<script src="../scripts/clients/launch-modal.js"></script>
<script src="../scripts/clients/components/contact-tab.js"></script>
<script src="../scripts/clients/save-selected-contacts.js"></script>
<script src="../scripts/helper-functions/delete-link.js"></script>
<script src="../scripts/helper-functions/error-handlers.js"></script>

<script>
    // document.addEventListener('DOMContentLoaded', () => {
 




    // function displayErrors(errors) {
    //     if (Object.keys(errors).length > 0) {
    //         const errorContainer = document.getElementById("error-container");
    //         errorContainer.innerHTML = "";

    //         // Iterate through the errors object
    //         for (const [field, message] of Object.entries(errors)) {
    //             const errorRow = document.createElement("div");
    //             errorRow.innerHTML = `<p>${message}</p>`;
    //             errorRow.className = "form-error";
    //             errorContainer.appendChild(errorRow);
    //         }
    //     }
    // }
</script>

<?php include 'footer.php'; ?>