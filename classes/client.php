<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $root = dirname(__FILE__, 2);
    include_once $root.'/db/database.php';

    class Client {

        public $id;
        public $name;
        public $username;
        public $email;
        public $password;

        function get_records () {
            $db = new DB();
            $db->connect();

            $sql = "SELECT * FROM `client` as a where a.id > 0";

            $types = "";
            $params = array();
            $data = [];

            if ($this->id >0){
                $types = $types."i";
                $sql = $sql . " and a.id = ?";
                $params[] = $this->id;
            }

            if ($this->username != ""){
                $types = $types."s";
                $sql = $sql . " and a.username = ?";
                $params[] = $this->username;
            }

            if ($this->email != ""){
                $types = $types."s";
                $sql = $sql . " and a.email = ?";
                $params[] = $this->email;
            }

            if (count($params) > 0){
                $stmt = $db->prepare($sql);
                $id = $this->id;
    
                // reset id
                $this->id=0;
    
                $stmt->bind_param($types, ...$params);
    
                $stmt->execute();
    
                $result = $stmt->get_result();
                $db->close();
                // return $result;
                if ($result)
                {
                    while($row = $result->fetch_assoc()) {
                        $data[]=$row;
                    }
                }
            }else {
                $result=$db->fetch($sql);
                $db->close();

                while($row = $result->fetch_assoc()) {
                    $data[]=$row;
                }
            }
            
            return $data;
        }

        function get_record() {
            $db = new DB();
            $db->connect();

            $sql = "SELECT * FROM `client` as a where a.id = ?";

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
                    }
                // close the result.
                // mysqli_free_result($result);
            }
        }

        function check_email_exist($email){
            $db = new DB();
            $db->connect();

            $sql = "SELECT * FROM `client` as a where a.email = ? || a.username = ?";

            $stmt = $db->prepare($sql);

            // reset id
            $this->id=0;

            $stmt->bind_param('ss', $email,$email);

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
                    }
                // close the result.
                // mysqli_free_result($result);
            }
        }


        function Save(){
            $db = new DB();
            $db->connect();

            $sql = "
            insert into `client` 
                (
                    name,
                    username,
                    email,
                    password
                )
            values
                (
                    ?,
                    ?,
                    ?,
                    ?
                )
            ;";
            $stmt = $db->db->prepare($sql);
            $stmt->bind_param('ssss', $this->name,$this->username,$this->email,$this->password);

            $stmt->execute();

            $stmt->close();
            $this->id = $db->get_last_id();

            $db->close();

        }

        function Update(){

            $db = new DB();
            $db->connect();

            $sql = "
            update `client` set
                password=?
            where id = ?
            ;";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('si', $this->password,$this->id);

            $stmt->execute();

            $stmt->close();

            $db->close();
        }

        function delete(){
            $db = new DB();
            $db->connect();
            
            $sql = "
            delete from `client` where id = ?
            ;";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('i', $this->id);

            $stmt->execute();

            $stmt->close();

            $db->close();
        }
    }
?>