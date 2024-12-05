<?php
require_once '../config/database.php';
include "../models/clients.class.php";
include "../controller/client-controller.php";

try {
    // Decode JSON payload from the request body
    $contact_id = $_GET['contact_id'] ?? null;


    if (empty($contact_id)) {
        throw new Exception("contact ID is required.");
    }

    // Create the controller and fetch the linked contacts
    $fetchAvailabaleClientsController = new FetchAvailableClients($contact_id);
    $availableClients = $fetchAvailabaleClientsController->fetchAvailableClients();

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'availableClients' => $availableClients,
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
