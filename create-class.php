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
$classname=$_POST['classname'];

$sql="INSERT INTO  tblclasses(ClassName) VALUES(:classname)";
$query = $dbh->prepare($sql);
$query->bindParam(':classname',$classname,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Class Created successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>
<?php include('includes/header.php');?>
<style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
}

.succWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
}
</style>

<!-- ========== TOP NAVBAR ========== -->
<?php include('includes/topbar.php');?>
<!-----End Top bar -->
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
                        <h2 class="title">Create Student Class</h2>
                    </div>

                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href="#">Classes</a></li>
                            <li class="active">Create Class</li>
                        </ul>
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

            <section class="section">
                <div class="container-fluid">





                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h5>Create Student Class</h5>
                                    </div>
                                </div>
                                <?php if($msg){?>
                                <div class="alert alert-success left-icon-alert" role="alert">
                                    <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                </div><?php } 
else if($error){?>
                                <div class="alert alert-danger left-icon-alert" role="alert">
                                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                </div>
                                <?php } ?>

                                <div class="panel-body">

                                    <form method="post">
                                        <div class="form-group has-success">
                                            <label for="success" class="control-label">Class</label>
                                            <div class="">
                                                <input type="text" name="classname" class="form-control"
                                                    required="required" id="success">
                                                <span class="help-block">Eg- JSS1, JSS2 - SSS3</span>
                                            </div>
                                        </div>

                                        <div class="form-group has-success">

                                            <div class="">
                                                <button type="submit" name="submit"
                                                    class="btn btn-success btn-labeled">Submit<span
                                                        class="btn-label btn-label-right"><i
                                                            class="fa fa-check"></i></span></button>

                                                <a href="manage-classes.php" class="btn btn-primary"
                                                    style="float: right;background: black;color: white;">
                                                    Manage Class
                                                </a>

                                            </div>



                                    </form>


                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-8 col-md-offset-2 -->
                    </div>
                    <!-- /.row -->




                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.section -->

        </div>
        <!-- /.main-page -->

    </div>
    <!-- /.content-container -->
</div>
<!-- /.content-wrapper -->

</div>
<!-- /.main-wrapper -->
<?php include 'includes/credit.php'; ?>
<!-- ========== COMMON JS FILES ========== -->

<script src="js/jquery-ui/jquery-ui.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/pace/pace.min.js"></script>
<script src="js/lobipanel/lobipanel.min.js"></script>
<script src="js/iscroll/iscroll.js"></script>

<!-- ========== PAGE JS FILES ========== -->
<script src="js/prism/prism.js"></script>

<!-- ========== THEME JS ========== -->
<script src="js/main.js"></script>



<!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
</body>

</html>
<?php  } ?>