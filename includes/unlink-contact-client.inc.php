<?php
require_once '../config/database.php';
include "../models/client-contacts.class.php";
include "../controller/client-contact.controller.php";

try {
    // Decode JSON payload from the request body
    $contact_id = $_GET['contact_id'] ?? null;


    if (empty($contact_id)) {
        throw new Exception("Client ID is required.");
    }

    // Create the controller and fetch the linked contacts
  // Create the controller and fetch the linked contacts
  $deleteContactClientController = new ContactClientDeleteController($contact_id);
  $deleted = $deleteContactClientController->unlinkContactClient();

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