<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
    require_once 'src/Stylist.php';
    require_once 'src/Client.php';


    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function test_save() {
            //arrange
            $name = 'jack lantern';
            $id = null;
            $test_stylist = new Stylist($name, $id);

            //act
            $test_stylist->save();
            $result = Stylist::getAll();

            //assert
            $this->assertEquals($result[0], $test_stylist);
        }

        function test_getAll() {
            //arrange
            $name = 'jack lantern';
            $id = null;
            $test_stylist = new Stylist($name, $id);

            $name2 = 'hazel ween';
            $id2 = null;
            $test_stylist2 = new Stylist($name2, $id2);

            //act
            $test_stylist->save();
            $test_stylist2->save();
            $result = Stylist::getAll();

            //assert
            $this->assertEquals($result, [$test_stylist,$test_stylist2]);
        }

        function test_deleteAll() {
            //arrange
            $name = 'jack lantern';
            $id = null;
            $test_stylist = new Stylist($name, $id);

            $name2 = 'hazel ween';
            $id2 = null;
            $test_stylist2 = new Stylist($name2, $id2);

            //act
            $test_stylist->save();
            $test_stylist2->save();
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //assert
            $this->assertEquals($result, []);
        }

        function test_find() {
            //arrange
            $name = 'jack lantern';
            $id = null;
            $test_stylist = new Stylist($name, $id);

            $name2 = 'hazel ween';
            $id2 = null;
            $test_stylist2 = new Stylist($name2, $id2);

            //act
            $test_stylist->save();
            $test_stylist2->save();
            $result = Stylist::find($test_stylist2->getId());

            //assert
            $this->assertEquals($result, $test_stylist2);
        }

        function test_update() {
            //arrange
            $name = 'jack lantern';
            $id = null;
            $test_stylist = new Stylist($name, $id);

            $name2 = 'hazel ween';
            $id2 = null;

            //act
            $test_stylist->save();
            $test_stylist->update($name2);
            $result = Stylist::getAll();
            $test_stylist->setName($name2);

            //assert
            $this->assertEquals($result[0], $test_stylist);
        }

        function test_delete() {
            //arrange
            $name = 'jack lantern';
            $id = null;
            $test_stylist = new Stylist($name, $id);

            $name2 = 'hazel ween';
            $id2 = null;
            $test_stylist2 = new Stylist($name2, $id2);

            //act
            $test_stylist->save();
            $test_stylist2->save();
            $test_stylist->delete();
            $result = Stylist::getAll();

            //assert
            $this->assertEquals($result[0], $test_stylist2);

        }

        function test_getClients() {
            //arrange
            $stylist_name = 'jack lantern';
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $stylist_name2 = 'hazel ween';
            $id2 = null;
            $test_stylist2 = new Stylist($stylist_name2, $id2);
            $test_stylist2->save();

            $client_name = 'sarah is god';
            $stylist_id = $test_stylist2->getId();
            $id = null;
            $test_client = new Client($client_name,$stylist_id, $id);
            $test_client->save();

            $client_name2 = 'shrek is life';
            $stylist_id2 = $test_stylist->getId();
            $id2 = null;
            $test_client2 = new Client($client_name2, $stylist_id2, $id2);
            $test_client2->save();

            //act
            $result = $test_stylist->getClients();

            //assert
            $this->assertEquals($result, [$test_client2]);

        }
    }


 ?>
