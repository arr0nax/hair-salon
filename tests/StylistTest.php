<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
    require_once 'src/Stylist.php';


    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
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
            $this->assertEquals($result, 1);
        }
    }


 ?>
