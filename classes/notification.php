<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $root = dirname(__FILE__, 2);
    include_once $root.'/db/database.php';

    class Notification {

        public $id;
        public $type; // 1-admin 2- client
        public $ref_id; // client or admin id
        public $viewed;
        public $message;
        public $date;
        public $obj_id;

        public $limit = 5;

        public $offset = 0;

        function get_records () {
            $db = new DB();
            $db->connect();

            $sql = "SELECT * FROM `notification` as a where a.id > 0";

            $types = "";
            $params = array();
            $data = [];

            if ($this->id >0){
                $types = $types."i";
                $sql = $sql . " and a.id = ?";
                $params[] = $this->id;
            }

            if ($this->type > 0){
                $types = $types."i";
                $sql = $sql . " and a.type = ?";
                $params[] = $this->type;
            }

            if ($this->ref_id > 0){
                $types = $types."i";
                $sql = $sql . " and a.ref_id = ?";
                $params[] = $this->ref_id;
            }

            $sql = $sql. " order by id desc";

            $sql = $sql . " limit " . $this->offset . $this->limit;

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

        function count () {
            $db = new DB();
            $db->connect();

            $sql = "SELECT count(*) as cnt FROM `notification` as a where a.id > 0";

            $types = "";
            $params = array();
            $data = [];

            if ($this->id >0){
                $types = $types."i";
                $sql = $sql . " and a.id = ?";
                $params[] = $this->id;
            }

            if ($this->type > 0){
                $types = $types."i";
                $sql = $sql . " and a.type = ?";
                $params[] = $this->type;
            }

            if ($this->ref_id > 0){
                $types = $types."i";
                $sql = $sql . " and a.ref_id = ?";
                $params[] = $this->ref_id;
            }

            if ($this->viewed >= 0){
                $types = $types."i";
                $sql = $sql . " and a.viewed = ?";
                $params[] = $this->viewed;
            }

            $cnt = 0;

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
                        $cnt = $row['cnt'];
                    }
                }
            }else {
                $result=$db->fetch($sql);
                $db->close();

                while($row = $result->fetch_assoc()) {
                    $data[]=$row;
                }
            }
            
            return $cnt;
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
                        $this->type = $row['type'];
                        $this->ref_id = $row['ref_id'];
                        $this->viewed = $row['viewed'];
                        $this->message = $row['message'];
                        $this->date = $row['date'];
                    }
                // close the result.
                // mysqli_free_result($result);
            }
        }

        function Save(){
            $db = new DB();
            $db->connect();

            $sql = "
            insert into `notification` 
                (
                    type,
                    ref_id,
                    viewed,
                    message,
                    date,
                    obj_id
                )
            values
                (
                    ?,
                    ?,
                    ?,
                    ?,
                    now(),
                    ?
                )
            ;";
            $stmt = $db->db->prepare($sql);
            $stmt->bind_param('iiisi', $this->type,$this->ref_id,$this->viewed,$this->message,$this->obj_id);

            $stmt->execute();

            $stmt->close();

            $db->close();

        }

        function Update(){

            $db = new DB();
            $db->connect();

            $sql = "
            update `notification` set
                viewed=?
            where id = ?
            ;";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('ii', $this->viewed,$this->id);

            $stmt->execute();

            $stmt->close();

            $db->close();
        }

        function set_viewed(){

            $db = new DB();
            $db->connect();

            $sql = "
            update `notification` set
                viewed=1
            where ref_id = ? and type = ?
            ;";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('ii',$this->ref_id, $this->type);

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