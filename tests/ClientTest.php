<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
    require_once 'src/Client.php';


    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
        }

        function test_save() {
            //arrange
            $name = 'sarah god';
            $stylist_id = 2;
            $id = null;
            $test_client = new Client($name,$stylist_id, $id);

            //act
            $test_client->save();
            $result = Client::getAll();

            //assert
            $this->assertEquals($result[0], $test_client);
        }
    }
?>
