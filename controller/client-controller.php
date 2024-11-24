<?php

class ClientController extends Client {
    private $client_name;
   
      // Constructor to initialize properties
      public function __construct($client_name) {
        $this->client_name = $client_name;
    }

    public function registerClient() {
        $this->createClient($this->client_name);
    }
}