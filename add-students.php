<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
if(isset($_POST['submit']))
{
     $email = $_POST["email"];
    $query = mysqli_query($con, "SELECT * FROM tblstudents WHERE StudentEmail='$email' ") or die();
    if ($rowe = mysqli_fetch_assoc($query)) {
        $error = "Student <b>email</b> already choosen by <b>". $rowe["StudentName"]."</b>" or die();
    }else{
       $target = "images/".basename($_FILES['pics']['name']);
        $pics = $_FILES['pics']['name'];
        $studentname=$_POST['fullanme'];
        $email=$_POST['email'];
        $Department=$_POST['Department']; 
        $RollId = rand(0,10000).substr(time(),6);
        $gender=$_POST['gender']; 
        $classid=$_POST['class']; 
        $dob=$_POST['dob']; 
        $password=md5($_POST['password']); 
        $session=$_POST['session']; 
        $classtype=$_POST['class']; 
        $status=1;
        $sql="INSERT INTO  tblstudents(StudentName,Departments,Gender,ClassId,DOB,Status,RollId,session,logo,StudentEmail,password,classtype) VALUES(:studentname,:Department,:gender,:classid,:dob,:status,:rollid,:session,:pics,:email,:password,:classtype)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':studentname',$studentname,PDO::PARAM_STR);
        $query->bindParam(':Department',$Department,PDO::PARAM_STR);
        $query->bindParam(':gender',$gender,PDO::PARAM_STR);
        $query->bindParam(':classid',$classid,PDO::PARAM_STR);
        $query->bindParam(':dob',$dob,PDO::PARAM_STR);
        $query->bindParam(':status',$status,PDO::PARAM_STR);
        $query->bindParam(':rollid',$RollId,PDO::PARAM_STR);
        $query->bindParam(':session',$session,PDO::PARAM_STR);
        $query->bindParam(':pics',$pics,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':password',$password,PDO::PARAM_STR);
        $query->bindParam(':classtype',$classtype,PDO::PARAM_STR);
        $query->execute();
         if (move_uploaded_file($_FILES['pics']['tmp_name'], $target)) {
                      $msg="Profile succesfully changed";
                    }else{
                      $error="Profile failed to changed";
        }
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId)
        {
        $msg="Student info added successfully";

        }
        else 
        {
        $error="Something went wrong. Please try again";
        }


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
                        <h2 class="title">Student Admission</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                            <li class="active">Student Admission</li>
                        </ul>
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h5>Fill the Student info</h5>
                                </div>
                            </div>
                            <div class="panel-body">
                                <?php if($msg){?>
                                <div class="alert alert-success left-icon-alert" role="alert">
                                    <strong>Well done!</strong>
                                    <?php echo htmlentities($msg); ?>
                                </div>
                                <?php } 
                                        else if($error){?>
                                <div class="alert alert-danger left-icon-alert" role="alert">
                                    <strong>Oh snap!</strong>
                                    <?php echo $error; ?>
                                </div>
                                <?php } ?>
                                <form class="form-horizontal" method="post" enctype="multipart/form-data">
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
                                                <img id="getpic" src="images/default.gif"
                                                    style="width: 100%;height: auto;display: inline-block;box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);cursor: pointer;border: 5px solid white;">
                                                <input type="file" name="pics" style="display: none;" id="productimage"
                                                    onchange="imagepreview(event)" required="">
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="default" class="col-sm-2 control-label">Full Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="fullanme" class="form-control" id="fullanme"
                                                    required="required" autocomplete="off"
                                                    placeholder="E.G Adeleye Ayodeji Olaiya">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" name="email" class="form-control" id="email"
                                                    autocomplete="off" placeholder="Student email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="session" class="col-sm-2 control-label">Academic Year</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="session" class="form-control" id="studentid"
                                                    required="required" autocomplete="off" placeholder="E.g 2019/2020"
                                                    value="2020/2021" readonly="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="default" class="col-sm-2 control-label">Department</label>
                                            <div class="col-sm-10">
                                                <select name="Department" class="form-control" id="default"
                                                    required="required">
                                                    <option value="">Select Department</option>
                                                    <?php $sql = "SELECT * from tbldepartments";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                            if($query->rowCount() > 0)
                                                            {
                                                            foreach($results as $result)
                                                            {   ?>
                                                    <option value="<?php echo htmlentities($result->id); ?>">
                                                        <?php echo htmlentities($result->DepartmentName); ?>
                                                    </option>
                                                    <?php }} ?>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label for="default" class="col-sm-2 control-label">Gender</label>
                                            <div class="col-sm-10">
                                                <input type="radio" name="gender" value="Male" required="required"
                                                    checked="">Male <input type="radio" name="gender" value="Female"
                                                    required="required">Female
                                            </div>
                                        </div>










                                        <div class="form-group">
                                            <label for="default" class="col-sm-2 control-label">Class</label>
                                            <div class="col-sm-10">
                                                <select name="class" class="form-control" required="required">
                                                    <option value="">Select Class</option>
                                                    <?php  if (isset($_SESSION["teacher"])) {
                                                                $cidd = $_SESSION['teachercid'];
                                                                $sql = "SELECT * from tblclasses WHERE id = '$cidd'"; 
                                                             }else{
                                                                $sql = "SELECT * from tblclasses";
                                                             }
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                            if($query->rowCount() > 0)
                                                            {
                                                            foreach($results as $result)
                                                            {   ?>
                                                    <option value="<?php echo htmlentities($result->id); ?>">
                                                        <?php echo htmlentities($result->ClassName); ?>
                                                    </option>
                                                    <?php }} ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="date" class="col-sm-2 control-label">DOB</label>
                                            <div class="col-sm-10">
                                                <input type="date" name="dob" class="form-control" id="date">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-sm-2 control-label">Account
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="password" class="form-control" id="password"
                                                    placeholder="Enter account password">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="submit" id="submitme"
                                                    class="btn btn-primary">Add Student</button>

                                                <a href="<?php
                                                        echo('manage-students.php');
                                                     ?>" class="btn btn-primary"
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
</div>
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


<!-- /.main-wrapper -->
<?php include 'includes/credit.php'; ?>
<script src='js/js/tesseract.js'></script>
<script src='js/js/semantic.min.js'></script>
<script src="js/js/index.js"></script>

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