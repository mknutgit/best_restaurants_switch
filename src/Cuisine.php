<?php
    class Cuisine
    {
        private $type;
        private $id;

        function __construct($type, $id = null)
        {
            $this->type = $type;
            $this->id = $id;
        }

        function setType($new_type)
        {
            $this->type = (string) $new_type;
        }

        function getType()
        {
            return $this->type;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cuisines (type) VALUES ('{$this->getType()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $cuisine) {
                $type = $cuisine['type'];
                $id = $cuisine['id'];
                $new_cuisine = new Cuisine($type, $id);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM cuisines;");
        }

        static function find($search_id)
        {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine) {
                $cuisine_id = $cuisine->getId();
                if ($cuisine_id == $search_id) {
                  $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }

        function getTasks()
        {
            $tasks = Array();
            $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks WHERE cuisine_id = {$this->getId()} ORDER BY due");
            foreach($returned_tasks as $task) {
                $description = $task['description'];
                $id = $task['id'];
                $cuisine_id = $task['cuisine_id'];
                $due = $task['due'];
                $new_task = new Task($description, $id, $cuisine_id, $due);
                array_push($tasks, $new_task);
            }
            return $tasks;
        }

        function update($new_type)
        {
            $GLOBALS['DB']->exec("UPDATE cuisines SET type = '{$new_type}' WHERE id = {$this->getId()};");
            $this->setType($new_type);
        }
        function delete()
       {
           $GLOBALS['DB']->exec("DELETE FROM cuisines WHERE id = {$this->getId()};");
           $GLOBALS['DB']->exec("DELETE FROM tasks WHERE cuisine_id = {$this->getId()};");
       }
    }
?>
