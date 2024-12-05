<?php

require_once '../config/database.php';


class ClientContact extends Database
{
    public function createContactToClientLink($client_id, $contact_ids)
    {
        echo "Error: ";
        // echo "Error: " . $contact_ids;
        // recieving contact ids in an array to allow multiple inserts at the same time.
        // looping through array and reapeating the process according to array length. 
        if (!empty($client_id) && !empty($contact_ids)) {
            foreach ($contact_ids as $contact_id) {
                $sql = "INSERT INTO client_contacts (client_id, contact_id) VALUES (?,?)";
                try {
                    $stmt = $this->connect()->prepare($sql);
                    $stmt->execute([$client_id, $contact_id]);
                } catch (PDOException $e) {
                    // Handle potential database errors
                    echo "Error: " . $e->getMessage();
                }
            }
        }
    }
    public function createClientsToContactLink($contact_id, $client_ids)
    {
        echo "Error: ";
        // recieving client ids in an array to allow multiple inserts at the same time.
        // looping through array and reapeating the process according to array length. 
        if (!empty($contact_id) && !empty($client_ids)) {
            foreach ($client_ids as $client_id) {
                $sql = "INSERT INTO client_contacts (client_id, contact_id) VALUES (?,?)";
                try {
                    $stmt = $this->connect()->prepare($sql);
                    $stmt->execute([$client_id, $contact_id]);
                } catch (PDOException $e) {
                    // Handle potential database errors
                    echo "Error: " . $e->getMessage();
                }
            }
        }
    }

    public function deleteClientContact($client_id, $contact_id)
    {
        $sql = "DELETE FROM client_contacts WHERE client_id=? AND contact_id=?";
        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$client_id, $contact_id]);
            return $stmt->rowCount() > 0; // Returns true if a row was deleted
        } catch (PDOException $e) {
            // Log the error for debugging purposes
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }
    public function deleteContactClient($contact_id)
    {
        $sql = "DELETE FROM client_contacts WHERE contact_id=?";
        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$contact_id]);
            return $stmt->rowCount() > 0; // Returns true if a row was deleted
        } catch (PDOException $e) {
            // Log the error for debugging purposes
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }
}
