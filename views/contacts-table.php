<?php include 'header.php';
require_once '../includes/fetch-contacts.inc.php';
// echo $clients;
?>
<div class="container-md mt-5">
    <h1>Contacts View</h1>
    <table class="table table-striped-columns table-bordered">
        <a href="../../binary-city/views/contacts-form.php" class="btn btn-primary">Add new contact</a>
        <div id="contactDetailsUpdate">

        </div>
        <?php if (!empty($contacts)) : ?>
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Email</th>
                    <th scope="col">No. of linked contacts</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($contact['contact_name']); ?></td>
                        <td><?php echo htmlspecialchars($contact['contact_surname']); ?></td>
                        <td><?php echo htmlspecialchars($contact['contact_email']); ?></td>
                        <td style="text-align: center;"><?php echo htmlspecialchars($contact['linked_clients']); ?></td>
                        <td><!-- Example single danger button -->
                            <div class="btn-group">
                                <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                    </svg> </button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Add new link</a>
                                    <a class="dropdown-item contact_ids" href="../../binary-city/views/edit-contact-form.php?contact_email=<?php echo ($contact['contact_email']) ?>" id="update_details">Update Details</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="google.com">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        <?php else : ?>
            <tbody>
                <tr>
                    <td colspan="2">No contact(s) found.</td>
                </tr>
            </tbody>
        <?php endif; ?>



    </table>

</div>
<!-- <script src="../scripts/contacts/components/update-contact-modal.js"></script> -->
<?php include 'footer.php'; ?>