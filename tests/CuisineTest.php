<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=best_restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
          Cuisine::deleteAll();
        //   Restaurant::deleteAll();
        }

        function test_getType()
        {
            //Arrange
            $type = "Indian";
            $test_Cuisine = new Cuisine($type);

            //Act
            $result = $test_Cuisine->getType();

            //Assert
            $this->assertEquals($type, $result);
        }

        function test_getId()
        {
            //Arrange
            $type = "Indian";
            $id = 1;
            $test_Cuisine = new Cuisine($type, $id);

            //Act
            $result = $test_Cuisine->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $type = "Indian";
            $test_Cuisine = new Cuisine($type);
            $test_Cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals($test_Cuisine, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $type = "Indian";
            $type2 = "Mexican";
            $test_Cuisine = new Cuisine($type);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($type2);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_Cuisine, $test_Cuisine2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $type = "Indian";
            $type2 = "Mexican";
            $test_Cuisine = new Cuisine($type);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($type2);
            $test_Cuisine2->save();

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $type = "Indian";
            $type2 = "Mexican";
            $test_Cuisine = new Cuisine($type);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($type2);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::find($test_Cuisine->getId());

            //Assert
            $this->assertEquals($test_Cuisine, $result);
        }

        // function testGetTasks()
        // {
        //     //Arrange
        //     $type = "Indian";
        //     $id = null;
        //     $test_cuisine = new Cuisine($type, $id);
        //     $test_cuisine->save();
        //
        //     $test_cuisine_id = $test_cuisine->getId();
        //
        //     $description = "Email client";
        //     $due = '2016-02-24';
        //     $test_task = new Task($description, $id, $test_cuisine_id, $due);
        //     $test_task->save();
        //
        //     $description2 = "Meet with boss";
        //     $due2 = '2016-02-25';
        //     $test_task2 = new Task($description2, $id, $test_cuisine_id, $due2);
        //     $test_task2->save();
        //
        //     //Act
        //     $result = $test_cuisine->getTasks();
        //
        //     //Assert
        //     $this->assertEquals([$test_task, $test_task2], $result);
        // }

        // function testUpdate()
        // {
        //     //Arrange
        //     $type = "Indian";
        //     $id = null;
        //     $test_cuisine = new Cuisine($type, $id);
        //     $test_cuisine->save();
        //
        //     $new_type = "Italian";
        //
        //     //Act
        //     $test_cuisine->update($new_type);
        //
        //     //Assert
        //     $this->assertEquals("Italian", $test_cuisine->getType());
        // }
        //
        // function testDelete()
        // {
        //     //Arrange
        //     $type = "Indian";
        //     $id = null;
        //     $test_cuisine = new Cuisine($type, $id);
        //     $test_cuisine->save();
        //
        //     $type2 = "Italian";
        //     $test_cuisine2 = new Cuisine($type2, $id);
        //     $test_cuisine2->save();
        //
        //
        //     //Act
        //     $test_cuisine->delete();
        //
        //     //Assert
        //     $this->assertEquals([$test_cuisine2], Cuisine::getAll());
        // }
    }

?>
