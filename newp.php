<?php
session_start();
include('includes/config.php');
$newp = $_GET["newp"];

if (isset($_GET["classtype2"])) {
	//Getting current class type
	$classtype2 = $_GET["classtype2"];	
}


//Fetching from data from base for hunior class
$sql3 = $con->query("SELECT * FROM tblclasses WHERE id = '$newp'") or die();
$query3 = mysqli_fetch_assoc($sql3);	

//Fetching from data from base for hunior class
$sql = $con->query("SELECT * FROM jssbilling") or die();
$query = mysqli_fetch_assoc($sql);

//Fetching from data from base for senior class
$sql2 = $con->query("SELECT * FROM sssbilling") or die();
$query2 = mysqli_fetch_assoc($sql2);

if ($newp == "junior") {
	?>
	<h3 class="text-center">Junior Class:</h3>
	<div class="form-group">
		<label>New Intake:</label>
      <input type="number" name="newintake" value="<?php echo $query['newintake'] ?>" class="form-control">
    </div>
    <div class="form-group">
		<label>New Intake JSS 3:</label>
      <input type="number" name="NewIntakeJSS3" value="<?php echo $query['NewIntakeJSS3'] ?>" class="form-control">
    </div>
    <div class="form-group">
    	<label>Termly:</label>
      <input type="number" name="termly" value="<?php echo $query['termly'] ?>" class="form-control">
    </div>
    <div class="form-group">
    	<label>JSS 3:</label>
      <input type="number" name="jss3" value="<?php echo $query['jss3'] ?>" class="form-control">
    </div>
	<?php
}elseif ($newp == "senior") {
	?>
		<h3 class="text-center">Senior Class:</h3>
		<div class="form-group">
		<label>New Intake Art:</label>
	      <input type="number" name="newintakeart" value="<?php echo $query2['newintakeart'] ?>" class="form-control">
	    </div>
	    <div class="form-group">
	    	<label>New Intake Science:</label>
	      <input type="number" name="newintakescience" value="<?php echo $query2['newintakescience'] ?>" class="form-control">
	    </div>
	    <div class="form-group">
	    	<label>Termly Art & Comm. Dept:</label>
	      <input type="number" name="termlyartcomm" value="<?php echo $query2['termlyartcomm'] ?>" class="form-control">
	    </div>
	    <div class="form-group">
	    	<label>Termly Science Dept:</label>
	      <input type="number" name="termlyscience" value="<?php echo $query2['termlyscience'] ?>" class="form-control">
	    </div>
	     <div class="form-group">
	    	<label>SSS 3 Art & Comm. Dept:</label>
	      <input type="number" name="sss3artcomm" value="<?php echo $query2['sss3artcomm'] ?>" class="form-control">
	    </div>
	    <div class="form-group">
	    	<label>SSS 3 Science Dept:</label>
	      <input type="number" name="sss3science" value="<?php echo $query2['sss3science'] ?>" class="form-control">
	    </div>
	    <div class="form-group">
	    	<label>New Intake SSS 3 Art:</label>
	      <input type="number" name="NewIntakeSSS3Art" value="<?php echo $query2['NewIntakeSSS3Art'] ?>" class="form-control">
	    </div>
	    <div class="form-group">
	    	<label>New Intake SSS 3 Science:</label>
	      <input type="number" name="NewIntakeSSS3Science" value="<?php echo $query2['NewIntakeSSS3Science'] ?>" class="form-control">
	    </div>
	<?php
}elseif ($newp == 13 || $newp == 14 || $newp == 15) {
	//Getting details for registration for Senior Secondary
	?>
	<label><p>Senior Class Type:</p></label>
	<select class="form-control" name="classtype">
		<?php
		if (isset($_GET["classtype2"])) {
			//Show previous class type
			if ($_GET["classtype2"] == "newintakeart") {
				?>
				<option value="newintakeart">New Intake Art</option>
				<option>=============</option>
				<?php
			}elseif ($_GET["classtype2"] == "newintakescience") {
				?>
				<option value="newintakescience">New Intake Science</option>
				<option>=============</option>
				<?php
			}elseif ($_GET["classtype2"] == "termlyartcomm") {
				?>
				<option value="termlyartcomm">Termly Art & Comm. Dept</option>
				<option>=============</option>
				<?php
			}elseif ($_GET["classtype2"] == "termlyscience") {
				?>
				<option value="termlyscience">Termly Science Dept</option>
				<option>=============</option>
				<?php
			}elseif ($_GET["classtype2"] == "sss3artcomm") {
				?>
				<option value="sss3artcomm">SSS 3 Art & Comm. Dept</option>
				<option>=============</option>
				<?php
			}elseif ($_GET["classtype2"] == "sss3science") {
				?>
				<option value="sss3science">SSS 3 Science Dept</option>
				<option>=============</option>
				<?php
			}elseif ($_GET["classtype2"] == "NewIntakeSSS3Art") {
				?>
				<option value="NewIntakeSSS3Art">New Intake SSS 3 Art</option>
				<option>=============</option>
				<?php
			}elseif ($_GET["classtype2"] == "NewIntakeSSS3Science") {
				?>
				<option value="NewIntakeSSS3Science">New Intake SSS 3 Science</option>
				<option>=============</option>
				<?php
			}
		}
		?>
		<option value="newintakeart">New Intake Art</option>
		<option value="newintakescience">New Intake Science</option>
		<option value="NewIntakeSSS3Art">New Intake SSS 3 Art</option>
		<option value="NewIntakeSSS3Science">New Intake SSS 3 Science</option>
		<option value="termlyartcomm">Termly Art & Comm. Dept</option>
		<option value="termlyscience">Termly Science Dept</option>
		<option value="sss3artcomm">SSS 3 Art & Comm. Dept</option>
		<option value="sss3science">SSS 3 Science Dept</option>
	</select>
	<br>
	<?php
}elseif ($newp == 16 || $newp == 17 || $newp == 18) {
	//Getting details for junior 
	?>
	<label><p>Junior Class Type:</p></label>
	<select class="form-control" name="classtype">
		<?php
		if (isset($_GET["classtype2"])) {
			//Show previous class type
			if ($_GET["classtype2"] == "newintake") {
				?>
				<option value="newintake">New Intake</option>
				<option>=============</option>
				<?php
			}elseif ($_GET["classtype2"] == "termly") {
				?>
				<option value="termly">Termly</option>
				<option>=============</option>
				<?php
			}elseif ($_GET["classtype2"] == "jss3") {
				?>
				<option value="jss3">JSS 3</option>
				<option>=============</option>
				<?php
			}elseif ($_GET["classtype2"] == "NewIntakeJSS3") {
				?>	
				<option value="NewIntakeJSS3">New Intake JSS 3</option>
				<option>=============</option>
				<?php
			}
		}
		?>
		<option value="newintake">New Intake</option>
		<option value="NewIntakeJSS3">New Intake JSS 3</option>
		<option value="termly">Termly</option>
		<option value="jss3">JSS 3</option>
	</select>
	<br>
	<?php
}
?>