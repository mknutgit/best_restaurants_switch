<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";
    require_once "src/Category.php";

    $server = 'mysql:host=localhost;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class TaskTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Task::deleteAll();
            Category::deleteAll();
        }

        function test_save()
        {
            //Arrange

            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $due = '2016-02-23';
            $test_task = new Task($description, $id, $category_id, $due);

            //Act
            $test_task->save();

            //Assert
            $result = Task::getAll();
            var_dump($test_task);
            $this->assertEquals($test_task, $result[0]);
        }
        function test_getAll()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $due = '2016-02-23';
            $description2 = "Water the lawn";
            $due2 = '2016-05-23';
            $test_task = new Task($description, $id, $category_id, $due);
            $test_task->save();
            $test_task2 = new Task($description2, $id, $category_id, $due2);
            $test_task2->save();

            //Act
            $result = Task::getAll();

            //Assert
            $this->assertEquals([$test_task, $test_task2], $result);
        }
        function test_deleteAll()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $due = '2016-02-23';
            $description2 = "Water the lawn";
            $due2 = '2016-05-23';
            $test_task = new Task($description, $id, $category_id, $due);
            $test_task->save();
            $test_task2 = new Task($description2, $id, $category_id, $due2);
            $test_task2->save();

            //Act
            Task::deleteAll();

            //Assert
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }

        function test_getId()
        {
            //Arrange

            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $due = '2016-05-23';
            $test_task = new Task($description, $id, $category_id, $due);
            $test_task->save();

            //Act
            $result = $test_task->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_find()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $due = '2016-02-23';
            $description2 = "Water the lawn";
            $due2 = '2016-05-23';
            $test_task = new Task($description, $id, $category_id, $due);
            $test_task->save();
            $test_task2 = new Task($description2, $id, $category_id, $due2);
            $test_task2->save();

            //Act

            $result = Task::find($test_task->getId());

            //Assert
            $this->assertEquals($test_task, $result);
        }
        function testUpdate()
        {
            //Arrange
            $name = "Work on car";
            $id = null;
            $category_id = 1;
            $due = 2016-02-24;
            $test_task = new Task($name, $id, $category_id, $due);
            $test_task->save();

            $new_name = "Work on car";

            //Act
            $test_task->update($new_name);

            //Assert
            $this->assertEquals("Work on car", $test_task->getDescription());
        }
        function testDelete()
        {
            //Arrange
            $name = "Work on car";
            $id = null;
            $category_id = 1;
            $due = 2016-02-24;
            $test_task = new Task($name, $id, $category_id, $due);
            $test_task->save();

            $name2 = "Throw rocks at blind";
            $id = null;
            $category_id2 = 2;
            $due2 = 2016-02-25;
            $test_task2 = new Task($name2, $id, $category_id2, $due2);
            $test_task2->save();


            //Act
            $test_task->delete();

            //Assert
            $this->assertEquals([$test_task2], Task::getAll());
        }
    }
 ?>
