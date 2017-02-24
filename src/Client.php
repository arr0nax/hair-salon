<?php

    class Client {
        private $name;
        private $stylist_id;
        private $id;

        function __construct($name, $stylist_id, $id = null)
        {
            $this->name = $name;
            $this->stylist_id = $stylist_id;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($name)
        {
            $this->name = $name;
        }

        function getStylist_id()
        {
            return $this->stylist_id;
        }

        function setStylist_id($stylist_id)
        {
            $this->stylist_id = $stylist_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($id)
        {
            $this->id = $id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylist_id()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($name, $stylist_id)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET name = '{$name}', stylist_id = '{$stylist_id}' WHERE id = {$this->getId()};");
        }

        // function delete()
        // {
        //     $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
        // }

        static function find($id)
        {
            $clients = Client::getAll();
            foreach($clients as $client) {
                if ($client->getId() == $id) {
                    return $client;
                }
            }
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients");
            $clients = array();
            foreach($returned_clients as $client)
            {
                $new_client = new Client($client['name'],$client['stylist_id'], $client['id']);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients");
        }
    }



 ?>
