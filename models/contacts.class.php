<?php

require_once '../config/database.php';

class Client extends Database
{

    public function checkIfEmailExists ($contact_email){
        $sql = "SELECT * FROM contacts WHERE contact_male =?";
        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$contact_email]);
            if ($stmt->rowCount() > 0) {
                return true; 
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            // Handle potential database errors
            echo "Error: " . $e->getMessage();
        }
    }
    public function createContact($contact_name, $contact_surname, $contact_email) {
        // SQL query to insert the client
        // check if contact email already exists
        if ($this->checkIfEmailExists($contact_email)) {
            return "Error: Email already exists!";
        }        
        $sql = "INSERT INTO contacts (contact_name, contact_surname, contact_email) VALUES (?, ?, ?)";

        // Database connection and execution
        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$contact_name, $contact_surname, $contact_email]);
            echo "Contact successfully created with code: ";
        } catch (PDOException $e) {
            // Handle potential database errors
            echo "Error: " . $e->getMessage();
        }
    }
}
