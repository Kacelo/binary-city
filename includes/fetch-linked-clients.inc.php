<?php

require_once '../config/database.php';
include "../models/clients.class.php";
include "../controller/client-controller.php";

try {
    // Decode JSON payload from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    $client_id = $data["client_id"] ?? null;

    if (empty($client_id)) {
        throw new Exception("Client ID is required.");
    }

    // Create the controller and fetch the linked contacts
    $fecthLinkkedClientsController = new FetchLinkedClientsController($client_id);
    $linkedClients = $fecthLinkkedClientsController->fetchlinkedClients();

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'linkedClients' => $linkedClients,
    ]);
    exit();
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