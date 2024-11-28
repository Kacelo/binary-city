<?php include 'header.php';
require_once '../includes/fetch-contacts.inc.php';
// echo $clients;
?>
<div class="container-md mt-5">
    <h1>Contacts View</h1>
    <table class="table table-striped-columns table-bordered">
        <a href="../../binary-city/views/contacts-form.php" class="btn btn-primary">Add new contact</a>

        <?php if (!empty($contacts)) : ?>
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Email</th>
                    <th scope="col">No. of linked contacts</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($contact['contact_name']); ?></td>
                        <td><?php echo htmlspecialchars($contact['contact_surname']); ?></td>
                        <td><?php echo htmlspecialchars($contact['contact_email']); ?></td>
                        <td style="text-align: center;"><?php echo htmlspecialchars($contact['linked_clients']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        <?php else : ?>
            <tbody>
                <tr>
                    <td colspan="2">No clients found.</td>
                </tr>
            </tbody>
        <?php endif; ?>



    </table>

</div>

<?php include 'footer.php'; ?>