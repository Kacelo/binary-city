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
