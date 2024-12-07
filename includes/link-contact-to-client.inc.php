<?php

require_once '../config/database.php';
include "../models/client-contacts.class.php";
include "../controller/client-contact.controller.php";

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $client_ids = $data["client_ids"] ?? [];
    $contact_id = $data["contact_id"] ?? null;
    var_dump($client_ids);

    if (empty($contact_id)) {
        throw new Exception("Contact ID is required.");
    }

    if (!is_array($client_ids) || empty($client_ids)) {
        throw new Exception("At least one contact must be selected.");
    }

    $createClienttoContactlink = new ContactClientCreateController($contact_id, $client_ids);
        
    $createClienttoContactlink->linkContactToClient();

    echo json_encode(['status' => 'success', 'data' => $contact_id]);
} catch (Exception $e) {
    echo "Hellloooo";
    error_log("Error: " . $e->getMessage());
    header("Location: ../views/clients-form.php?status=error&message=" . urlencode($e->getMessage()));
    exit();
}
