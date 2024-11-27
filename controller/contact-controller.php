<?php

class ContactController extends Contact
{
    private $contact_name;
    private $contact_surname;
    private $contact_email;

    // Constructor to initialize properties
    public function __construct($contact_name, $contact_surname, $contact_email)
    {
        $this->contact_name = $contact_name;
        $this->contact_surname = $contact_surname;
        $this->contact_email = $contact_email;
    }

    public function registerContact()
    {
        return $this->createContact($this->contact_name, $this->contact_surname, $this->contact_email);
    }
}

class ContactFetchAllController extends Contact
{
    public function fetchAllContacts()
    {
        return $this->getAllContacts();
    }
}

class FetchLinkedContactsController extends Contact
{
    private $client_id;

    public function __construct($client_id)
    {
        $this->client_id = $client_id;
    }

    public function fetchLinkedContacts()
    {
        return $this->getLinkedContacts($this->client_id);
    }
}

class FetchAvailableContacts extends Contact
{
    private $client_id;

    public function __construct($client_id)
    {
        $this->client_id = $client_id;
    }

    public function fetchAvailableContacts()
    {
        return $this->getAvailableContacts($this->client_id);
    }
}

class FetchContactsController extends Contact {
    public function fetchContacts(){
        return $this->fetchContactsWithNoOfLinkedClients();
    }
}
