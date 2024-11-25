<?php

class ClientController extends Client
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

    public function registerClient()
    {
        $this->createContact($this->contact_name, $this->contact_surname, $this->contact_email);
    }
}
