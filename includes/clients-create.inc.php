<?php
require_once '../config/database.php';
include "../models/clients.class.php";
include "../controller/client-controller.php";
header('Content-Type: application/json');



try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $client_name = trim($_POST["client_name"] ?? '');
        $errors = [];

        if (empty($client_name)) {
            $errors["client_name"] = "Client name is required.";
        }
        if (!empty($errors)) {
            // Return errors in the response
            echo json_encode(['status' => 'error', 'errors' => $errors]);
            exit();
        }
        $createClient = new ClientController($client_name);
        $newClient = $createClient->registerClient();
        echo json_encode(['status' => 'success', 'data' => $newClient]);
        exit();
    } else {
        throw new Exception("Invalid request method.");
    }
} catch (Exception $e) {
    // Handle server-side errors gracefully
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit();
}
