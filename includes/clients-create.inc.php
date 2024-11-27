<?php
session_start(); // Start the session to store/retrieve session data

require_once '../config/database.php';
include "../models/clients.class.php";
include "../controller/client-controller.php";
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $client_name = $_POST["client_name"];
    if ($client_name) {
        try {
            //code...
            $createClient = new ClientController($client_name);
            $newClient = $createClient->registerClient();
            echo json_encode(['status' => 'success', 'data' => $newClient]);
            exit();
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        exit();
    }
}



// if (isset($_POST["submit"])) {
//     // grabbing data from the frontend 
//     $client_name = $_POST["client_name"];

//     // Instatiate controller class


//     $createClient = new ClientController($client_name);


//     // error handling done here
//     $newClient = $createClient->registerClient();
//     if ($newClient) {
//         // Get the client name and code
//         print_r($newClient);
//         $clientName = $newClient['client_name'];
//         $clientCode = $newClient['client_code'];
//         $clientId = $newClient['client_id'];

//         // Store client information in session
//         $_SESSION['client_name'] = $clientName;
//         $_SESSION['client_code'] = $clientCode;
//         $_SESSION['client_id'] = $clientId;
//         // Redirect to the form page with status success
//         header("Location: ../views/clients-form.php?status=client-saved");
//         exit;
//     } else {
//         // If there was an error, redirect with an error message
//         header("Location: ../views/clients-form.php?status=error");
//         exit;
//     }
// }
