<?php 
include 'db/db_con.php';
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
if (isset($_POST['create'])) {
    $img=$_FILES['image']['name'];
    $title=$_POST['title'];
    $detail=$_POST['detail'];
    $date=$_POST['date'];
    
    $allowed_exttension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    
    $sql = "INSERT INTO `anno`(`image`, `title`, `detail`, `date`) 
    VALUES ('$img','$title','$detail','$date')";

    $result = mysqli_query($con,$sql);

    if ($result){
        move_uploaded_file($_FILES["image"]["tmp_name"], "img/".$_FILES["image"]["name"]);
        echo "<script>alert('Record inserted successfully');</script>";
        echo "<script>window.location.href='anno.php'</script>";
    }else{
        echo "<script>alert('Something wrong with the insertion of the records');</script>";
        echo "<script>window.location.href='anno-create.php'</script>";
    }
    
}
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                   <!-- DataTales Example -->
                   <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <div class="pull-left m-0 font-weight-bold text-primary"> Announcements</div>
                        </div>
                        <div class="card-body">
                                <form class="row" method="post" enctype="multipart/form-data">
                                    <div class="form-group col-md-12 ">
                                        <label>Titel</label>
                                        <input type="text" name="title" class="form-control form-control-line" placeholder="" required > 
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Details</label>
                                        <textarea name="detail" class="form-control form-control-line"></textarea> 
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Date</label>
                                        <input type="datetime-local" name="date" class="form-control form-control-line" placeholder="" required > 
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Image </label>
                                        <input type="file" name="image" class="form-control" value=""> 
                                    </div>
                                    <div class="form-actions col-md-12">
                                        <button type="submit" class="btn btn-primary" name="create"> <i class="fa fa-check"></i>Save</button>
                                        <a href="anno.php"><button type="button" class="btn btn-danger">Cancel</button></a>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
<?php include ('footer.php');?>