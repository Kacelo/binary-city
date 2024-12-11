<?php

require_once '../config/database.php';
include "../models/contacts.class.php";
include "../controller/contact-controller.php";
if (isset($_POST["submit"])) {
    $contact_name = $_POST["contact_name"];
    $contact_surname = $_POST["contact_surname"];
    $contact_email = $_POST["contact_email"];
    header("location: ../index.php?error=none");
}

$contactFetchAllController = new ContactFetchAllController();

$contacts = $contactFetchAllController->fetchAllContacts();
var_dump($contacts);

