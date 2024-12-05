<?php

class ClientContactCreateController extends ClientContact
{
    private $contact_ids;
    private $client_id;
    public function __construct($client_id, $contact_ids)
    {
        $this->contact_ids = $contact_ids;
        $this->client_id = $client_id;
    }

    public function linkClientoContact()
    {
        return $this->createContactToClientLink($this->client_id, $this->contact_ids);
    }
}
class ContactClientCreateController extends ClientContact
{   
    private $client_ids;
    private $contact_id;
    public function __construct($contact_id, $client_ids)
    {
        $this->client_ids = $client_ids;
        $this->contact_id = $contact_id;
    }

    public function linkContactToClient()
    {
        return $this->createClientsToContactLink($this->contact_id, $this->client_ids);
    }
}

class ContactClientDeleteController extends ClientContact
{   
    private $contact_id;
    public function __construct($contact_id)
    {
        $this->contact_id = $contact_id;
    }

    public function unlinkContactClient()
    {
        return $this->deleteContactClient($this->contact_id);
    }
}
class ClientContactDeleteController extends ClientContact
{   
    private $client_id;
    private $contact_id;

    public function __construct($client_id, $contact_id)
    {
        $this->client_id = $client_id;
        $this->contact_id = $contact_id;

    }

    public function unlinkClientContact()
    {
        return $this->deleteClientContact($this->client_id, $this->contact_id);
    }
}
