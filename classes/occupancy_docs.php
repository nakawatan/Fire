<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $root = dirname(__FILE__, 2);
    include_once $root.'/db/database.php';

    class OccupancyDocs {

        public $id;
        public $obo_endoursement;
        public $certificate_of_completion;
        public $assessment_fee;
        public $as_built_plan;
        public $fsccr;
        public $record_id;

        function get_records () {
            $db = new DB();
            $db->connect();

            $sql = "SELECT a.* FROM `occupancy_doc` as a 
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

            $sql = "SELECT a.* FROM `occupancy_doc` as a 
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
                        $this->obo_endoursement = $row['obo_endoursement'];
                        $this->certificate_of_completion = $row['certificate_of_completion'];
                        $this->assessment_fee = $row['assessment_fee'];
                        $this->as_built_plan = $row['as_built_plan'];
                        $this->fsccr = $row['fsccr'];
                        $this->record_id = $row['record_id'];
                    }
                // close the result.
                // mysqli_free_result($result);
            }
        }

        function Save(){
            $db = new DB();
            $db->connect();

            $sql = "
            insert into `occupancy_doc` 
                (
                    obo_endoursement,
                    certificate_of_completion,
                    assessment_fee,
                    as_built_plan,
                    fsccr,
                    record_id
                )
            values
                (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                )
            ;";
            $stmt = $db->db->prepare($sql);
            $stmt->bind_param('sssssi', $this->obo_endoursement,$this->certificate_of_completion,$this->assessment_fee,$this->as_built_plan,
                $this->fsccr,
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
            delete from `occupancy_doc` where id = ?
            ;";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('i', $this->id);

            $stmt->execute();

            $stmt->close();

            $db->close();
        }
        function UploadFile() {
            $t=time();
            if(isset($_FILES['obo-input'])){
                $errors= array();
                $file_name = $_FILES['obo-input']['name'];
                $file_size =$_FILES['obo-input']['size'];
                $file_tmp =$_FILES['obo-input']['tmp_name'];
                // $file_type=$_FILES['obo-input']['type'];
                // $file_ext=strtolower(end(explode('.',$_FILES['obo-input']['name'])));
                
                $root = dirname(__FILE__, 2);
                $tempDir = $root."/upload/docs/";
                $filename=$tempDir.$t.$file_name;
                $this->obo_endoursement="/upload/docs/".$t.$file_name;
    
                move_uploaded_file($file_tmp,$filename);
            }
            if(isset($_FILES['coc-input'])){
                $errors= array();
                $file_name = $_FILES['coc-input']['name'];
                $file_size =$_FILES['coc-input']['size'];
                $file_tmp =$_FILES['coc-input']['tmp_name'];
                // $file_type=$_FILES['coc-input']['type'];
                // $file_ext=strtolower(end(explode('.',$_FILES['coc-input']['name'])));
                
                $root = dirname(__FILE__, 2);
                $tempDir = $root."/upload/docs/";
                $filename=$tempDir.$t.$file_name;
                $this->certificate_of_completion="/upload/docs/".$t.$file_name;
    
                move_uploaded_file($file_tmp,$filename);
            }
            if(isset($_FILES['cto-sc-input'])){
                $errors= array();
                $file_name = $_FILES['cto-sc-input']['name'];
                $file_size =$_FILES['cto-sc-input']['size'];
                $file_tmp =$_FILES['cto-sc-input']['tmp_name'];
                // $file_type=$_FILES['cto-sc-input']['type'];
                // $file_ext=strtolower(end(explode('.',$_FILES['cto-sc-input']['name'])));
                
                $root = dirname(__FILE__, 2);
                $tempDir = $root."/upload/docs/";
                $filename=$tempDir.$t.$file_name;
                $this->assessment_fee="/upload/docs/".$t.$file_name;
    
                move_uploaded_file($file_tmp,$filename);
            }

            if(isset($_FILES['as-built-plan-input'])){
                $errors= array();
                $file_name = $_FILES['as-built-plan-input']['name'];
                $file_size =$_FILES['as-built-plan-input']['size'];
                $file_tmp =$_FILES['as-built-plan-input']['tmp_name'];
                // $file_type=$_FILES['as-built-plan-input']['type'];
                // $file_ext=strtolower(end(explode('.',$_FILES['as-built-plan-input']['name'])));
                
                $root = dirname(__FILE__, 2);
                $tempDir = $root."/upload/docs/";
                $filename=$tempDir.$t.$file_name;
                $this->as_built_plan="/upload/docs/".$t.$file_name;
    
                move_uploaded_file($file_tmp,$filename);
            }
            if(isset($_FILES['fsccr-input'])){
                $errors= array();
                $file_name = $_FILES['fsccr-input']['name'];
                $file_size =$_FILES['fsccr-input']['size'];
                $file_tmp =$_FILES['fsccr-input']['tmp_name'];
                // $file_type=$_FILES['fsccr-input']['type'];
                // $file_ext=strtolower(end(explode('.',$_FILES['fsccr-input']['name'])));
                
                $root = dirname(__FILE__, 2);
                $tempDir = $root."/upload/docs/";
                $filename=$tempDir.$t.$file_name;
                $this->fsccr="/upload/docs/".$t.$file_name;
    
                move_uploaded_file($file_tmp,$filename);
            }
        }
    }
?>