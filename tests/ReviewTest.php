<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";
    require_once "src/Review.php";

    $server = 'mysql:host=localhost;dbname=best_restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ReviewTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
          Review::deleteAll();
          Restaurant::deleteAll();
          Cuisine::deleteAll();
        }

        function test_getId()
        {
            $feedback = "Wonderful";
            $restaurant_id = 3;
            $id = 1;
            $test_review = new Review($feedback, $restaurant_id, $id);

            $result = $test_review->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_getFeedback()
        {
            $feedback = "Wonderful";
            $restaurant_id = 3;
            $id = null;
            $test_review = new Review($feedback, $restaurant_id, $id);

            $result = $test_review->getFeedback();

            $this->assertEquals($feedback, $result);
        }

        function test_getRestaurantId()
        {
            $feedback = "Wonderful";
            $restaurant_id = 3;
            $id = 1;
            $test_review = new Review($feedback, $restaurant_id, $id);

            $result = $test_review->getRestaurantId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Instance of Cuisine
            $type = "Indian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();
            //Instance of Restaurant
            $name = "Taste of India";
            $cuisine_id = $test_cuisine->getId();
            $description = "A great place for chapati.";
            $website = "http://www.tasteofindia.com";
            $location = "1st and 3rd";
            $phone = "5032330998";
            $test_restaurant = new Restaurant($name, $description, $website, $location, $phone, $cuisine_id, $id);
            $test_restaurant->save();
            //Instance of Review
            $feedback = "Wonderful";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($feedback, $restaurant_id, $id);
            $test_review->save();

            $result = Review::getAll();
            // var_dump($result);

            $this->assertEquals($test_review, $result[0]);
        }

        function test_deleteAll()
        {
            $type = "Indian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();
            //Instance of Restaurant
            $name = "Taste of India";
            $cuisine_id = $test_cuisine->getId();
            $description = "A great place for chapati.";
            $website = "http://www.tasteofindia.com";
            $location = "1st and 3rd";
            $phone = "5032330998";
            $test_restaurant = new Restaurant($name, $description, $website, $location, $phone, $cuisine_id, $id);
            $test_restaurant->save();
            //Instance of Review
            $feedback = "Wonderful";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($feedback, $restaurant_id, $id);
            $test_review->save();

            $feedback2 = "Delicious";
            $test_review2 = new Review($feedback2, $restaurant_id, $id);
            $test_review2->save();

            Review::deleteAll();

            $result = Review::getAll();
            $this->assertEquals([], $result);
        }

        function test_getAll()
        {
            $type = "Indian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();
            //Instance of Restaurant
            $name = "Taste of India";
            $cuisine_id = $test_cuisine->getId();
            $description = "A great place for chapati.";
            $website = "http://www.tasteofindia.com";
            $location = "1st and 3rd";
            $phone = "5032330998";
            $test_restaurant = new Restaurant($name, $description, $website, $location, $phone, $cuisine_id, $id);
            $test_restaurant->save();
            //Instance of Review
            $feedback = "Wonderful";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($feedback, $restaurant_id, $id);
            $test_review->save();

            $feedback2 = "Delicious";
            $test_review2 = new Review($feedback2, $restaurant_id, $id);
            $test_review2->save();

            $result = Review::getAll();
            $this->assertEquals([$test_review, $test_review2], $result);
        }
    }

    ?>
