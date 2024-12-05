
<?php

require_once '../config/database.php';
include "../models/contacts.class.php";
include "../controller/contact-controller.php";


try {
    // Decode JSON payload from the request body
    $client_id = $_GET['client_id'] ?? null;


    if (empty($client_id)) {
        throw new Exception("Client ID is required.");
    }

    // Create the controller and fetch the linked contacts
    $fetchAvailabaleContactsController = new FetchAvailableContacts($client_id);
    $availableContacts = $fetchAvailabaleContactsController->fetchAvailableContacts();

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'availableContacts' => $availableContacts,
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
