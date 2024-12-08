<?php
include 'header.php';
require_once '../includes/clients.inc.php';
?>
<div>
    <!-- Edit Form -->
     <div>
        <h1>Edit Contact Details</h1>
     </div>
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
        <button type="submit" class="btn btn-primary" name="submit" id="save_client">Save Contact</button>
        <button type="button" class="btn btn-success" name="submit" style="display: none;" data-toggle="modal" data-target="#exampleModalCenter" id="modalTriggerButton">Link to a client</button>

        <!-- <button type="submit" class="btn btn-success" name="" style="display: none;" id="modalTriggerButton">Link to a contact</button> -->
    </form>
</div>

<script src="../scripts/contacts/fetch-contact-email.js"></script>