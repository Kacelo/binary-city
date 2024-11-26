<?php
session_start(); // Start the session to store/retrieve session data

include "../config/database.php";
include "../models/clients.class.php";
include "../controller/client-controller.php";

if (isset($_POST["submit"])) {
    // grabbing data from the frontend 
    $client_name = $_POST["client_name"];

    // Instatiate controller class


    $createClient = new ClientController($client_name);


    // error handling done here
    $newClient = $createClient->registerClient();
    if ($newClient) {
        // Get the client name and code
        $clientName = $newClient['client_name'];
        $clientCode = $newClient['client_code'];

        // Store client information in session
        $_SESSION['client_name'] = $clientName;
        $_SESSION['client_code'] = $clientCode;
        $_SESSION['client_id'] = $clientId;
        // Redirect to the form page with status success
        header("Location: ../views/clients-form.php?status=success");
        exit;
    } else {
        // If there was an error, redirect with an error message
        header("Location: ../views/clients-form.php?status=error");
        exit;
    }
}

