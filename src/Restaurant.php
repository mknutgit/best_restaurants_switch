<?php
    class Task
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
        function getCategoryId()
        {
            return $this->category_id;
        }
        /* Getter for id */
        function getId()
        {
            return $this->id;
        }


        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO tasks (description, category_id, due) VALUES ('{$this->getDescription()}', {$this->getCategoryId()}, '{$this->getDue()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks ORDER BY due;");
            $tasks = array();
            foreach($returned_tasks as $task) {
                $description = $task['description'];
                $id = $task['id'];
                $category_id = $task['category_id'];
                $due = $task['due'];
                $new_task = new Task($description, $id, $category_id, $due);
                array_push($tasks, $new_task);
            }
            return $tasks;
        }

        static function deleteAll()
        {
           $GLOBALS['DB']->exec("DELETE FROM tasks;");
        }

        static function find($search_id)
        {
            $found_task = null;
            $tasks = Task::getAll();
            foreach ($tasks as $task){
                $task_id = $task->getID();
                if ($task_id == $search_id){
                    $found_task = $task;
                }
            }
            return $found_task;
        }
        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE tasks SET description = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setDescription($new_name);
        }
        function delete()
       {
           $GLOBALS['DB']->exec("DELETE FROM tasks WHERE id = {$this->getId()};");

       }

    }
?>
