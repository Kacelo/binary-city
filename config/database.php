<?php

class Database {
   

    protected function connect() {
        // doing some error handling with a try and catch block. 
        try {
            $username = "root";
            $password ="";
            $dbh = new PDO("mysql:host=localhost;dbname=bcityclients", $username, $password);
            return $dbh;
        } catch (PDOException $e) {
        //throw $th;
        print "Error!: " .$e->getMessage() . "<br/>";
        die();
    }
}
}