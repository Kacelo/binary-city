<?php 

if(isset($_POST["submit"]))
{
    // grabbing data from the frontend 
    $client_name = $_POST["client_name"];
   
    // Instatiate controller class
    include "../config/database.php";
    include "../models/clients.class.php";
    include "../controller/client-controller.php";

    $createClient = new ClientController($client_name);


    // error handling done here
    $createClient->registerClient();

    // return to front page

    header("location: ../index.php?error=none");

}
