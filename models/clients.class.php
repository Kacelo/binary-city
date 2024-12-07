<?php

require_once '../config/database.php';
// header('Content-Type: application/json'); // Ensure JSON response

class Client extends Database
{

    public function createClientCode($clientName)
    {
        // 1. Split the name into an array and turn string to upper case
        $nameArray = explode(" ", strtoupper($clientName));
        $clientCode = "";

        // 2. Check how many words are contained in the array.
        $nameCount = count($nameArray);

        if ($nameCount == 1) {
            // If only one word, take the first 3 letters of the single word

            if (strlen($clientName) <= 2) {
                $lessThan2Charaters = substr($nameArray[0], 0, 2);
                $clientCode = $lessThan2Charaters . chr(rand(65, 90));
            } elseif (strlen($clientName) > 2) {
                $clientCode = substr($nameArray[0], 0, 3);
            }
        } elseif ($nameCount == 2) {
            // If two words, take the first letter of each and add a random letter
            $clientCode = $nameArray[0][0] . $nameArray[1][0] . $nameArray[1][1]; // Random uppercase letter
        } elseif ($nameCount >= 3) {
            // If three or more words, take the first letter of the first three words
            $clientCode = $nameArray[0][0] . $nameArray[1][0] . $nameArray[2][0];
        }

        // Return the client code in uppercase (optional but ensures uniformity)
        return strtoupper($clientCode);
    }

    private function createUniqueAlphanumericCode($clientCode)
    {
        $numericPart = 1;
        while (true) {
            // using %03d to ensure there are 3 digits created
            $uniqueAplhanumericCode = $clientCode . sprintf("%03d", $numericPart);

            // check if the code exists in the database
            $sql = "SELECT COUNT(*) FROM clients WHERE client_code =?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$uniqueAplhanumericCode]);

            $count = $stmt->fetchColumn();
            if ($count == 0) {
                // count == means the code is unique and can be returned as the new unique code
                return $uniqueAplhanumericCode;;
            }
            // if count == 0 is not true, this means we increment the number and try again. 
            $numericPart++;
            # code...
        }
    }

    public function createClient($name)
    {
        // Generate the client code using the createClientCode function
        $clientCode = $this->createClientCode($name);

        // Then we create our unique alphanumeric code
        $uniqueCode = $this->createUniqueAlphanumericCode($clientCode);

        // SQL query to insert the client
        $sql = "INSERT INTO clients (client_name, client_code) VALUES (?, ?)";

        // Database connection and execution
        try {
            $conn = $this->connect();
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $uniqueCode]);
            $last_id = $conn->lastInsertId();

            if ($last_id != null) {

                // echo "last_id: " . $last_id; // Debugging last_insert_id
                $fetchsql = "SELECT * FROM clients WHERE client_id=?";
                $stmt = $conn->prepare($fetchsql);

                if ($stmt->execute([$last_id])) {
                    $client = $stmt->fetch(PDO::FETCH_ASSOC);
                    // echo "Client successfully created with code: " . $client['client_code'];
                    return $client; // Return single client record
                } else {
                    echo "Error: Unable to fetch client data.";
                    return null;
                }
            }

            return null;
        } catch (PDOException $e) {
            // Handle potential database errors
            echo "Error: " . $e->getMessage();
            return null; // Return null in case of error
        }
    }
    public function getLastCreated()
    {
        try {
            $conn = $this->connect();

            // Ensure that the previous query was an insert and the connection is valid
            $last_id = $conn->lastInsertId();

            // Check if the last ID is valid
            if ($last_id) {
                echo "Last saved ID was: " . $last_id;
                return $last_id;  // Return the ID of the last inserted row
            } else {
                // Handle the case where no insert has occurred
                echo "No recent insert found.";
                return null;
            }
        } catch (PDOException $e) {
            // Handle potential database errors
            error_log("Database error: " . $e->getMessage()); // Log the error
            echo "Error: " . $e->getMessage(); // Optionally show the error message to the user
            return null; // Return null in case of error
        }
    }


    public function countLinkedContacts($client_id)
    {
        $sql = "SELECT COUNT(*) AS contact_count FROM client_contacts WHERE client_id =?";
        try {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$client_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // returning number of contacts 
            return $result['contact_count'];
        } catch (PDOException $e) {
            // Handle potential database errors
            echo "Error: " . $e->getMessage();
            return 0;
        }
    }
    public function fetchLinkedContacts($client_id)
    {
        // check if client has any linked clients
        // check if the clientID exists in the database
        $contactCount = $this->countLinkedContacts($client_id);
        try {
            if ($contactCount == 0) {
                // return an empty array if there are no records in the client contacts table
                return [];
            } elseif ($contactCount > 0) {
                $sql = "SELECT * FROM client_contacts WHERE client_id =?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$client_id]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            // Handle potential database errors
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    public function fetchClientsWithLinkedContacts()
    {

        $sql = "SELECT cl.client_name AS name, cl.client_code AS code, COUNT(cc.contact_id) AS linked_contacts
                FROM clients cl
                LEFT JOIN client_contacts cc ON cl.client_id = cc.client_id
                GROUP BY cl.client_id
                ORDER BY cl.client_name ASC;";
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
    public function linkClientsToContacts($client_id, $contact_id)
    {

        $sql = "INSERT INTO client_contacts (contact_id, client_id)  VALUES (?,?)";
        try {
            $stmt = $this->connect()->prepare($$sql);
            $stmt->execute([$client_id, $contact_id]);
            echo "contact successfully linked with to client: ";
        } catch (PDOException $e) {
            // Handle potential database errors
            echo "Error: " . $e->getMessage();
        }
    }
    public function getAllClients()
    {
        $sql = "SELECT *
        FROM clients
        ORDER BY client_name ASC;";
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
    public function getLinkedClients($contact_id)
    {
        if ($contact_id) {
            $sql = "SELECT cl.client_name, cl.client_code, cl.client_id
            FROM clients cl
            RIGHT JOIN client_contacts cc ON cl.client_id = cc.client_id
            WHERE cc.contact_id = ? 
            ORDER BY cl.client_name ASC;";
            try {
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$contact_id]); // Pass the client_id safely
                return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return the fetched data
            } catch (PDOException $e) {
                error_log("Error fetching linked contacts: " . $e->getMessage());
                return []; // Return an empty array if an error occurs
            }
        } else {
            return []; // Return an empty array if no client_id is provided
        }
    }
    public function getAvailableClients($contact_id)
    {
        if ($contact_id) {
            $sql = "SELECT cl.client_id, cl.client_name, cl.client_code
                    FROM clients cl
                    LEFT JOIN client_contacts cc 
                    ON cl.client_id = cc.client_id AND cc.contact_id = ?
                    WHERE cc.contact_id IS NULL;";
            try {
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$contact_id]); // Pass the client_id safely
                return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return the fetched data
            } catch (PDOException $e) {
                error_log("Error fetching linked contacts: " . $e->getMessage());
                return []; // Return an empty array if an error occurs
            }
        } else {
            return []; // Return an empty array if no client_id is provided
        }
    }
}
