<?php 
include 'db/db_con.php';
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM `record` WHERE id=$id";
    $result = mysqli_query($con,$sql);
    if ($result) {
        echo "<script>alert('Do you really want to delete?');</script>";
        echo "<script>window.location.href='request.php'</script>";
    }

}

?>