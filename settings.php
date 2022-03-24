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
    $address1 = $_POST["address1"];
    $address2 = $_POST["address2"];
    $term = $_POST["term"];
    $session = $_POST["session"];
    $sql = "UPDATE settings SET title=?, description=?, address1=?,address2=?, term=?, session=?";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([$sitetitle, $sitedesc, $address1, $address2,$term,$session]);
    if ($stmt) {
        $msg="Your Settings succesfully changed";
    }else{
        $error="Your Settings succesfully changed";
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
                        <h2 class="title">Website Settings</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                            <li> Settings</li>
                            <li class="active">Website Settings</li>
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
                                    <h5>Site Settings</h5>
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
                                            <input type="hidden" name="default" value="<?php echo $row['sitelogo']; ?>">
                                            <input id="file" type="file" name="sitelogo"
                                                onchange="proccess(window.lastFile=this.files[0])" required="">
                                            <div class="content image">
                                                <?php
                                        $stmt = $dbh->query("SELECT * FROM settings");
                                        $row = $stmt->fetch(PDO::FETCH_OBJ);
                                        ?>
                                                <!--Sample image uploaded begins HERE -->
                                                <center>
                                                    <img id="image" style="width: 20%;height: auto;cursor: pointer;;
                                        box-shadow: 0px 0px 5px -2px
                                        black;" class="ui centered large image"
                                                        src="images/<?php echo htmlentities($row->logo); ?>" />
                                                    <!--Sample image uploaded ends HERE -->
                                                </center>
                                            </div>
                                        </label>
                                    </div>
                                    <!-- Update button here -->
                                    <div class="fifteen wide column" style="margin-top: 20px;">
                                        <center><button class="ui button logo" name="updatelogo">Update logo</button>
                                        </center>
                                    </div>
                                </form>
                                <hr>
                                <form class="form-horizontal" method="post">
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Site Title</label>
                                        <div class="col-sm-10">
                                            <?php

                                        $studentid = $_GET["studentid"];
                                        $stmt = $dbh->query("SELECT * FROM settings");
                                        $row = $stmt->fetch(PDO::FETCH_OBJ);
                                        ?>
                                            <input type="text" name="sitetitle" class="form-control" id="default"
                                                placeholder="Site Title" value="<?php echo htmlentities($row->title) ?>"
                                                required="required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Site Description</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="sitedesc" class="form-control" id="default"
                                                placeholder="Site Description"
                                                value="<?php echo htmlentities($row->description) ?>"
                                                required="required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Address 1</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="address1" class="form-control" id="default"
                                                placeholder="Address 1"
                                                value="<?php echo htmlentities($row->address1) ?>" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Address 2</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="address2" class="form-control" id="default"
                                                placeholder="Address 2"
                                                value="<?php echo htmlentities($row->address2) ?>" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">School Current
                                            Session</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="session" class="form-control" id="default"
                                                placeholder="2020/2021"
                                                value="<?php echo htmlentities($row->session) ?>" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">School Current
                                            Term</label>
                                        <div class="col-sm-10">
                                            <select name="term" class="form-control">
                                                <option value="First Term"
                                                    <?php echo htmlentities($row->term) == "First Term" ? "selected" : "" ?>>
                                                    First Term
                                                </option>
                                                <option value="Second Term"
                                                    <?php echo htmlentities($row->term) == "Second Term" ? "selected" : "" ?>>
                                                    Second Term</option>
                                                <option value="Third Term"
                                                    <?php echo htmlentities($row->term) == "Third Term" ? "selected" : "" ?>>
                                                    Third Term</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary">Save
                                                Settings</button>
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
<?php include 'includes/credit.php'; ?>
<!-- /.main-wrapper -->
<script src='js/js/tesseract.js'></script>
<!--<script src='js/js/jquery.min.js'></script>-->
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