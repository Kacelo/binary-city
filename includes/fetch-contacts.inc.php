<?php

require_once '../config/database.php';
include "../models/contacts.class.php";
include "../controller/contact-controller.php";

try {
    $contactFetchController = new FetchContactsController();

    $contacts = $contactFetchController->fetchContacts();
} catch (Exception $e) {
    $response = [
        'status' => 'error',
        'message' => 'An error occurred while fetching contacts: ' . $e->getMessage()
    ];
}
