<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $root = dirname(__FILE__, 2);
    include_once $root.'/db/database.php';
    include_once $root.'/classes/notification.php';

    class Record {
        private $admin_id = 5;

        public $id;
        public $appnum;
        public $nowner;
        public $esname;
        public $author;
        public $address;
        public $bnature;
        public $area;
        public $contact;
        public $date;
        public $status; // compliant/non-compliant
        public $type; // 1- occupancy 2 - new business 3 - renewal
        public $client_id;
        public $amount;
        public $payment_review_date;
        public $no_of_storey;
        public $email;

        function get_records () {
            $db = new DB();
            $db->connect();

            $sql = "SELECT a.* FROM `record` as a 
                inner join `client` as b 
                on b.id = a.client_id
                where a.id > 0";

            $types = "";
            $params = array();
            $data = [];

            if ($this->id >0){
                $types = $types."i";
                $sql = $sql . " and a.id = ?";
                $params[] = $this->id;
            }

            if ($this->status != ""){
                $types = $types."s";
                $sql = $sql . " and a.status = ?";
                $params[] = $this->status;
            }

            if ($this->client_id > 0){
                $types = $types."i";
                $sql = $sql . " and a.client_id = ?";
                $params[] = $this->client_id;
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

            $sql = "SELECT a.*,b.email FROM `record` as a 
            inner join `client` as b 
            on b.id = a.client_id
            where a.id = ?";

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
                        $this->appnum = $row['appnum'];
                        $this->nowner = $row['nowner'];
                        $this->esname = $row['esname'];
                        $this->author = $row['autho'];
                        $this->address = $row['address'];
                        $this->bnature = $row['bnature'];
                        $this->area = $row['area'];
                        $this->contact = $row['contact'];
                        $this->date = $row['date'];
                        $this->status = $row['status'];
                        $this->type = $row['type'];
                        $this->client_id = $row['client_id'];
                        $this->amount = $row['amount'];
                        $this->payment_review_date = $row['payment_review_date'];
                        $this->email = $row['email'];
                        $this->no_of_storey = $row['no_of_storey'];
                    }
                // close the result.
                // mysqli_free_result($result);
            }
        }

        function count(){
            $db = new DB();
            $db->connect();

            $sql = "SELECT count(*) as cnt FROM `record` as a 
                inner join `client` as b 
                on b.id = a.client_id
                where a.id > 0";

            $types = "";
            $params = array();
            $data = [];

            if ($this->id >0){
                $types = $types."i";
                $sql = $sql . " and a.id = ?";
                $params[] = $this->id;
            }

            if ($this->status != "" && $this->status != "pending"){
                $types = $types."s";
                $sql = $sql . " and a.status = ?";
                $params[] = $this->status;
            }

            if ($this->status == "pending"){
                $types = $types."s";
                $sql = $sql . " and (a.status is null or a.status = '')";
            }

            if ($this->client_id > 0){
                $types = $types."i";
                $sql = $sql . " and a.client_id = ?";
                $params[] = $this->client_id;
            }

            // print($sql);
            // print_r($params);
            // print("status");
            // print($this->status);
            // die();

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
                    $cnt = $row['cnt'];
                }
            }
            
            return $cnt;
        }

        function Save(){
            $db = new DB();
            $db->connect();

            $sql = "
            insert into `record` 
                (
                    appnum,
                    nowner,
                    esname,
                    autho,
                    address,
                    bnature,
                    area,
                    contact,
                    date,
                    status,
                    type,
                    client_id,
                    no_of_storey
                )
            values
                (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                )
            ;";
            $stmt = $db->db->prepare($sql);
            $stmt->bind_param('ssssssssssiii', $this->appnum,$this->nowner,$this->esname,$this->author,
                $this->address,
                $this->bnature,
                $this->area,
                $this->contact,
                $this->date,
                $this->status,
                $this->type,
                $this->client_id,
                $this->no_of_storey
                );

            $stmt->execute();

            $stmt->close();
            $this->id = $db->get_last_id();

            $this->addNotification(true,"New Application Request added.");

            $db->close();

        }

        function appnum_exist(){
            $db = new DB();
            $db->connect();

            $sql = "SELECT * FROM record where appnum = ?;";

            $stmt = $db->prepare($sql);
            $stmt->bind_param('s', $this->appnum);

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
                    }
            }
        }

        function Update(){

            $db = new DB();
            $db->connect();
            $sql = "
            update `record` set
                status=?
            where id = ?
            ;";

            if ($this->status != "") {
                $stmt = $db->prepare($sql);
                $stmt->bind_param('si', $this->status,$this->id);
            }

            if ($this->appnum != "") {
                $sql = "
                update `record` set
                    appnum=?
                where id = ?
                ;";

                $stmt = $db->prepare($sql);
                $stmt->bind_param('si', $this->appnum,$this->id);
            }

            $stmt->execute();

            $stmt->close();

            $db->close();

            if ($this->status != "") {
                $this->get_record();
                if ($this->status == "Compliant") {
                    $message = $this->appnum . " is approved.";
                }else {
                    $message = $this->appnum . " is declined.";
                }
                $this->addNotification(false,$message);
            }
        }

        function add_payment(){

            $db = new DB();
            $db->connect();
            $sql = "
            update `record` set
                amount=?,
                payment_review_date=?
            where id = ?
            ;";

            $stmt = $db->prepare($sql);
            $stmt->bind_param('ssi', $this->amount,$this->payment_review_date,$this->id);

            $stmt->execute();

            $stmt->close();

            $db->close();

            // add notification for payment
            $this->get_record();
            $message = $this->amount. " payment amount is added for app No.:".$this->appnum;
            $this->addNotification(false,$message);
        }

        function delete(){
            $db = new DB();
            $db->connect();
            
            $sql = "
            delete from `record` where id = ?
            ;";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('i', $this->id);

            $stmt->execute();

            $stmt->close();

            $db->close();
        }

        function addNotification($admin,$message) {
            $notification = new Notification();
            $notification->type=1;
            $notification->ref_id = $this->admin_id;
            if (!$admin) {
                $notification->type=2;
                $notification->ref_id = $this->client_id;
            }
            
            $notification->obj_id = $this->id;
            $notification->viewed=0;
            $notification->message = $message;
            // $notification->message = "New Application Request added.";
            // if ($this->status == "Compliant") {
            //     $notification->message = "Request is approved.";
            // }
            // if ($this->status == "Non Compliant") {
            //     $notification->message = "Request is rejected.";
            // }
            $notification->save();
        }
    }
?>