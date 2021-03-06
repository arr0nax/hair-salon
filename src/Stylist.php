<?php

    class Stylist {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
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
            $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($name)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$name}' WHERE id = {$this->getId()};");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
        }

        function getClients()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
            $clients = array();
            foreach ($returned_clients as $client) {
                $new_client = new Client($client['name'], $client['stylist_id'], $client['id']);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function find($id)
        {
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist) {
                if ($stylist->getId() == $id) {
                    return $stylist;
                }
            }
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists");
            $stylists = array();
            foreach($returned_stylists as $stylist)
            {
                $new_stylist = new Stylist($stylist['name'], $stylist['id']);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists");
        }
    }



 ?>
