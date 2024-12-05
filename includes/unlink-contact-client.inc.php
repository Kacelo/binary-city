<?php
require_once '../config/database.php';
include "../models/client-contacts.class.php";
include "../controller/client-contact.controller.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
try {
    $data = json_decode(file_get_contents("php://input"), true);

    // Decode JSON payload from the request body
    $client_id = $data["client_id"];

    $contact_id = $data['contact_id'] ?? null;

    if (empty($client_id)) {
        throw new Exception("Client ID is required.");
    }

    // Create the controller and fetch the linked contacts
  // Create the controller and fetch the linked contacts
  $deleteContactClientController = new ClientContactDeleteController($client_id,$contact_id);
  $deleted = $deleteContactClientController->unlinkClientContact();

    // Return the response as JSON
    // header("Location: ../views/contacts-form.php?status=contact-linked#menu1");
    echo json_encode([
        'status' => 'success',
        'deleted' => $deleted,
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
}