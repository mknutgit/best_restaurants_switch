<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=best_restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $type = "Indian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Taste of India";
            $description = "A great place for chapati.";
            $website = "http://www.tasteofindia.com";
            $location = "1st and 3rd";
            $phone = "5032330998";
            $cuisine_id = $test_cuisine->getId();

            $test_restaurant = new Restaurant($name, $description, $website, $location, $phone, $cuisine_id, $id);

            //Act
            $test_restaurant->save();
            // var_dump($test_restaurant);
            //Assert
            $result = Restaurant::getAll();
            // var_dump($result);

            $this->assertEquals($test_restaurant, $result[0]);
        }

        function test_adjustPunctuation()
        {
            $type = "Chinese";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Bill's grill and Aundra's noodles";
            $description = "A great place for chapati.";
            $website = "http://www.tasteofindia.com";
            $location = "1st and 3rd";
            $phone = "5032330998";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $description, $website, $location, $phone, $cuisine_id, $id);
            $test_restaurant->save();

            $result = Restaurant::getAll();

            $this->assertEquals("Bill's grill and Aundra's noodles", $result[0]->getName());
        }

        function test_getAll()
        {
            //Arrange
            $type = "Indian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Taste of India";
            $cuisine_id = $test_cuisine->getId();
            $description = "A great place for chapati.";
            $website = "http://www.tasteofindia.com";
            $location = "1st and 3rd";
            $phone = "5032330998";

            $name2 = "Best of India";
            $description2 = "A great place for dal.";
            $website2 = "http://www.bestofindia.com";
            $location2 = "2nd and 3rd";
            $phone2 = "5032334438";

            $test_restaurant = new Restaurant($name, $description, $website, $location, $phone, $cuisine_id, $id);
            $test_restaurant->save();
            $test_restaurant2 = new Restaurant($name2, $description2, $website2, $location2, $phone2, $cuisine_id, $id);
            $test_restaurant2->save();
            //Act
            $result = Restaurant::getAll();
            // var_dump($result);
            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }
        function test_deleteAll()
        {
            //Arrange
            $type = "Indian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Taste of India";
            $cuisine_id = $test_cuisine->getId();
            $description = "A great place for chapati.";
            $website = "http://www.tasteofindia.com";
            $location = "1st and 3rd";
            $phone = "5032330998";

            $name2 = "Best of India";
            $description2 = "A great place for dal.";
            $website2 = "http://www.bestofindia.com";
            $location2 = "2nd and 3rd";
            $phone2 = "5032334438";

            $test_restaurant = new Restaurant($name, $description, $website, $location, $phone, $cuisine_id, $id);
            $test_restaurant->save();
            $test_restaurant2 = new Restaurant($name2, $description2, $website2, $location2, $phone2, $cuisine_id, $id);
            $test_restaurant2->save();

            //Act
            Restaurant::deleteAll();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals([], $result);
        }

        function test_getId()
        {
            //Arrange
            $type = "Indian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Taste of India";
            $cuisine_id = $test_cuisine->getId();
            $description = "A great place for chapati.";
            $website = "http://www.tasteofindia.com";
            $location = "1st and 3rd";
            $phone = "5032330998";

            $test_restaurant = new Restaurant($name, $description, $website, $location, $phone, $cuisine_id, $id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_find()
        {
            //Arrange
            $type = "Indian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Taste of India";
            $cuisine_id = $test_cuisine->getId();
            $description = "A great place for chapati.";
            $website = "http://www.tasteofindia.com";
            $location = "1st and 3rd";
            $phone = "5032330998";

            $name2 = "Best of India";
            $description2 = "A great place for dal.";
            $website2 = "http://www.bestofindia.com";
            $location2 = "2nd and 3rd";
            $phone2 = "5032334438";

            $test_restaurant = new Restaurant($name, $description, $website, $location, $phone, $cuisine_id, $id);
            $test_restaurant->save();
            $test_restaurant2 = new Restaurant($name2, $description2, $website2, $location2, $phone2, $cuisine_id, $id);
            $test_restaurant2->save();

            //Act

            $result = Restaurant::find($test_restaurant->getId());

            //Assert
            $this->assertEquals($test_restaurant, $result);
        }
        function testUpdate()
        {
            //Arrange
            $name = "Taste of India";
            $description = "A great place for chapati.";
            $website = "http://www.tasteofindia.com";
            $location = "1st and 3rd";
            $phone = "5032330998";
            $cuisine_id = 1;
            $id = null;
            $test_restaurant = new Restaurant($name, $description, $website, $location, $phone, $cuisine_id, $id);
            $test_restaurant->save();

            $new_name = "Feast of India";

            //Act
            $test_restaurant->update($new_name);

            //Assert
            $this->assertEquals("Feast of India", $test_restaurant->getName());
        }
        function testDelete()
        {
            //Arrange
            $name = "Taste of India";
            $description = "A great place for chapati.";
            $website = "http://www.tasteofindia.com";
            $location = "1st and 3rd";
            $phone = "5032330998";
            $cuisine_id = 1;
            $id = null;

            $name2 = "Best of India";
            $description2 = "A great place for dal.";
            $website2 = "http://www.bestofindia.com";
            $location2 = "2nd and 3rd";
            $phone2 = "5032334438";
            $cuisine_id2 = 2;

            $test_restaurant = new Restaurant($name, $description, $website, $location, $phone, $cuisine_id, $id);
            $test_restaurant->save();
            $test_restaurant2 = new Restaurant($name2, $description2, $website2, $location2, $phone2, $cuisine_id2, $id);
            $test_restaurant2->save();


            //Act
            $test_restaurant->delete();

            //Assert
            $this->assertEquals([$test_restaurant2], Restaurant::getAll());
        }
    }
 ?>
