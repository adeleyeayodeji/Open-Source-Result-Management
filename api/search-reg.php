<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header('Content-Type: application/json');

session_start();
// error_reporting(0);
include('../includes/config.php');

if (isset($_GET["reg"])) {
    $tiid = $_GET['tiid'];
    $q = $_GET["q"];
    //Query
		$myArray = array();
		if ($result = $con->query("SELECT tblstudents.StudentName,tblstudents.session,tblstudents.logo,tblstudents.RollId,tblstudents.Departments,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId WHERE tblstudents.StudentName LIKE '%{$q}%' AND tblclasses.id = '$tiid' ORDER BY tblstudents.StudentId DESC ")) {
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$myArray[] = $row;
			}
		    echo json_encode($myArray);
		}
	}


	//Declared search query
	if (isset($_GET["declared"])) {
		$tiid = $_GET['tiid'];
		$q = $_GET["q"];
		//Query
			$myArray = array();
			if ($result = $con->query("SELECT  distinct tblstudents.StudentName,tblstudents.logo,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblclasses.ClassName,tblclasses.Section,tblresult.Department,tblresult.Status,tblresult.year,tblresult.term from tblresult join tblstudents on tblstudents.StudentId=tblresult.StudentId  join tblclasses on tblclasses.id=tblresult.ClassId WHERE tblclasses.id = '$tiid' AND tblstudents.StudentName LIKE '%{$q}%' ORDER BY tblresult.id DESC")) {
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$myArray[] = $row;
				}
				echo json_encode($myArray);
			}
		}


?>
