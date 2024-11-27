<?php

require_once '../config/database.php';
include "../models/client-contacts.class.php";
include "../controller/client-contact.controller.php";
if (isset($_POST["submit"])) {
    try {
        $contact_ids = $_POST["contact_ids"] ?? [];
        $client_id = $_POST["client_id"] ?? null;

        if (empty($client_id)) {
            throw new Exception("Client ID is required.");
        }

        if (!is_array($contact_ids) || empty($contact_ids)) {
            throw new Exception("At least one contact must be selected.");
        }

        $createContactClientlink = new ClientContactCreateController($client_id, $contact_ids);
        
        $createContactClientlink->linkClientoContact();

        header("Location: ../views/clients-form.php?status=contact-linked#menu1");
        exit();
    } catch (Exception $e) {
        echo "Hellloooo";
        error_log("Error: " . $e->getMessage());
        header("Location: ../views/clients-form.php?status=error&message=" . urlencode($e->getMessage()));
        exit();
    }
} 
