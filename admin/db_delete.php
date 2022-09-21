<?php  

if(isset($_GET['id'])){
   include "db/db_con.php";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

	$id = validate($_GET['id']);

	$sql = "DELETE FROM staff
	        WHERE id=$id";
   $result = mysqli_query($con, $sql);
   if ($result) {
   	  header("Location: staff.php?success=successfully deleted");
   }else {
      header("Location: staff.php?error=unknown error occurred&$user_data");
   }

}else {
	header("Location: staff.php");
}