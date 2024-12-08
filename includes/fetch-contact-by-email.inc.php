<?php

require_once '../config/database.php';
include "../models/contacts.class.php";
include "../controller/contact-controller.php";

try {
    //code...
    // Decode JSON payload from the request body
    $contact_email = $_GET["contact_email"] ?? null;


    if (empty($contact_email)) {
        throw new Exception("Client email is required.");
    }
    if ($contact_email) {
        $fetchContactByMailController = new FetchContactByEmail($contact_email);

        $fetchedContact = $fetchContactByMailController->fetchContactByEmail();

        if($fetchedContact){
            echo json_encode(['status' => 'success', 'contact' => $fetchedContact]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Contact not found.']);
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
