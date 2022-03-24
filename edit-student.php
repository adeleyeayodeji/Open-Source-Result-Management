<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{

$stid=intval($_GET['stid']);

if(isset($_POST['submit']))
{
$studentname=$_POST['fullanme'];
$Department=$_POST['Department']; 
$studentemail=$_POST['email']; 
$gender=$_POST['gender']; 
$classid=$_POST['class']; 
$dob=$_POST['dob']; 
$status=$_POST['status'];
$session=$_POST['session'];
$classtype=$_POST['classtype'];

$sql="update tblstudents set StudentName=:studentname,Departments=:Department,StudentEmail=:studentemail,Gender=:gender,DOB=:dob,Status=:status,ClassId=:classid,session=:session,classtype=:classtype where StudentId=:stid ";
$query = $dbh->prepare($sql);
$query->bindParam(':studentname',$studentname,PDO::PARAM_STR);
$query->bindParam(':Department',$Department,PDO::PARAM_STR);
$query->bindParam(':studentemail',$studentemail,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':stid',$stid,PDO::PARAM_STR);
$query->bindParam(':classid',$classid,PDO::PARAM_STR);
$query->bindParam(':session',$session,PDO::PARAM_STR);
$query->bindParam(':classtype',$classtype,PDO::PARAM_STR);
$query->execute();
    if ($query) {
        $msg="Student info updated successfully";
    }else{
        $error="Student info failed to update";
    }

}
    
        //Update logo here
             if (isset($_POST['updatelogo'])) {
              $target = "images/".basename($_FILES['pics']['name']);
              $pics = $_FILES['pics']['name'];
              $sql = "UPDATE tblstudents SET logo=? WHERE StudentId = '$stid'";
              $stmt= $dbh->prepare($sql);
              $stmt->execute([$pics]);

              if (move_uploaded_file($_FILES['pics']['tmp_name'], $target)) {
              $msg="Profile succesfully changed";
            }else{
              $error="Profile failed to changed";
            }
            }

?>
<?php include('includes/header.php');?>

<!-- ========== TOP NAVBAR ========== -->
<?php include('includes/topbar.php');?>
<!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
<div class="content-wrapper">
    <div class="content-container">

        <!-- ========== LEFT SIDEBAR ========== -->
        <?php include('includes/leftbar.php');?>
        <!-- /.left-sidebar -->

        <div class="main-page">

            <div class="container-fluid">
                <div class="row page-title-div">
                    <div class="col-md-6">
                        <h2 class="title">Edit Student details</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                            <li class="active">Edit Student details</li>
                        </ul>
                    </div>

                </div>
                <!-- /.row -->
            </div>

            <div class="container">

                <div class="row">
                    <div class="col-md-12 p-4">
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h5>Fill the Student info</h5>
                                </div>
                            </div>
                            <div class="panel-body">
                                <?php if($msg){?>
                                <div class="alert alert-success left-icon-alert" role="alert">
                                    <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                </div><?php } 
else if($error){?>
                                <div class="alert alert-danger left-icon-alert" role="alert">
                                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                </div>
                                <?php } ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" value="999999999999999">
                                    <style type="text/css">
                                    .uploadpic:hover {
                                        box-shadow: 2px 2px 2px 2px lightgrey;
                                    }
                                    </style>
                                    <div
                                        style="margin-right: auto;margin-left: auto;width: 63%;    margin-bottom: 14px;">
                                        <style type="text/css">
                                        /* Medium devices (landscape tablets, 768px and up) */
                                        @media only screen and (min-width: 768px) {
                                            #imagemi {
                                                width: 50%;
                                                margin-left: auto;
                                                margin-right: auto;
                                            }
                                        }

                                        /* Large devices (laptops/desktops, 992px and up) */
                                        @media only screen and (min-width: 992px) {
                                            #imagemi {
                                                width: 50%;
                                                margin-left: auto;
                                                margin-right: auto;
                                            }
                                        }

                                        /* Extra large devices (large laptops and desktops, 1200px and up) */
                                        @media only screen and (min-width: 1200px) {
                                            #imagemi {
                                                width: 50%;
                                                margin-left: auto;
                                                margin-right: auto;
                                            }
                                        }
                                        </style>
                                        <div class="form-group" id="imagemi">
                                            <label>
                                                <?php
                                                $picsql = "SELECT * FROM tblstudents WHERE StudentId = '$stid'";
                                                // $picq = $dbh->prepare($picsql);
                                                $picq = $con->query($picsql);
                                                // $picq->bindParam(':stid',$stid,PDO::PARAM_STR);
                                                // $picq->execute();
                                                $picresult = mysqli_fetch_assoc($picq);
                                                // $picresult = $picq->fetchAll(PDO::FETCH_OBJ);
                                                ?>
                                                <img id="getpic" src="images/<?php echo($picresult['logo']); ?>"
                                                    style="width: 100%;height: auto;display: inline-block;box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);cursor: pointer;border: 5px solid white;">
                                                <input type="file" name="pics" style="display: none;" id="productimage"
                                                    onchange="imagepreview(event)" required="">
                                            </label>
                                        </div>

                                        <center><button class="btn btn-primary" name="updatelogo"
                                                style="margin-left: 10px;">Update Pic</button></center>
                                    </div>

                                </form>
                                <hr>
                                <form class="form-horizontal" method="post">
                                    <?php 

$sql = "SELECT tblstudents.StudentName,tblstudents.classtype,tblstudents.session,tblstudents.Departments,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblstudents.StudentEmail,tblstudents.Gender,tblstudents.DOB,tblclasses.ClassName,tblstudents.ClassId,tblstudents.RollId from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.StudentId=:stid";
$query = $dbh->prepare($sql);
$query->bindParam(':stid',$stid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>



                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Full Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="fullanme" class="form-control" id="fullanme"
                                                value="<?php echo htmlentities($result->StudentName)?>"
                                                required="required" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Student Id</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="studentid" class="form-control" readonly
                                                value="<?php echo htmlentities($result->RollId)?>" required="required"
                                                autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Student Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="email" class="form-control" readonly
                                                value="<?php echo htmlentities($result->StudentEmail)?>"
                                                required="required" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Academic Year</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="session" class="form-control"
                                                value="<?php echo htmlentities($result->session)?>" required="required"
                                                autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Department</label>
                                        <div class="col-sm-10">
                                            <select name="Department" class="form-control" id="default"
                                                required="required">
                                                <option value="<?php echo htmlentities($result->Departments)?>"><?php 
                                                        $dpid = $result->Departments;
                                                        $dpquery = mysqli_query($con, "SELECT * FROM tbldepartments WHERE id = '$dpid' ") or die();
                                                        $dpresult = mysqli_fetch_assoc($dpquery);
                                                        echo $dpresult["DepartmentName"];
                                                        ?></option>
                                                <?php $sql = "SELECT * from tbldepartments";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $redep=$query->fetchAll(PDO::FETCH_OBJ);
                                                            if($query->rowCount() > 0)
                                                            {
                                                            foreach($redep as $resultdep)
                                                            {   ?>
                                                <option value="<?php echo htmlentities($resultdep->id); ?>">
                                                    <?php echo htmlentities($resultdep->DepartmentName); ?>
                                                </option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Gender</label>
                                        <div class="col-sm-10">
                                            <?php  $gndr=$result->Gender;
if($gndr=="Male")
{
?>
                                            <input type="radio" name="gender" value="Male" required="required"
                                                checked>Male <input type="radio" name="gender" value="Female"
                                                required="required">Female <input type="radio" name="gender"
                                                value="Other" required="required">Other
                                            <?php }?>
                                            <?php  
if($gndr=="Female")
{
?>
                                            <input type="radio" name="gender" value="Male" required="required">Male
                                            <input type="radio" name="gender" value="Female" required="required"
                                                checked>Female <input type="radio" name="gender" value="Other"
                                                required="required">Other
                                            <?php }?>
                                            <?php  
if($gndr=="Other")
{
?>
                                            <input type="radio" name="gender" value="Male" required="required">Male
                                            <input type="radio" name="gender" value="Female" required="required">Female
                                            <input type="radio" name="gender" value="Other" required="required"
                                                checked>Other
                                            <?php }?>


                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Class</label>
                                        <div class="col-sm-10">
                                            <select name="class" class="form-control" id="classtype" required="">
                                                <div class="col-sm-10">
                                                    <option value="<?php echo htmlentities($result->ClassId)?>">
                                                        <?php echo htmlentities($result->ClassName)?></option>
                                                    <?php $sql = "SELECT * from tblclasses";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $recla=$query->fetchAll(PDO::FETCH_OBJ);
                                                            if($query->rowCount() > 0)
                                                            {
                                                            foreach($recla as $reclass)
                                                            {   ?>
                                                    <option value="<?php echo htmlentities($reclass->id); ?>">
                                                        <?php echo htmlentities($reclass->ClassName); ?>
                                                    </option>
                                                    <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div id="entry" class="col-sm-10">

                                        </div>
                                        <script type="text/javascript">
                                        $(document).ready(function() {

                                            $("#classtype").change(function() {
                                                //Loading class type from ajax onchange
                                                $.get("newp.php?newp=" + this.value, function(data) {
                                                    $("#entry").html(data);
                                                    $("#entry").css({
                                                        "margin-right": "auto",
                                                        "margin-left": "auto",
                                                        "width": "100%"
                                                    });
                                                });
                                                // console.log(this.value);
                                            });

                                            $("#classtype").ready(function() {
                                                //Loading class type from ajax onload
                                                const value = $('#classtype').val();
                                                $.get("newp.php?newp=" + value +
                                                    "&classtype2=<?php echo($result->classtype); ?>",
                                                    function(data) {
                                                        $("#entry").html(data);
                                                        $("#entry").css({
                                                            "margin-right": "auto",
                                                            "margin-left": "auto",
                                                            "width": "100%"
                                                        });
                                                    });
                                                // console.log();
                                            })

                                        });
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label for="date" class="col-sm-2 control-label">DOB</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="dob" class="form-control"
                                                value="<?php echo htmlentities($result->DOB)?>" id="date">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Reg Date: </label>
                                        <div class="col-sm-10">
                                            <?php echo htmlentities(date("F j, Y",strtotime($result->RegDate)))?>
                                        </div>
                                    </div>

                                    <div class="form-group"
                                        style="display: <?php echo (isset($_SESSION["teacher"]))? 'none': 'block'; ?>;">
                                        <label for="default" class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-10">
                                            <?php  $stats=$result->Status;
if($stats=="1")
{
?>
                                            <input type="radio" name="status" value="1" required="required"
                                                checked>Active <input type="radio" name="status" value="0"
                                                required="required">Block
                                            <?php }?>
                                            <?php  
if($stats=="0")
{
?>
                                            <input type="radio" name="status" value="1" required="required">Active
                                            <input type="radio" name="status" value="0" required="required"
                                                checked>Block
                                            <?php }?>



                                        </div>
                                    </div>

                                    <?php }} ?>


                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary">Update</button>

                                            <a href="manage-students.php" class="btn btn-primary"
                                                style="float: right;background: black;color: white;">
                                                Manage students
                                            </a>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-12 -->
                </div>
            </div>
        </div>
        <!-- /.content-container -->
    </div>
    <!-- /.content-wrapper -->
    <script type="text/javascript">
    function imagepreview(event) {
        var reader = new FileReader();
        var imagefield = document.getElementById('getpic');

        reader.onload = function() {
            if (reader.readyState == 2) {
                imagefield.src = reader.result;
                // console.log(reader.result);
            }
        }
        reader.readAsDataURL(event.target.files[0]);

    }

    $(document).ready(function() {
        $("#submitme").click(function() {
            var newp = $("#productimage").val();
            if (newp == "") {
                $("#getpic").css({
                    "box-shadow": "0px -3px 6px 2px rgba(108, 4, 4, 0.2)",
                    "border": "5px solid #b91717"
                });
                console.log("Am empty");
            } else {
                console.log("Image good to go");
            }
            // console.log(newp);
        });
    });
    </script>
</div>
<?php include 'includes/credit.php'; ?>
<script src='js/js/tesseract.js'></script>
<!--<script src='js/js/jquery.min.js'></script>-->
<script src='js/js/semantic.min.js'></script>
<script src="js/js/index.js"></script>
<!-- /.main-wrapper -->

<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/pace/pace.min.js"></script>
<script src="js/lobipanel/lobipanel.min.js"></script>
<script src="js/iscroll/iscroll.js"></script>
<script src="js/prism/prism.js"></script>
<script src="js/select2/select2.min.js"></script>
<script src="js/main.js"></script>
<script>
$(function($) {
    $(".js-states").select2();
    $(".js-states-limit").select2({
        maximumSelectionLength: 2
    });
    $(".js-states-hide").select2({
        minimumResultsForSearch: Infinity
    });
});
</script>
</body>

</html>
<?PHP } ?>