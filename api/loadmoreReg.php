<?php
    include('../includes/config.php');
    //Fix cross Origin
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
    //Fix cross Origin
    header("Content-Type: application/json");

if (isset($_GET["load_data"])) {

		$tiid = $_GET["load_data"];
	    // define how many results you want per page
		$results_per_page = 10;

		// find out the number of results stored in database
		$sql1 = 'SELECT tblstudents.StudentName,tblstudents.session,tblstudents.logo,tblstudents.RollId,tblstudents.Departments,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId WHERE tblclasses.id = '.$tiid.' ORDER BY tblstudents.StudentId DESC';
		$result1 = $con->query($sql1);
		$number_of_results = mysqli_num_rows($result1);

		// determine number of total pages available
		$number_of_pages = ceil($number_of_results/$results_per_page);

		// determine which page number visitor is currently on
		if (!isset($_GET['page'])) {
		$page = 1;
		} else {
		$page = $_GET['page'];
		}

		// determine the sql LIMIT starting number for the results on the displaying page
		$this_page_first_result = ($page-1)*$results_per_page;

		// retrieve selected results from database and display them on page
		$sql = 'SELECT tblstudents.StudentName,tblstudents.session,tblstudents.logo,tblstudents.RollId,tblstudents.Departments,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId WHERE tblclasses.id = '.$tiid.' ORDER BY tblstudents.StudentId DESC LIMIT '.$this_page_first_result.','.$results_per_page;

		$result = $con->query($sql);

		$myArray = array();
		      while($row = $result->fetch_array(MYSQLI_ASSOC)) {
		              $myArray[] = $row;
		      }
		      echo json_encode(array("info" => $myArray));

		    $result->close();
		    $con->close();	
} else {
	echo json_encode(array("info" => "API Error"));
}
?>


