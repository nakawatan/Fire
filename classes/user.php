<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $root = dirname(__FILE__, 2);
    include_once $root.'/db/database.php';

    class User {

        public $id;
        public $name;
        public $username;
        public $email;
        public $password;

        function get_record() {
            $db = new DB();
            $db->connect();

            $sql = "SELECT * FROM `user` as a where a.id = ?";

            $stmt = $db->prepare($sql);
            $id = $this->id;

            // reset id
            $this->id=0;

            $stmt->bind_param('i', $id);

            $stmt->execute();

            $result = $stmt->get_result();
            $db->close();
            // return $result;
            if ($result)
            {
                // it return number of rows in the table.
                if ($result->num_rows > 0)
                    {
                        $row = $result->fetch_assoc();
                        $this->id = $row['id'];
                        $this->name = $row['name'];
                        $this->username = $row['username'];
                        $this->password = $row['password'];
                    }
                // close the result.
                // mysqli_free_result($result);
            }
        }

        function check_password_match($new_password) {
            $this->get_record();
            return $this->password != md5($new_password);
        }

        function Update(){

            $db = new DB();
            $db->connect();

            $sql = "
            update `user` set
                password=md5(?)
            where id = ?
            ;";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('si', $this->password,$this->id);

            $stmt->execute();

            $stmt->close();

            $db->close();
        }
    }
?>