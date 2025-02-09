<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $root = dirname(__FILE__, 2);
    include_once $root.'/db/database.php';
    include_once $root.'/classes/notification.php';
    include_once $root.'/classes/record.php';

    class RenewalBusinessDoc {

        public $id;
        public $business_permit_fee;
        public $fire_insurance;
        public $fsmr;
        public $fire_safety_clearance;
        public $business_permit_fee_status;
        public $fire_insurance_status;
        public $fsmr_status;
        public $fire_safety_clearance_status;
        public $record_id;

        function get_records () {
            $db = new DB();
            $db->connect();

            $sql = "SELECT a.* FROM `renewal_documents` as a 
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

            $sql = "SELECT a.* FROM `renewal_documents` as a 
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
                        $this->fsmr = $row['fsmr'];
                        $this->business_permit_fee = $row['business_permit_fee'];
                        $this->fire_safety_clearance = $row['fire_safety_clearance'];
                        $this->fire_insurance = $row['fire_insurance'];
                        $this->fsmr_status = $row['fsmr_status'];
                        $this->business_permit_fee_status = $row['business_permit_fee_status'];
                        $this->fire_safety_clearance_status = $row['fire_safety_clearance_status'];
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
            update `renewal_documents` 
                SET ${name} = ?
                WHERE id = ?
            ;";
            $stmt = $db->db->prepare($sql);
            $stmt->bind_param('ii',$status,$this->id);

            $stmt->execute();

            $stmt->close();

            $db->close();

            $filename = array();
            $filename['business_permit_fee_status'] = "ASSESSMENT OF THE BUSINESS PERMIT FEE/TAX ASSESSMENT BILL FROM BPLO";
            $filename['fire_insurance_status'] = "COPY OF FIRE INSURANCE";
            $filename['fsmr_status'] = "ONE (1) SET OF FIRE SAFETY MAINTENANCE REPORT (FSMR)";
            $filename['fire_safety_clearance_status'] = "FIRE SAFETY CLEARANCE FOR WELDING, CUTTING AND OTHER HOT WORK OPERATIONS";
            $filename['certificate_of_occupancy_status'] = "CERTIFIED TRUE COPY OF VALID CERTIFICATE OF OCCUPANCY";
            $filename['business_permit_fee_status'] = "ASSESSMENT OF BUSINESS PERMIT FEE/ TAX ASSESSMENT BILL FROM BPLO";
            $filename['appidavit_of_undertaking_status'] = "AFFIDAVIT OF UNDERTAKING THAT THERE WAS NO SUBSTANTIAL CHANGES MADE ON BUILDING/ESTABLISHMENT";
            $filename['fire_insurance_status'] = "COPY OF FIRE INSURANCE";
            $filename['obo_endoursement_status'] = "ENDORSEMENT FROM OFFICE OF THE BUILDING OFFICIAL";
            $filename['certificate_of_completion_status'] = "CERTIFICATE OF COMPLETION";
            $filename['assessment_fee_status'] = "CERTIFIED TRUE COPY OF ASSESSMENT FEE FOR SECURING CERTIFICATE OF OCCUPANCY FROM OBO";
            $filename['as_built_plan_status'] = "AS-BUILT PLAN";
            $filename['fsccr_status'] = "ONE (1) SET OF FIRE SAFETY COMPLIANCE AND COMMISSIONING REPORT (FSCCR)";

            $status_str = "approved";
            if ($status == 0){
            $status_str = "declined";
            }

            $message = $filename[$name] . " is " .$status_str;
            $this->addNotification($message);
        }

        function Save(){
            $db = new DB();
            $db->connect();

            $sql = "
            insert into `renewal_documents` 
                (
                    business_permit_fee,
                    fire_insurance,
                    fsmr,
                    fire_safety_clearance,
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
            $stmt->bind_param('ssssi', $this->business_permit_fee,$this->fire_insurance,$this->fsmr,$this->fire_safety_clearance,
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
            delete from `renewal_documents` where id = ?
            ;";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('i', $this->id);

            $stmt->execute();

            $stmt->close();

            $db->close();
        }

        function UploadFile() {
            $t=time();
            if(isset($_FILES['business-permit-input'])){
                $errors= array();
                $file_name = $_FILES['business-permit-input']['name'];
                $file_size =$_FILES['business-permit-input']['size'];
                $file_tmp =$_FILES['business-permit-input']['tmp_name'];
                
                $root = dirname(__FILE__, 2);
                $tempDir = $root."/upload/docs/";
                $filename=$tempDir.$t.$file_name;
                $this->business_permit_fee="/upload/docs/".$t.$file_name;
    
                move_uploaded_file($file_tmp,$filename);
            }
            if(isset($_FILES['cof-insurance-input'])){
                $errors= array();
                $file_name = $_FILES['cof-insurance-input']['name'];
                $file_size =$_FILES['cof-insurance-input']['size'];
                $file_tmp =$_FILES['cof-insurance-input']['tmp_name'];
                
                $root = dirname(__FILE__, 2);
                $tempDir = $root."/upload/docs/";
                $filename=$tempDir.$t.$file_name;
                $this->fire_insurance="/upload/docs/".$t.$file_name;
    
                move_uploaded_file($file_tmp,$filename);
            }
            if(isset($_FILES['fsmr-input'])){
                $errors= array();
                $file_name = $_FILES['fsmr-input']['name'];
                $file_size =$_FILES['fsmr-input']['size'];
                $file_tmp =$_FILES['fsmr-input']['tmp_name'];
                
                $root = dirname(__FILE__, 2);
                $tempDir = $root."/upload/docs/";
                $filename=$tempDir.$t.$file_name;
                $this->fsmr="/upload/docs/".$t.$file_name;
    
                move_uploaded_file($file_tmp,$filename);
            }

            if(isset($_FILES['fscfw-input'])){
                $errors= array();
                $file_name = $_FILES['fscfw-input']['name'];
                $file_size =$_FILES['fscfw-input']['size'];
                $file_tmp =$_FILES['fscfw-input']['tmp_name'];
                
                $root = dirname(__FILE__, 2);
                $tempDir = $root."/upload/docs/";
                $filename=$tempDir.$t.$file_name;
                $this->fire_safety_clearance="/upload/docs/".$t.$file_name;
    
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