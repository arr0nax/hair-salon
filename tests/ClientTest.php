<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
    require_once 'src/Client.php';
    require_once 'src/Stylist.php';


    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
            Stylist::deleteAll();
        }

        function test_save() {
            //arrange
            $name = 'sarah is god';
            $stylist_id = 2;
            $id = null;
            $test_client = new Client($name,$stylist_id, $id);

            //act
            $test_client->save();
            $result = Client::getAll();

            //assert
            $this->assertEquals($result, [$test_client]);
        }

        function test_getAll() {
            //arrange
            $name = 'sarah is god';
            $stylist_id = 2;
            $id = null;
            $test_client = new Client($name,$stylist_id, $id);

            $name2 = 'shrek is life';
            $stylist_id2 = 3;
            $id2 = null;
            $test_client2 = new Client($name2, $stylist_id2, $id2);

            //act
            $test_client->save();
            $test_client2->save();
            $result = Client::getAll();

            //assert
            $this->assertEquals($result, [$test_client, $test_client2]);
        }

        function test_deleteAll() {
            //arrange
            $name = 'sarah is god';
            $stylist_id = 2;
            $id = null;
            $test_client = new Client($name,$stylist_id, $id);

            $name2 = 'shrek is life';
            $stylist_id2 = 3;
            $id2 = null;
            $test_client2 = new Client($name2, $stylist_id2, $id2);

            //act
            $test_client->save();
            $test_client2->save();
            Client::deleteAll();
            $result = Client::getAll();

            //assert
            $this->assertEquals($result, []);
        }

        function test_find() {
            //arrange
            $name = 'sarah is god';
            $stylist_id = 2;
            $id = null;
            $test_client = new Client($name,$stylist_id, $id);

            $name2 = 'shrek is life';
            $stylist_id2 = 3;
            $id2 = null;
            $test_client2 = new Client($name2, $stylist_id2, $id2);

            //act
            $test_client->save();
            $test_client2->save();
            $result = Client::find($test_client2->getId());

            //assert
            $this->assertEquals($result, $test_client2);
        }

        function test_update() {
            //arrange
            $name = 'sarah is god';
            $stylist_id = 2;
            $id = null;
            $test_client = new Client($name,$stylist_id, $id);

            $name2 = 'shrek is life';
            $stylist_id2 = 3;


            //act
            $test_client->save();
            $test_client->update($name2, $stylist_id2);
            $result = Client::getAll();
            $test_client->setName($name2);
            $test_client->setStylist_id($stylist_id2);

            //assert
            $this->assertEquals($result[0], $test_client);

        }

        function test_delete() {
            //arrange
            $name = 'sarah is god';
            $stylist_id = 2;
            $id = null;
            $test_client = new Client($name,$stylist_id, $id);

            $name2 = 'shrek is life';
            $stylist_id2 = 3;
            $id2 = null;
            $test_client2 = new Client($name2, $stylist_id2, $id2);

            //act
            $test_client->save();
            $test_client2->save();
            $test_client->delete();
            $result = Client::getAll();

            //assert
            $this->assertEquals($result[0], $test_client2);

        }
    }
?>
