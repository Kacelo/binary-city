<?php

require_once '../config/database.php';
include "../models/clients.class.php";
include "../controller/client-controller.php";

try {
    //code...
    // Decode JSON payload from the request body
    $client_id = $_GET["client_id"] ?? null;


    if (empty($client_id)) {
        throw new Exception("Client email is required.");
    }
    if ($client_id) {
        $fetchClientByIdController = new FetchClientByIdController($client_id);

        $fetchedClient = $fetchClientByIdController->fetchClientById();

        if($fetchedClient){
            echo json_encode(['status' => 'success', 'client' => $fetchedClient]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Client not found.']);
        }
        
    }
} catch (Exception $e) {
    // Log error and send JSON response
    error_log("Error: " . $e->getMessage());
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
    ]);
    exit();
}