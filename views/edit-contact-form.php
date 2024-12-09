<?php
include 'header.php';
require_once '../includes/clients.inc.php';
?>
<div class="container-md mt-5">
    <!-- Edit Form -->
    <div>
        <h1>Edit Contact Details</h1>
    </div>
    <ul class="nav nav-tabs" id="myTab">
        <li class="nav-item active"><a class="nav-link active" data-toggle="tab" href="#general" id="general_tab">General</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#clients" id="clients_edit_tab">Clients</a></li>
    </ul>
    <div class="tab-content">
        <div id="general" class="tab-pane active">
            <!-- Default Form -->
            <form action="" method="post" id="contact_edit">
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
                <div class="mb-3" style="display: none;">
                    <label for="contact_id" class="form-label">ID</label>
                    <input type="text" class="form-control" id="contact_id_edit" name="contact_id" placeholder="Enter contact surname">

                </div>

                <button type="submit" class="btn btn-primary" name="submit" id="update_contact">Save Contact</button>
                <!-- <button type="button" class="btn btn-success" name="submit" style="display: none;" data-toggle="modal" data-target="#exampleModalCenter" id="modalTriggerButton">Link to a client</button> -->

                <!-- <button type="submit" class="btn btn-success" name="" style="display: none;" id="modalTriggerButton">Link to a contact</button> -->
            </form>
            <div id="error-container" class="error-container" style="color: red; font-size:14px; margin: 5px 0;"></div>


        </div>


        <div id="clients" class="tab-pane fade">
            <div id="floating_button_container" style="float: inline-end; margin: 1em 0">
                <button class="btn btn-primary" id="addClientLinkButton">Link New Client</button>
            </div>
            <div id="contacts_table_container">

                <table class="table">
                    <p>No client(s) found.</p>
                </table>
            </div>

        </div>
    </div>


</div>
<script>

</script>
<script src="../scripts/contacts/fetch-contact-email.js"></script>
<script src="../scripts/contacts/update-contact.js"></script>
<script src="../scripts/contacts/components/contact-client-edit.js"></script>

<?php include 'footer.php'; ?>