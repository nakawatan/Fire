<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $root = dirname(__FILE__, 2);
    include $root.'/classes/client.php';
    include $root.'/classes/notification.php';
    include $root.'/classes/record.php';
    include $root.'/classes/user.php';
    include $root.'/classes/scheduler.php';
    $result["status"] = "ok";

    if (isset($_REQUEST['method'])){
        $method = $_REQUEST['method'];
        switch ($method) {
            case "login_client":
                $obj = new Client();

                // check if email exist
                $obj->check_email_exist($_REQUEST['email']);
                if ($obj->id == 0) {
                    $obj->name=$_REQUEST['name'];
                    $obj->username=$_REQUEST['username'];
                    $obj->email=$_REQUEST['email'];
                    $obj->password=$_REQUEST['password'];
                    $obj->save();
                    
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['username'] = $obj->username;
                    $_SESSION['name'] = $obj->name;
                    $_SESSION['id'] = $obj->id;
                    $_SESSION['type'] = "2";

                    $result["status"] = "ok";
                    $result["users"]=$obj;
                }else {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['username'] = $obj->username;
                    $_SESSION['name'] = $obj->name;
                    $_SESSION['id'] = $obj->id;
                    $_SESSION['type'] = "2";

                    $result["status"] = "ok";
                }
                break;

            case "check_client":
                $obj = new Client();

                // check if email exist
                $obj->check_email_exist($_REQUEST['email']);
                $result["status"] = "ok";
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['username'] = $obj->username;
                $_SESSION['name'] = $obj->name;
                $_SESSION['id'] = $obj->id;
                $_SESSION['type'] = "2";
                
                $result['exist']= $obj->id > 0;
                break;

            case "get_notification_count":
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                $obj = new Notification();

                // check if email exist
                // $obj->type = $_REQUEST['type'];
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $obj->ref_id = $_SESSION['id'];
                $obj->type = $_SESSION['type'];
                $obj->viewed = 0;
                $result["status"] = "ok";
                $result['count'] = $obj->count();
                break;

            case "get_notifications":
                $obj = new Notification();

                // check if email exist
                // $obj->type = $_REQUEST['type'];
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $obj->ref_id = $_SESSION['id'];
                $obj->type = $_SESSION['type'];
                if (isset($_REQUEST['offset'])){
                    $obj->offset = $_REQUEST['offset'] * $obj->limit;
                }

                $result["status"] = "ok";
                $result['records'] = $obj->get_records();
                $result['offset'] = $obj->offset;
                $obj->set_viewed();
                break;

            case "get_metrics":
                $obj = new Record();

                // get all records count
                $arr = array();
                $arr ['records'] = $obj->count();

                // get declined records
                $obj = new Record();
                $obj->status = "Non Compliant";
                $arr ['declined'] = $obj->count();

                // get pending records
                $obj = new Record();
                $obj->status = "pending";
                $arr ['processing'] = $obj->count();

                // get finished records
                $obj = new Record();
                $obj->status = "Compliant";
                $arr ['finish'] = $obj->count();
                
                $result['metrics'] = $arr;
                break;

            case "update_record":
                $obj = new Record();
                $obj->id = $_REQUEST['id'];
                if (isset ($_REQUEST['status'])) {
                    $obj->status = $_REQUEST['status'];
                }
                if (isset ($_REQUEST['app_num'])) {
                    $obj->appnum = $_REQUEST['app_num'];
                }
                $obj->update();
                break;

            case "add_payment":
                $obj = new Record();
                $obj->id = $_REQUEST['id'];
                $obj->amount = $_REQUEST['amount'];
                $obj->payment_review_date = $_REQUEST['payment_review_date'];
                $obj->add_payment();
                break;

            case "delete_record":
                $obj = new Record();
                $obj->id = $_REQUEST['id'];
                $obj->delete();
                break;

            case "get_schedules":
                $obj = new Scheduler();

                $data = [];
                foreach($obj->get_records() as $rec) {
                    $arr = array();
                    $arr['title'] = $rec['title'];
                    $arr['start'] = date_format(date_create($rec['datetime']),"Y-m-d");
                    $arr['details'] = htmlspecialchars($rec['details']);
                    $arr['color'] = "#02a102";
                    $arr['obj_id'] = $rec['id'];
                    $data[] = $arr; 
                }

                $result = $data;
                break;
            
            case "add_schedule":
                $obj = new Scheduler();
                $obj->date = $_REQUEST['date'];
                $obj->title = $_REQUEST['title'];
                $obj->details = $_REQUEST['details'];
                $obj->save();
                break;
            case "update_schedule":
                $obj = new Scheduler();
                $obj->id = $_REQUEST['id'];
                $obj->title = $_REQUEST['title'];
                $obj->details = $_REQUEST['details'];
                $obj->Update();
                break;
            case "delete_schedule":
                $obj = new Scheduler();
                $obj->id = $_REQUEST['id'];
                $obj->delete();
                break;

            case "change_admin_password";
                $user = new User();
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $user->id = $_SESSION['id'];
                $password_matcher = $user->check_password_match($_REQUEST['current_password']);
                if ($password_matcher){
                    $result['status'] = "error";
                    $result['msg'] = "Incorrect current password.";
                }else {
                    $user->password = $_REQUEST['new_password'];
                    $user->Update();
                    unset($_SESSION);
                }
                break;

            default:
                $result["status"]="error";
                $result["msg"]="Invalid method";
        }
    }else {
        $result["status"]="error";
        $result["msg"]="Method not set.";
    }

    echo json_encode($result);
?>