<?php

require_once '../config/database.php';
include "../models/clients.class.php";
include "../controller/client-controller.php";

try {
    $clientFetchAllController = new ClientFetchAllController();

    $allClients = $clientFetchAllController->fetchAllClients();
    echo json_encode(['status' => 'success', 'data' => $allClients]);

} catch (Exception $e) {
    $response = [
        'status' => 'error',
        'message' => 'An error occurred while fetching contacts: ' . $e->getMessage()
    ];
}

