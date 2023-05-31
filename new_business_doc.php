<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $root = dirname(__FILE__, 2);
    include_once $root.'/db/database.php';
    include_once $root.'/classes/notification.php';
    include_once $root.'/classes/record.php';

    class NewBusinessDoc {

        public $id;
        public $certificate_of_occupancy;
        public $business_permit_fee;
        public $appidavit_of_undertaking;
        public $fire_insurance;
        public $certificate_of_occupancy_status;
        public $business_permit_fee_status;
        public $appidavit_of_undertaking_status;
        public $fire_insurance_status;
        public $record_id;

        function get_records () {
            $db = new DB();
            $db->connect();

            $sql = "SELECT a.* FROM `new_business_doc` as a 
                where a.id > 0";

            $types = "";
            $params = array();
            $data = [];

            if ($this->id >0){
                $types = $types."i";
                $sql = $sql . " and a.id = ?";
                $params[] = $this->id;
            }

            if ($this->record_id > 0){
                $types = $types."i";
                $sql = $sql . " and a.record_id = ?";
                $params[] = $this->record_id;
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

            $sql = "SELECT a.* FROM `new_business_doc` as a 
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
                        $this->certificate_of_occupancy = $row['certificate_of_occupancy'];
                        $this->business_permit_fee = $row['business_permit_fee'];
                        $this->appidavit_of_undertaking = $row['appidavit_of_undertaking'];
                        $this->fire_insurance = $row['fire_insurance'];
                        $this->certificate_of_occupancy_status = $row['certificate_of_occupancy_status'];
                        $this->business_permit_fee_status = $row['business_permit_fee_status'];
                        $this->appidavit_of_undertaking_status = $row['appidavit_of_undertaking_status'];
                        $this->fire_insurance_status = $row['fire_insurance_status'];
                        $this->record_id = $row['record_id'];
                    }
                // close the result.
                // mysqli_free_result($result);
            }
        }

        function update_doc_status($name,$status){
            $db = new DB();
            $db->connect();

            $sql = "
            update `new_business_doc` 
                SET ${name} = ?
                WHERE id = ?
            ;";
            
            $stmt = $db->db->prepare($sql);
            $stmt->bind_param('ii',$status,$this->id);

            $stmt->execute();

            $stmt->close();

            $db->close();
            
            $file = "";
            if ($name == "obo_endoursement_status") {
                $file = "ENDORSEMENT FROM OFFICE OF THE BUILDING OFFICIAL";
            }
            if ($name == "certificate_of_completion_status") {
                $file = "CERTIFICATE OF COMPLETION";
            }
            if ($name == "assessment_fee_status") {
                $file = "CERTIFIED TRUE COPY OF ASSESSMENT FEE FOR SECURING CERTIFICATE OF OCCUPANCY FROM OBO";
            }
            if ($name == "as_built_plan_status") {
                $file = "AS-BUILT PLAN";
            }
            if ($name == "fsccr_status") {
                $file = "ONE (1) SET OF FIRE SAFETY COMPLIANCE AND COMMISSIONING REPORT (FSCCR)";
            }
            
            $status_str = "approved";
            if ($status == 0){
            $status_str = "declined";
            }

            $message = $file . " is " .$status_str;
            $this->addNotification($message);
        }

        function Save(){
            $db = new DB();
            $db->connect();

            $sql = "
            insert into `new_business_doc` 
                (
                    certificate_of_occupancy,
                    business_permit_fee,
                    appidavit_of_undertaking,
                    fire_insurance,
                    record_id
                )
            values
                (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                )
            ;";
            $stmt = $db->db->prepare($sql);
            $stmt->bind_param('ssssi', $this->certificate_of_occupancy,$this->business_permit_fee,$this->appidavit_of_undertaking,$this->fire_insurance,
                $this->record_id
                );

            $stmt->execute();

            $stmt->close();

            $db->close();

        }

        function delete(){
            $db = new DB();
            $db->connect();
            
            $sql = "
            delete from `new_business_doc` where id = ?
            ;";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('i', $this->id);

            $stmt->execute();

            $stmt->close();

            $db->close();
        }
        function UploadFile() {
            $t=time();
            if(isset($_FILES['coo-input'])){
                $errors= array();
                $file_name = $_FILES['coo-input']['name'];
                $file_size =$_FILES['coo-input']['size'];
                $file_tmp =$_FILES['coo-input']['tmp_name'];
                
                $root = dirname(__FILE__, 2);
                $tempDir = $root."/upload/docs/";
                $filename=$tempDir.$t.$file_name;
                $this->certificate_of_occupancy="/upload/docs/".$t.$file_name;
    
                move_uploaded_file($file_tmp,$filename);
            }
            if(isset($_FILES['bus-permit-fee-input'])){
                $errors= array();
                $file_name = $_FILES['bus-permit-fee-input']['name'];
                $file_size =$_FILES['bus-permit-fee-input']['size'];
                $file_tmp =$_FILES['bus-permit-fee-input']['tmp_name'];
                
                $root = dirname(__FILE__, 2);
                $tempDir = $root."/upload/docs/";
                $filename=$tempDir.$t.$file_name;
                $this->business_permit_fee="/upload/docs/".$t.$file_name;
    
                move_uploaded_file($file_tmp,$filename);
            }
            if(isset($_FILES['appidavit-of-undertaking-input'])){
                $errors= array();
                $file_name = $_FILES['appidavit-of-undertaking-input']['name'];
                $file_size =$_FILES['appidavit-of-undertaking-input']['size'];
                $file_tmp =$_FILES['appidavit-of-undertaking-input']['tmp_name'];
                
                $root = dirname(__FILE__, 2);
                $tempDir = $root."/upload/docs/";
                $filename=$tempDir.$t.$file_name;
                $this->appidavit_of_undertaking="/upload/docs/".$t.$file_name;
    
                move_uploaded_file($file_tmp,$filename);
            }

            if(isset($_FILES['new-cof-insurance-input'])){
                $errors= array();
                $file_name = $_FILES['new-cof-insurance-input']['name'];
                $file_size =$_FILES['new-cof-insurance-input']['size'];
                $file_tmp =$_FILES['new-cof-insurance-input']['tmp_name'];
                
                $root = dirname(__FILE__, 2);
                $tempDir = $root."/upload/docs/";
                $filename=$tempDir.$t.$file_name;
                $this->fire_insurance="/upload/docs/".$t.$file_name;
    
                move_uploaded_file($file_tmp,$filename);
            }
        }

        function addNotification($message) {
            $this->get_record();
            $record = new Record();
            $record->id = $this->record_id;
            $record->get_record();
            $notification = new Notification();
            $notification->type=2;
            $notification->ref_id = $record->client_id;
            
            $notification->obj_id = $this->id;
            $notification->viewed=0;
            $notification->message = $message;
            $notification->save();
        }
    }
?>