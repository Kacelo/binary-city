<?php

class ClientController extends Client
{
    private $client_name;

    // Constructor to initialize properties
    public function __construct($client_name)
    {
        $this->client_name = $client_name;
    }

    public function registerClient()
    {
        return $this->createClient($this->client_name);
    }
}

class NewclientFetchController extends Client
{
    public function fetchLastCreated()
    {
        return $this->getLastCreated();
    }
}
class ClientFetchController extends Client
{
    public function fetchClients()
    {
        return $this->fetchClientsWithLinkedContacts();
    }
}
class ClientFetchAllController extends Client
{
    public function fetchAllClients()
    {
        return $this->getAllClients();
    }
}
class FetchLinkedClientsController extends Client
{
    private $contact_id;

    public function __construct($contact_id)
    {
        $this->contact_id = $contact_id;
    }

    public function fetchLinkedClients()
    {
        return $this->getLinkedClients($this->contact_id);
    }
}

class FetchAvailableClients extends Client
{
    private $contact_id;

    public function __construct($contact_id)
    {
        $this->contact_id = $contact_id;
    }

    public function fetchAvailableClients()
    {
        return $this->getAvailableClients($this->contact_id);
    }
}
class SearchAvailableClientsController extends Client
{
    private $contact_id;
    private $search_term;

    public function __construct($contact_id, $search_term)
    {
        $this->contact_id = $contact_id;
        $this->search_term = $search_term;
    }

    public function searchAvailableClients()
    {
        return $this->searchUnlinkedClients($this->contact_id, $this->search_term);
    }
}
