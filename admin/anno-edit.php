<?php 
include 'db/db_con.php';
include ('header.php');
include ('sidebar.php');
include ('topbar.php');
$id = $_GET['updateid'];
$sql = "SELECT * FROM `anno` WHERE `id`='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$title=$row['title'];
$detail=$row['detail'];
$date=$row['date'];
$img=$row['image'];


if (isset($_POST['update'])) {
    $title=$_POST['title'];
    $detail=$_POST['detail'];
    $date=$_POST['date'];

    $new_img=$_FILES['image']['name'];
    $old_img=$_POST['image1'];

    if ($new_img != '')
    {
        $update_filename = $_FILES['image']['name'];

    }else{

        $update_filename = $old_img;
    }

    $allowed_exttension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    $sql = "UPDATE `anno` SET `id`='$id',`title`='$title',
    `detail`='$detail',`date`='$date', `image`= '$update_filename' WHERE `id`='$id'";

    $result = mysqli_query($con,$sql);
    if ($result){
        if ($_FILES['image']['name'] !=''){
            move_uploaded_file($_FILES["image"]["tmp_name"], "img/".$_FILES["image"]["name"]);
            unlink("img/".$old_img);
        }
        echo "<script>alert('Record updated successfully!');</script>";
        echo "<script>window.location.href='anno.php'</script>";
    }else{
        echo "<script>alert('Something wrong with the insertion of the records');</script>";
        echo "<script>window.location.href='anno-edit.php'</script>";
    }
}
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET['error']; ?>
                    </div>
                    <?php } ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <div class="pull-left m-0 font-weight-bold text-primary">Edit Announcements</div>
                        </div>
                        <div class="card-body">
                            <form class="row" method="post" enctype="multipart/form-data">
                                <div class="form-group col-md-12 ">
                                    <label>Titel</label>
                                    <input type="text" name="title" class="form-control form-control-line" value="<?php echo $title; ?>" placeholder="" required > 
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Details</label>
                                    <textarea name="detail" class="form-control form-control-line"><?php echo $detail; ?></textarea> 
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Date</label>
                                    <input type="datetime-local" name="date" class="form-control form-control-line" value="<?php echo $date; ?>" placeholder="" required > 
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Image </label>
                                    <input type="hidden" name="image1" class="form-control" value="<?php echo $img; ?>"> 
                                    <input type="file"  name="image" class="form-control"> 
                                    <img src="<?php echo "img/".$row['image']?>" style="height: 70%;width: 100%;padding-top: 20px;">
                                </div>
                                <div class="form-actions col-md-12">
				                    <button type="submit" class="btn btn-success" name="update"> <i class="fa fa-check"></i>Update</button>
				                    <a href="anno.php"><button type="button" class="btn btn-danger">Cancel</button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
<?php include ('footer.php');?>