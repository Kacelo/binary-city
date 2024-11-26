<?php
include 'header.php';
require_once '../includes/clients.inc.php';
session_start();
echo 'contacts' . $contacts
?>
<div class="container-md mt-5">
    <h1>Sign Up</h1>
    <ul class="nav nav-tabs">
        <li class="nav-item active"><a class="nav-link active" data-toggle="tab" href="#home">General</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1">Contacts</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane active">
            <!-- Check if the status is success and session data is available -->
            <?php if (isset($_GET['status']) && $_GET['status'] === 'success' && isset($_SESSION['client_name'], $_SESSION['client_code'])) : ?>
        <!-- Success Form -->
        <form action="../includes/clients.inc.php" method="post">
            <div class="mb-3">
                <label for="client_name" class="form-label">Client Name</label>
                <input type="text" class="form-control" id="client_name" name="client_name" 
                       value="<?php echo htmlspecialchars($_SESSION['client_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Client Code</label>
                <input type="text" id="disabledTextInput" class="form-control" 
                       value="<?php echo htmlspecialchars($_SESSION['client_code']); ?>" readonly>
            </div>
            <button type="submit" class="btn btn-success" name="submit">Link to a contact</button>
        </form>
        <div>

        </div>
    <?php else : ?>
        <!-- Default Form -->
        <form action="../includes/clients-create.inc.php" method="post">
            <div class="mb-3">
                <label for="client_name" class="form-label">Client Name</label>
                <input type="text" class="form-control" id="client_name" name="client_name" 
                       placeholder="Enter client name" required>
            </div>
            <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Client Code</label>
                <input type="text" id="disabledTextInput" class="form-control" 
                       value="" placeholder="Client Code" readonly>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Save</button>
        </form>
    <?php endif; ?>
        </div>

        <div id="menu1" class="tab-pane fade">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>
