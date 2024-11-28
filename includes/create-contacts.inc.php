<?php

require_once '../config/database.php';
include "../models/contacts.class.php";
include "../controller/contact-controller.php";

header('Content-Type: application/json');

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $contact_name = trim($_POST["contact_name"] ?? '');
        $contact_surname = trim($_POST["contact_surname"] ?? '');
        $contact_email = trim($_POST["contact_email"] ?? '');

        // Validate input fields
        $errors = [];

        if (empty($contact_name)) {
            $errors["contact_name"] = "Contact name is required.";
        }
        if (empty($contact_surname)) {
            $errors["contact_surname"] = "Contact surname is required.";
        }
        if (empty($contact_email)) {
            $errors["contact_email"] = "Contact email is required.";
        } elseif (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
            $errors["contact_email"] = "Invalid email address.";
        }

        if (!empty($errors)) {
            // Return errors in the response
            echo json_encode(['status' => 'error', 'errors' => $errors]);
            exit();
        }

        // Proceed if no validation errors
        $createContact = new ContactController($contact_name, $contact_surname, $contact_email);
        $newContact = $createContact->registerContact();

        echo json_encode(['status' => 'success', 'data' => $newContact]);

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
