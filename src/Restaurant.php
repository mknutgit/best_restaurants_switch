<?php
    class Restaurant
    {
        private $name;
        private $description;
        private $website;
        private $location;
        private $phone;
        private $cuisine_id;
        private $id;

        function __construct($name, $description, $website, $location, $phone, $cuisine_id, $id = null)
        {
            $this->name = $name;
            $this->description = $description;
            $this->website = $website;
            $this->location = $location;
            $this->phone = $phone;
            $this->cuisine_id = $cuisine_id;
            $this->id = $id;
        }
        /* Getter/Setter for name */
        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }
        /* Getter/Setter for description */
        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function getDescription()
        {
            return $this->description;
        }
        /*Getter/Setter for website*/
        function setWebsite($new_website)
        {
            $this->website = $new_website;
        }

        function getWebsite()
        {
            return $this->website;
        }
        /*Getter/Setter for location*/
        function setLocation($new_location)
        {
            $this->location = $new_location;
        }

        function getLocation()
        {
            return $this->location;
        }
        /*Getter/Setter for phone*/
        function setPhone($new_phone)
        {
            $this->phone = $new_phone;
        }

        function getPhone()
        {
            return $this->phone;
        }
        /* Getter for cuisine id */
        function getCuisineId()
        {
            return $this->cuisine_id;
        }
        /* Getter for id */
        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, description, website, location, phone, cuisine_id) VALUES ('{$this->getName()}', '{$this->getDescription()}', '{$this->getWebsite()}', '{$this->getLocation()}', '{$this->getPhone()}', {$this->getCuisineId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant) {
                $name = $restaurant['name'];
                $description = $restaurant['description'];
                $website = $restaurant['website'];
                $location = $restaurant['location'];
                $phone = $restaurant['phone'];
                $cuisine_id = $restaurant['cuisine_id'];
                $id = $restaurant['id'];
                $new_restaurant = new Restaurant($name, $description, $website, $location, $phone, $cuisine_id, $id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function deleteAll()
        {
           $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

        static function find($search_id)
        {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();
            foreach ($restaurants as $restaurant){
                $restaurant_id = $restaurant->getId();
                if ($restaurant_id == $search_id){
                    $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }
        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE restaurants SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }
        function delete()
       {
           $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE id = {$this->getId()};");

       }

    }
?>
