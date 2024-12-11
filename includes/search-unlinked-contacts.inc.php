<?php
require_once '../config/database.php';
include "../models/contacts.class.php";
include "../controller/contact-controller.php";



try {
    $client_id = $_GET['client_id'] ?? null;
    $search_term = $_GET['search_term'] ?? '';

    if (empty($client_id)) {
        throw new Exception("client ID is required.");
    }

    $searchForAvailableContacts = new SearchAvailableContactsController($client_id, $search_term);
    $searchResults = $searchForAvailableContacts->searchAvailableContacts();

    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'searchResults' => $searchResults,
    ]);
    exit();
    //code...
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
