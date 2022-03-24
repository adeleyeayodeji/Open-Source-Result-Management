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
    $sitetitle = $_POST["sitetitle"];
    $sitedesc = $_POST["sitedesc"];
    $sql = "UPDATE settings SET title=?, description=?";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([$sitetitle, $sitedesc]);
    if ($stmt) {
        $msg="Your Password succesfully changed";
    }else{
        $error="Your Password succesfully changed";
    }
}
    
     //Update logo here
             if (isset($_POST['updatelogo'])) {
              $target = "images/".basename($_FILES['sitelogo']['name']);
              $sitelogo = $_FILES['sitelogo']['name'];
              $sql = "UPDATE settings SET logo=?";
              $stmt= $dbh->prepare($sql);
              $stmt->execute([$sitelogo]);

              if (move_uploaded_file($_FILES['sitelogo']['tmp_name'], $target)) {
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
                                    <h2 class="title"> Students</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Manage Student</li>
                                        <li class="active">Select Class</li>
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
                                                    <h5>Select Class</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                    <?php if($msg){?>
                                    <div class="alert alert-success left-icon-alert" role="alert">
                                    <?php echo htmlentities($msg); ?>
                                     </div><?php } 
                                    else if($error){?>
                                        <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                            <a href="manage-jss1.php" class="btn btn-primary">JSS 1</a>
                                           <a href="manage-jss2.php" class="btn btn-primary">JSS 2</a>
                                           <a href="manage-jss3.php" class="btn btn-primary">JSS 3</a>
                                           <hr>
                                           <a href="manage-sss1.php" class="btn btn-primary">SSS 1</a>
                                           <a href="manage-sss2.php" class="btn btn-primary">SSS 2</a>
                                           <a href="manage-sss3.php" class="btn btn-primary">SSS 3</a>
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
        <?php include 'includes/credit.php'; ?>
        <!-- /.main-wrapper -->
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
