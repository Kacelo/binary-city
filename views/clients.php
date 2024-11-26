<?php include 'header.php';
require_once '../includes/clients.inc.php';
echo $clients;
?>
<div class="container-md mt-5">

    <table class="table table-striped-columns table-bordered">


        <?php if (!empty($clients)) : ?>
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Code</th>
                    <th scope="col">No. of linked contacts</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($client['name']); ?></td>
                        <td><?php echo htmlspecialchars($client['code']); ?></td>
                        <td style="text-align: center;"><?php echo htmlspecialchars($client['linked_contacts']); ?></td>
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