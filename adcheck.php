<?php
session_start();
error_reporting(0);
include('includes/config.php'); // Include configuration
// Check if student ID is passed in the URL
if (!isset($_GET['studentid']) || empty($_GET['studentid'])) {
 echo "<script>alert('Invalid access!'); window.location.href='index.php';</script>";
 exit;
}
$studentid = $_GET['studentid'];
?>
<!DOCTYPE html>
<html lang="en">
<?php include('includes/header.php'); ?>
<?php
// Fetch site settings
$stmt = $dbh->query("SELECT * FROM settings");
$rowfrontt = $stmt->fetch(PDO::FETCH_OBJ);
// Error handling for settings query
if (!$rowfrontt) {
 die('Error: Failed to fetch site settings.');
}
?>
<div class="login-bg-color bg-black-300"
 style="background: url('images/<?php echo htmlentities($rowfrontt->siteback);
?>');background-position: center;background-size: cover;">
 <div style="margin: 0;">
 <center><img src="images/<?php echo htmlentities($rowfrontt->logo); ?>"
height="100px"
 style="margin-top: 50px;"></center>
 </div>
 <div class="row">
 <div class="col-md-4 col-md-offset-4">
 <div class="panel login-box" style="background: #ffffff94; margin-top:
10px;">
 <div class="panel-heading">
 <div class="panel-title text-center">
 <h4><?php echo htmlentities($rowfrontt->title); ?></h4>
 </div>
 </div>
 <div class="panel-body p-20">
 <?php
 // Prepare statement to fetch student details securely
 $stmt = $dbh->prepare("SELECT * FROM tblstudents WHERE StudentId =
:studentid");
 $stmt->bindParam(':studentid', $studentid, PDO::PARAM_STR);
 $stmt->execute();
 $row = $stmt->fetch(PDO::FETCH_OBJ);
 if (!$row) {
 echo "<script>alert('Student not found!');
window.location.href='index.php';</script>";
 exit;
 }
 ?>
 <form action="viewresult.php" method="post">
 <!-- Display Student ID -->
 <div class="form-group">
 <label for="studentid">Student ID:</label>
 <input type="text" class="form-control" id="studentid"
 value="<?php echo htmlentities($row->RollId); ?>"
autocomplete="off" name="studentid"
 readonly>
 </div>
 <!-- Fetch and Display Student Class -->
 <div class="form-group">
 <label for="default" class="control-label">Student
Class:</label>
 <select name="class" class="form-control" id="default"
required readonly>
 <?php
 $sql = "SELECT * FROM tblclasses WHERE id = :classid";
 $query = $dbh->prepare($sql);
 $query->bindParam(':classid', $row->ClassId,
PDO::PARAM_INT);
 $query->execute();
 $results = $query->fetchAll(PDO::FETCH_OBJ);
 if ($query->rowCount() > 0) {
 foreach ($results as $result) {
 ?>
 <option value="<?php echo
htmlentities($result->id); ?>">
 <?php echo htmlentities($result->ClassName);
?>
 </option>
 <?php
 }
 } else {
 echo "<option>No Class Found</option>";
 }
 ?>
 </select>
 </div>
 <!-- Submit Button -->
 <div class="form-group mt-20">
 <button type="submit" class="btn btn-success btn-labeled
pull-right"
 style="background: #13382c; border-color: black;">
 Check Result<span class="btn-label btn-label-right"><i
class="fa fa-check"></i></span>
 </button>
 <div class="clearfix"></div>
 </div>
 </form>
 <hr>
 </div>
 </div>
 </div>
 </div>
</div>
<?php include 'includes/credit.php'; ?>
<!-- JS Files -->
<script src="js/jquery-ui/jquery-ui.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/pace/pace.min.js"></script>
<script src="js/lobipanel/lobipanel.min.js"></script>
<script src="js/iscroll/iscroll.js"></script>
<script src="js/icheck/icheck.min.js"></script>
<script src="js/main.js"></script>
<script>
$(function() {
 $('input.flat-blue-style').iCheck({
 checkboxClass: 'icheckbox_flat-blue'
 });
});
</script>
</body>
</html>