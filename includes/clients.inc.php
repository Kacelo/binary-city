<?php
// session_start(); // Start the session to store/retrieve session data

require_once '../config/database.php';
include "../models/clients.class.php";
include "../controller/client-controller.php";

if(isset($_GET['status']) && ($_GET['status'] == 'client-created')){
  
    $newClient2 = $clientCode;
}


$clientFetchController = new ClientFetchController();

$clients = $clientFetchController->fetchClients();
