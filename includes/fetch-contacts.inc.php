<?php

require_once '../config/database.php';
include "../models/contacts.class.php";
include "../controller/contact-controller.php";

// try {
//     $contactFetchAllController = new ContactFetchAllController();

//     $contacts = $contactFetchAllController->fetchAllContacts();
//     echo json_encode(['status' => 'success', 'data' => $contacts]);

// } catch (Exception $e) {
//     $response = [
//         'status' => 'error',
//         'message' => 'An error occurred while fetching contacts: ' . $e->getMessage()
//     ];
// }

$contactFetchController = new FetchContactsController();

$contacts = $contactFetchController->fetchContacts();
