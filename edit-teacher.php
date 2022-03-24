<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
$stid = $_GET["stid"];

if(isset($_POST['submit']))
{

    if (isset($_POST["changepassword"])) {
            $email = $_POST["email"];
        $password = md5($_POST["password"]);
        $cpassword = md5($_POST["cpassword"]);
        //Checking if password matched
        if ($password == $cpassword) {
        $fullName=$_POST['fullName'];
        $classid=$_POST['class']; 
        $mobileNo=$_POST['mobileNo']; 
        //SQL query start
        // $sql="UPDATE teacher SET fullName='$fullName',email='$email',mobileNo='$mobileNo',password='$password',classid='$classid' WHERE id = '$stid' )";
            $sql="UPDATE teacher SET fullName=:fullName,email=:email,mobileNo=:mobileNo,password=:password,classid=:classid WHERE id = :stid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullName',$fullName,PDO::PARAM_STR);
        $query->bindParam(':classid',$classid,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':password',$password,PDO::PARAM_STR);
        $query->bindParam(':mobileNo',$mobileNo,PDO::PARAM_STR);
        $query->bindParam(':stid',$stid,PDO::PARAM_STR);
        $query->execute();
        if($query)
        {
        $msg="Password successfully changed";

        }
        else 
        {
        $error="Something went wrong. Please try again";
        }   
        }else{//Elseif password not matched
            $error = "Password do not match" or die();
        }       
    }else{
        //If password change is not set
        $email = $_POST["email"];
        $fullName=$_POST['fullName'];
        $classid=$_POST['class']; 
        $mobileNo=$_POST['mobileNo']; 
        //SQL query start
            $sql="UPDATE teacher SET fullName='$fullName',email='$email',mobileNo='$mobileNo',classid='$classid' WHERE id = '$stid'";
        $query = mysqli_query($con, $sql);
        if($query)
        {
        $msg="Teacher info update successfully";

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
                                <h2 class="title">Edit Teacher</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                                    <li class="active">Edit Teacher</li>
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
                                        <?php $sql2 = "SELECT * from teacher WHERE id = '$stid' ";
                                        $tq = mysqli_query($con,$sql2);
                                        $tr = mysqli_fetch_assoc($tq);
?>
                                        <form class="form-horizontal" method="post" action="">
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Full Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="fullName" class="form-control" id="fullanme" required="required" autocomplete="off" placeholder="Enter Surname LastName" value="<?php echo htmlentities($tr['fullName']);?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" name="email" class="form-control" id="fullanme" required="required" autocomplete="off" placeholder="Enter email address" value="<?php echo htmlentities($tr['email']);?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Change Password</label>
                                                <div class="col-sm-1">
                                                    <input type="checkbox" name="changepassword" class="form-control" id="changepassword" value="changeme" onclick="phide(this.value)">
                                                </div>
                                            </div>
                                             <div id="phide" class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="password" class="form-control" id="fullanme" autocomplete="off" placeholder="Enter Teacher Password">
                                                </div>
                                            </div>
                                            <div id="pphide" class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Confirm Password</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="cpassword" class="form-control" id="fullanme" autocomplete="off" placeholder="Confirm Password">
                                                </div>
                                            </div>

                                            <script type="text/javascript">
                                                document.getElementById('phide').style.display = "none";
                                                document.getElementById('pphide').style.display = "none";

                                                function phide(pvalue) {
                                                    if (pvalue == "changeme") {
                                                        
                                                        document.getElementById('phide').style.display = "block";
                                                        document.getElementById('pphide').style.display = "block";
                                                        document.getElementById('changepassword').value = "dontchange";
                                                        console.log(pvalue);
                                                    }else{
                                                        if (pvalue == "dontchange") {
                                                            document.getElementById('phide').style.display = "none";
                                                            document.getElementById('pphide').style.display = "none";
                                                        document.getElementById('changepassword').value = "changeme";
                                                        console.log(pvalue);
                                                        }
                                                    }
                                                }
                                            </script>

                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Mobile No.:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="mobileNo" placeholder="Enter your number" class="form-control" value="<?php echo htmlentities($tr['mobileNo']);?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Class</label>
                                                <div class="col-sm-10">
                                                    <select name="class" class="form-control" id="default" required="required">
                                                        <option value="<?php echo htmlentities($tr['classid']);?>" selected>
                                                            <?php 
                                                               $tqid = $tr['classid'];
                                                               $sql2 = "SELECT * from tblclasses WHERE id = '$tqid' ";
                                                                $tq = mysqli_query($con,$sql2);
                                                                $tr = mysqli_fetch_assoc($tq);
                                                                
                                                                //Result here   
                                                                echo $tr["ClassName"];
                                                                ?>
                                                                

                                                        </option>
                                                        <option>============</option>
                                                        <?php $sql = "SELECT * from tblclasses";
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
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="submit" class="btn btn-primary">Update Teacher</button>

                                                    <a href="manage-teacher.php" class="btn btn-primary" style="float: right;background: black;color: white;">
                                                    Manage Teachers
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
        <!-- /.main-wrapper -->
        <?php include 'includes/credit.php'; ?>
         <script src='js/js/tesseract.js'></script>
        <!--<script src='js/js/jquery.min.js'></script>-->
        <script src='js/js/semantic.min.js'></script>
        <script  src="js/js/index.js"></script>
        
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
