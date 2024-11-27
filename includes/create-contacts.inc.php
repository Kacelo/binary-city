<?php

require_once '../config/database.php';
include "../models/contacts.class.php";
include "../controller/contact-controller.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $contact_name = $_POST["contact_name"];
    $contact_surname = $_POST["contact_surname"];
    $contact_email = $_POST["contact_email"];

    if ($contact_name && $contact_surname && $contact_email) {
        try {
            $createContact = new ContactController($contact_name, $contact_surname, $contact_email);
            $newContact = $createContact->registerContact();
            echo json_encode(['status' => 'success', 'data' => $newContact]);
            exit();
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        exit();
    }
}