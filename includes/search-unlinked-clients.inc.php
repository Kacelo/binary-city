<?php
require_once '../config/database.php';
include "../models/clients.class.php";
include "../controller/client-controller.php";



try {
    $contact_id = $_GET['contact_id'] ?? null;
    $search_term = $_GET['search_term'] ?? '';

    if (empty($contact_id)) {
        throw new Exception("contact ID is required.");
    }

    $searchForAvailableClients = new SearchAvailableClientsController($contact_id, $search_term);
    $searchResults = $searchForAvailableClients->searchAvailableClients();

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
