<?php

if(isset($_POST["submit"]))
{
$username = $_POST["username"];
$pword = $_POST["pword"];
$pwordRepeat = $_POST["pwordRepeat"];
$email = $_POST["email"];

include "../config/database.php";
include "../models/contacts.class.php";
include "../controller/contact-controller.php";

header("location: ../index.php?error=none");

}