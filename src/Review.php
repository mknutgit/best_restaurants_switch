<?php
    class Review
    {
        private $feedback;
        private $restaurant_id;
        private $id;

        function __construct($feedback, $restaurant_id, $id = null)
        {
            $this->feedback = $feedback;
            $this->restaurant_id = $restaurant_id;
            $this->id = $id;
        }

        function setFeedback($new_feedback)
        {
            $this->feedback = $new_feedback;
        }

        function getFeedback()
        {
            return $this->feedback;
        }

        function getId()
        {
            return $this->id;
        }

        function getRestaurantId()
        {
            return $this->restaurant_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO reviews (feedback, restaurant_id) VALUES ('{$this->getFeedback()}', {$this->getRestaurantId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews;");
            $reviews = array();
            foreach($returned_reviews as $review) {
                $feedback = $review['feedback'];
                $restaurant_id = $review['restaurant_id'];
                $id = $review['id'];
                $new_review = new Review($feedback, $restaurant_id, $id);
                array_push($reviews, $new_review);
            }
            return $reviews;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM reviews;");
        }

    }

 ?>
