<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
    
     //Update background here
             if (isset($_POST['updatelogo']) && !empty($_FILES['siteback'])) {
              $oldname = explode(".",$_FILES['siteback']['name']);
              $newname = $oldname[0].'_'.time().'.'.$oldname[1];
              $target = "images/background/".basename($newname);
              $siteback = $newname;
              $sql = "UPDATE settings SET siteback=?";
              $stmt= $dbh->prepare($sql);
              $stmt->execute([$siteback]);

              if (move_uploaded_file($_FILES['siteback']['tmp_name'], $target)) {
              $msg="Background succesfully changed";
            }else{
              $error="Background failed to changed";
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
                        <h2 class="title">Website Background Settings</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                            <li> Settings</li>
                            <li class="active">Website Background Settings</li>
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
                                    <h5>Site Background Settings</h5>
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
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" value="999999999999999">
                                    <div class="sitedesciption editor" style="box-shadow:none;">
                                        <label class="custom-file-upload">
                                            <input type="hidden" name="default" value="<?php echo $row['siteback']; ?>">
                                            <input id="file" type="file" name="siteback"
                                                onchange="proccess(window.lastFile=this.files[0])" required="">
                                            <div class="content image">
                                                <?php
                                        $stmt = $dbh->query("SELECT * FROM settings");
                                        $row = $stmt->fetch(PDO::FETCH_OBJ);
                                        ?>
                                                <!--Sample image uploaded begins HERE -->
                                                <center>
                                                    <div>
                                                        <img id="image" style="width: fit-content;
    height: 250px !important;cursor: pointer;;
                                            box-shadow: 0px 0px 5px -2px
                                            black;" class="ui centered large image"
                                                            src="images/background/<?php echo htmlentities($row->siteback); ?>" />
                                                        <h2 style="margin: 0px;
    margin-top: -135px;
    position: relative;
    color: white;
    background: #5c4b4b;
    width: fit-content;
    padding: 10px;
    font-weight: lighter;
    font-size: 10px;
    border-radius: 10px;margin-bottom: 70px;">Select Background</h2>
                                                    </div>
                                                    <!--Sample image uploaded ends HERE -->
                                                </center>
                                            </div>
                                        </label>
                                    </div>
                                    <!-- Update button here -->
                                    <div class="text-center" style="margin-top: 20px;">
                                        <button class="btn btn-primary" name="updatelogo">Update
                                            Background</button>
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
<?php include 'includes/credit.php'; ?>
<!-- /.main-wrapper -->
<script src='js/js/tesseract.js'></script>
<!-- <script src='js/js/jquery.min.js'></script> -->
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