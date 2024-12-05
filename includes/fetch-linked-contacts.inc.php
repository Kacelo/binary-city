<?php

require_once '../config/database.php';
include "../models/contacts.class.php";
include "../controller/contact-controller.php";

try {
    // Decode JSON payload from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    $client_id = $data["client_id"] ?? null;

    if (empty($client_id)) {
        throw new Exception("Client ID is required.");
    }

    // Create the controller and fetch the linked contacts
    $fetchLinkedContactsController = new FetchLinkedContactsController($client_id);
    $linkedContacts = $fetchLinkedContactsController->fetchLinkedContacts();

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'linkedContacts' => $linkedContacts,
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

