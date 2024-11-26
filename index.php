<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <!-- <?php ?> -->
    <h1>Sign Up</h1>
    <ul class="nav nav-tabs">
        <li class="nav-item active"><a class="nav-link active" data-toggle="tab" href="#home">General</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1">Contacts</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane active">
            <form action="includes/clients.inc.php" method="post">
                <div class="mb-3">
                    <label for="client_name" class="form-label">Client Name</label>
                    <input type="text" class="form-control" id="client_name" aria-describedby="emailHelp" name="client_name">
                </div>
                <!-- <div class="mb-3">
                    <label for="disabledTextInput" class="form-label">Client Code</label>
                    <input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">
                </div> -->
                <button type="submit" class="btn btn-primary" name="submit">Save</button>
                <!-- <button type="submit" class="btn btn-success">Link a contact</button> -->
    
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
    <script>
        // const triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'));
        // console.log('List', triggerTabList)
        // triggerTabList.forEach((triggerEl) => {
        //     const tabTrigger = new Tab(triggerEl);

        //     triggerEl.addEventListener('click', (event) => {
        //         event.preventDefault();
        //         tabTrigger.show();
        //     });
        // });
        // const triggerEl = document.querySelector('#myTab a[href="#profile"]');
        // Tab.getInstance(triggerEl).show(); // Select tab by name
        // const triggerEl2 = document.querySelector('#myTab a[href="#messages"]');

        // const triggerFirstTabEl = document.querySelector('#myTab li:first-child a');
        // Tab.getInstance(triggerFirstTabEl).show(); // Select first tab
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>