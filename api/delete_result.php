<?php
    include('../includes/config.php');
    //Fix cross Origin
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
    //Fix cross Origin
    header("Content-Type: application/json");

    if(!empty($_GET["student_id"])) 
	{
	  $StudentId = $_GET["student_id"];
	  $ClassId = $_GET["ClassId"];
      // SQL
      $query = $dbh->prepare("DELETE FROM tblresult WHERE StudentId=:StudentId and ClassId=:ClassId ");
      $query-> bindParam(':StudentId', $StudentId, PDO::PARAM_STR);
      $query-> bindParam(':ClassId', $ClassId, PDO::PARAM_STR);
      $query-> execute();
      if($query)
      { 
        echo json_encode(array('info' => "deleted" ));
      }else{
        echo json_encode(array('info' => "error deleting" ));

      }
  }

  ?>