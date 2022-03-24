<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{

$admint = isset($_GET["term"]) && !empty($_GET["term"]) ? $_GET["term"] : $adminresult->term ;
$admins = isset($_GET["session"]) && !empty($_GET["session"]) ? $_GET["session"] : $adminresult->session;

$stid=intval($_GET['stid']);
if(isset($_POST['submit']))
{

$rowid=$_POST['id'];
$marks=$_POST['marks'];
$tmarks=$_POST['tmarks']; 
$daysschool=$_POST['daysschool']; 
$dayspresent=$_POST['dayspresent']; 
$daysabsence=$_POST['daysabsence']; 
$termbegin=$_POST['termbegin']; 
$termends=$_POST['termends']; 
$termnext=$_POST['termnext']; 
$term = $_POST["term"];
$status_ = $_POST["status_"];
$adminstatus = $_POST["adminstatus"];
$revised = $_POST["revision"];
//Calcualte revision
$revision_ = (int)$revised + 1;

// echo $revision_;
// return;
//Loop through data
foreach($_POST['id'] as $count => $id){
$mrks=$marks[$count];
$tmrks=$tmarks[$count];
$iid=$rowid[$count];
for($i=0;$i<=$count;$i++) {
//Query data
$sql="update tblresult  set marks=:mrks, Status = :status_, tmarks=:tmrks, daysschool=:daysschool, dayspresent=:dayspresent, daysabsence=:daysabsence, termbegin=:termbegin, termends=:termends, termnext=:termnext, adminstatus=:adminstatus, revision_=:revision_ where id=:iid and term = :term and year = :year";
$query = $dbh->prepare($sql);
$query->bindParam(':mrks',$mrks,PDO::PARAM_STR);
$query->bindParam(':tmrks',$tmrks,PDO::PARAM_STR);
$query->bindParam(':daysschool',$daysschool,PDO::PARAM_STR);
$query->bindParam(':dayspresent',$dayspresent,PDO::PARAM_STR);
$query->bindParam(':daysabsence',$daysabsence,PDO::PARAM_STR);
$query->bindParam(':termbegin',$termbegin,PDO::PARAM_STR);
$query->bindParam(':termends',$termends,PDO::PARAM_STR);
$query->bindParam(':termnext',$termnext,PDO::PARAM_STR);
$query->bindParam(':iid',$iid,PDO::PARAM_STR);
$query->bindParam(':status_',$status_,PDO::PARAM_STR);
$query->bindParam(':adminstatus',$adminstatus,PDO::PARAM_STR);
$query->bindParam(':revision_',$revision_,PDO::PARAM_STR);
$query->bindParam(':term',$admint,PDO::PARAM_STR);
$query->bindParam(':year',$admins,PDO::PARAM_STR);
$query->execute();
//log message
$msg="Result info updated successfully";
}
}
}

?>
<?php include('includes/header.php');?>

<!-- ========== TOP NAVBAR ========== -->
<?php include('includes/topbar.php');?>
<!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
<style>
    #selectator_studentid{
        width: 100% !important;
    }
</style>
<div class="content-wrapper">
    <div class="content-container">

        <!-- ========== LEFT SIDEBAR ========== -->
        <?php include('includes/leftbar.php');?>
        <!-- /.left-sidebar -->

        <div class="main-page">

            <div class="container-fluid">
                <div class="row page-title-div">
                    <div class="col-md-6">
                        <h2 class="title">Edit Student Result Info</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                            <li class="active">Edit result</li>
                        </ul>
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-1 col-sm-12">
                                
                            </div>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                          <div class="panel">
                            <!--<div class="panel-heading">-->
                            <!--    <div class="panel-title">-->
                            <!--        <h5>Update the Result info</h5>-->
                            <!--    </div>-->
                            <!--</div>-->
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
<form class="form-horizontal" method="post" action="">

                                    <?php 

$ret = "SELECT tblstudents.StudentName,tblstudents.logo,tblclasses.ClassName from tblresult join tblstudents on tblresult.StudentId=tblresult.StudentId join tblsubjects on 
tblsubjects.id=tblresult.SubjectId join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.StudentId=:stid 
and tblresult.term = '$admint' and tblresult.year = '$admins' limit 1";
$stmt = $dbh->prepare($ret);
$stmt->bindParam(':stid',$stid,PDO::PARAM_STR);
$stmt->execute();
$result=$stmt->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($stmt->rowCount() > 0)
{
foreach($result as $row)
{  ?>
                                    <div class="form-group">
                                        <div class="col-sm-12 col-10 text-center">
                                             <a href="images/<?php echo htmlentities($row->logo); ?>" data-fancybox="images" data-caption="<?php echo htmlentities($row->StudentName);?>">
                                                 <img src="images/loading.gif" class="lazy"
                                                  data-srcset="images/<?php echo htmlentities($row->logo); ?>"
                                                  data-src="images/<?php echo htmlentities($row->logo); ?>"
                                                  style="height: 128px;
    border-radius: 21px;
    box-shadow: 6px 8px 11px -9px;">
                                            </a>
                                        <h3 style="margin: 0px;
    margin-top: 6px;"><?php echo htmlentities($row->StudentName);?></h3>
                                        <h4 style="    margin: 0px;
    margin-top: 4px;
    color: grey;"><?php echo htmlentities($row->ClassName)?>: <?php
   $depart = $_GET['stid'];
   $query = mysqli_query($con, "SELECT Department FROM tblresult WHERE StudentId='$depart' and term = '$admint' and year = '$admins' ") or die();
   $resultde = mysqli_fetch_assoc($query);
   $dpid = $resultde["Department"];
    $squery = mysqli_query($con, "SELECT * FROM tbldepartments WHERE id = '$dpid' ");
  $sqresult = mysqli_fetch_assoc($squery);
 echo htmlentities($sqresult['DepartmentName']);
    
 ?> Dpt.</h4>
 <h5 style="    margin: 0px;
    margin-top: 3px;
    color: #adadadad;">
    SESSION: 
    <?php
   $depart = $_GET['stid'];
   $query = mysqli_query($con, "SELECT * FROM tblresult WHERE StudentId='$depart' and term = '$admint' and year = '$admins' ") or die();
   $resultde = mysqli_fetch_assoc($query);
   echo $resultde["year"];
    
 ?></h5>
                                        </div>

                                    </div>

                                <hr>
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Term</label>
                                        <div class="col-sm-10">
                                            <?php
   $depart = $_GET['stid'];
   $query = mysqli_query($con, "SELECT * FROM tblresult WHERE StudentId='$depart' and term = '$admint' and year = '$admins' ") or die();
   $resultde = mysqli_fetch_assoc($query);
 ?>
   <select name="term" class="form-control" readonly>
       <option value="<?php echo $resultde["term"]; ?>"><?php echo $resultde["term"]; ?></option>
   </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">No. of Days School
                                            Opened</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="daysschool" class="form-control"
                                                value="<?php echo htmlentities($resultde['daysschool']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">No. of Days Present</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="dayspresent" class="form-control"
                                                value="<?php echo htmlentities($resultde['dayspresent']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">No. of Days Absence</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="daysabsence" class="form-control"
                                                value="<?php echo htmlentities($resultde['daysabsence']); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Term Begins</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="termbegin" class="form-control"
                                                value="<?php echo htmlentities($resultde['termbegin']); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Term Ends</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="termends" class="form-control"
                                                value="<?php echo htmlentities($resultde['termends']); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Next Term Begins</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="termnext" class="form-control"
                                                value="<?php echo htmlentities($resultde['termnext']); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Teachers Status</label>
                                        <div class="col-sm-10">
                                            <select name="status_" class="form-control" required>
                                                <option value="<?php echo ($resultde['Status'] == 0)? "0": "1"; ?>" selected>
                                                    <?php echo ($resultde['Status'] == 0)? "Pending": "Review"; ?>
                                                </option>
                                                <option value="0">======</option>
                                                <option value="1">Review</option>
                                                <option value="0">Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Revision -->
                                    <input type="hidden" name="revision" value="<?php echo $resultde['revision_']; ?>">
                                    <!-- Revision -->
                                    <?php
                                    if (!isset($_SESSION["teacher"])) {
                                        ?>
                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label bg-success">Admin
                                            Status</label>
                                        <div class="col-sm-10">
                                            <select name="adminstatus" class="form-control bg-success text-white">
                                                <option value="<?php echo $resultde['adminstatus']; ?>" selected>
                                                    <?php echo ($resultde['adminstatus'] == 0)? "On Hold": "Live"; ?>
                                                </option>
                                                <option value="0">======</option>
                                                <option value="1">Live</option>
                                                <option value="0">On Hold</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    }else{
                                        ?>
                                    <input type="hidden" name="adminstatus" value="0">
                                    <?php
                                    }
                                    ?>
                                    <?php } }?>

                                    <hr>

                                    <?php 
$sql = "SELECT distinct tblstudents.StudentName,tblstudents.StudentId,tblclasses.ClassName,tblclasses.Section,tblsubjects.SubjectName,tblresult.marks,tblresult.tmarks,tblresult.id as resultid from tblresult join tblstudents on tblstudents.StudentId=tblresult.StudentId join tblsubjects on tblsubjects.id=tblresult.SubjectId join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.StudentId=:stid and tblresult.term = '$admint' and tblresult.year = '$admins'";
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
                                        <label for="default"
                                            class="col-sm-2 control-label"><?php echo htmlentities($result->SubjectName)?></label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="id[]"
                                                value="<?php echo htmlentities($result->resultid)?>">
                                            <p><b>Result for Exam:</b></p>
                                            <input type="number" name="marks[]" class="form-control" id="marks"
                                                value="<?php echo htmlentities($result->marks)?>"
                                                placeholder="Enter marks out of 60" autocomplete="off" min="0" max="60">
                                            <p><b>Result for Cont Ass.:</b></p>
                                            <input type="number" name="tmarks[]" class="form-control" id="marks"
                                                value="<?php echo htmlentities($result->tmarks)?>"
                                                placeholder="Enter marks out of 40" autocomplete="off" min="0" max="40">
                                        </div>
                                    </div>




                                    <?php }} ?>


                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary">Update</button>

                                            <a href="manage-results.php" class="btn btn-primary"
                                                style="float: right;background: black;color: white;">
                                                Manage Results
                                            </a>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                            </div>
                            <div class="col-lg-3 col-md-1 col-sm-12">
                                
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
<!--<script src="js/jquery/jquery-2.2.4.min.js"></script>-->
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