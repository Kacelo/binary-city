<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Client Manager</title>
    <style>
        .hero {
            background: url('./assets/hero.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            padding: 200px 0;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.5rem;
        }

        .hero .btn {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../../binary-city/index.php">Client Manager</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="../../binary-city/views/clients-table.php">Clients</a>
                <a class="nav-item nav-link" href="../../binary-city/views/contacts-table.php">Contacts</a>
                <!-- <a class="btn btn-primary ml-3" href="#get-started" role="button">Get Started</a> -->
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero text-center">
        <div class="container">
            <h1>Welcome to Client Manager</h1>
            <p>Streamline your client and contact management process effortlessly.</p>
            <section id="get-started" class="text-center py-5">
                <div class="container">
                    <h3>Let's Get Started</h3>
                    <div class="mt-4">
                        <a class="btn btn-primary btn-lg" href="../../binary-city/views/clients-table.php" role="button">View Clients</a>
                        <a class="btn btn-secondary btn-lg" href="../../binary-city/views/contacts-table.php" role="button">View Contacts</a>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container text-center">
            <h2>Our Features</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create Client Records</h5>
                            <p class="card-text">Easily create and manage detailed client records.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create Contact Records</h5>
                            <p class="card-text">Maintain unlimited contacts linked to your clients.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Unlimited Linking</h5>
                            <p class="card-text">Link clients and contacts seamlessly for better organization.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="features" class="py-5">
    <div class="container text-center">
    <h2>Meet Our Trusted Clients</h2>
    <div class="row mt-4">
        <!-- Image 1 -->
        <div class="col-md-4">
            <div class="">
                <img src="./assets/header-logo_lrg.svg" class="card-img-top" alt="Client 1" style="width: 100px;">
                <div class="card-body">
                    <h5 class="card-title">First Natioal Bank</h5>
                </div>
            </div>
        </div>
        <!-- Image 2 -->
        <div class="col-md-4">
            <div class="">
                <img src="./assets/Welcome to Binary City.png" class="card-img-top" alt="Client 2">
                <div class="card-body">
                    <h5 class="card-title">Binary City</h5>
                </div>
            </div>
        </div>
        <!-- Image 3 -->
        <div class="col-md-4">
            <div class="">
                <img src="./assets/protea-logo_rev.png" class="card-img-top" alt="Client 3"  style="width: 300px;">
                <div class="card-body">
                    <h5 class="card-title">Protea Hotes</h5>
                </div>
            </div>
        </div>
    </div>
</div>

    </section>

    <!-- Call to Action Section -->



    <footer class="text-center py-3 bg-dark text-white">
      <p>&copy; 2024 Client Manager. All Rights Reserved.</p>
  </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+3mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>