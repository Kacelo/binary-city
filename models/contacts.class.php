<?php

require_once '../config/database.php';

class Contact extends Database
{

    public function checkIfEmailExists($contact_email)
    {
        $sql = "SELECT * FROM contacts WHERE contact_email = ?"; // Fixed field name
        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$contact_email]);
            return $stmt->rowCount() > 0; // Directly return the condition result
        } catch (PDOException $e) {
            error_log("Error checking email existence: " . $e->getMessage()); // Log error
            return false; // Return false in case of error to avoid breaking flow
        }
    }

    public function createContact($contact_name, $contact_surname, $contact_email)
    {
        $sql = "INSERT INTO contacts (contact_name, contact_surname, contact_email) VALUES (?, ?, ?)";

        try {
            $conn = $this->connect();
            $stmt = $conn->prepare($sql);
            $stmt->execute([$contact_name, $contact_surname, $contact_email]);
            $last_id = $conn->lastInsertId();

            if ($last_id) {
                $fetchsql = "SELECT * FROM contacts WHERE contact_id = ?";
                $stmt = $conn->prepare($fetchsql);

                if ($stmt->execute([$last_id])) {
                    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
                    return [
                        'status' => 'success',
                        'data' => $contact, // Return created contact data
                    ];
                } else {
                    return [
                        'status' => 'error',
                        'message' => 'Error: Unable to fetch contact data.',
                    ];
                }
            }

            return [
                'status' => 'error',
                'message' => 'Error: Unable to create contact.',
            ];
        } catch (PDOException $e) {
            error_log("Error creating contact: " . $e->getMessage()); // Log error
            return [
                'status' => 'error',
                'message' => 'An unexpected error occurred while creating the contact.',
            ];
        }
    }

    public function getAllContacts()
    {
        $sql = "SELECT *
        FROM contacts
        ORDER BY contact_name ASC;";
        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle potential database errors
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    public function getLinkedContacts($client_id)
    {
        if ($client_id) {
            $sql = "SELECT CONCAT(co.contact_name, ' ', co.contact_surname) AS full_name, co.contact_email, co.contact_id
                    FROM contacts co
                    RIGHT JOIN client_contacts cc ON co.contact_id = cc.contact_id
                    WHERE cc.client_id = ?
                    ORDER BY full_name ASC";
            try {
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$client_id]); // Pass the client_id safely
                return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return the fetched data
            } catch (PDOException $e) {
                error_log("Error fetching linked contacts: " . $e->getMessage());
                return []; // Return an empty array if an error occurs
            }
        } else {
            return []; // Return an empty array if no client_id is provided
        }
    }
    public function getAvailableContacts($client_id)
    {
        if ($client_id) {
            $sql = "SELECT c.contact_id, c.contact_name, c.contact_surname, c.contact_email
        FROM contacts c
        LEFT JOIN client_contacts cc 
        ON c.contact_id = cc.contact_id AND cc.client_id = ?
        WHERE cc.client_id IS NULL";
            try {
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$client_id]); // Pass the client_id safely
                return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return the fetched data
            } catch (PDOException $e) {
                error_log("Error fetching linked contacts: " . $e->getMessage());
                return []; // Return an empty array if an error occurs
            }
        } else {
            return []; // Return an empty array if no client_id is provided
        }
    }

    public function fetchContactsWithNoOfLinkedClients()
    {
        $sql = "SELECT CONCAT(co.contact_name, ' ', co.contact_surname) AS full_name,co.contact_name,co.contact_surname, co.contact_email,
        COUNT(cc.client_id) AS linked_clients
        FROM contacts co
        LEFT JOIN client_contacts cc ON co.contact_id = cc.contact_id
        GROUP BY co.contact_id
        ORDER BY full_name ASC;";
        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle potential database errors
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}
