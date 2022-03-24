<?php
    include('../includes/config.php');
    //Fix cross Origin
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
    //Fix cross Origin
    // header("Content-Type: application/json");

    if(!empty($_POST["check_declared"])) 
	{
	  $StudentId = $_POST["StudentId"];
	  $ClassId = $_POST["ClassId"];
	  // SQL
      $query = $dbh->prepare("SELECT StudentId,ClassId FROM tblresult WHERE StudentId=:StudentId and ClassId=:ClassId ");
      $query-> bindParam(':StudentId', $StudentId, PDO::PARAM_STR);
      $query-> bindParam(':ClassId', $ClassId, PDO::PARAM_STR);
      $query-> execute();
      $results = $query -> fetchAll(PDO::FETCH_OBJ);
      $cnt=1;
      if($query -> rowCount() > 0)
      { 
        echo json_encode(array('info' => "added" ));
      }else{
        echo json_encode(array('info' => "not added" ));

      }
  }

  //Getting department for students
if(!empty($_POST["dpartment"])) 
{
	 $dpartment = $_POST['dpartment'];
	//Dynamic query from here
	 $stmt = $dbh->prepare("SELECT * FROM tbldepartments WHERE id =:id");
	 $stmt->execute(array(':id' => $dpartment));
	 $row=$stmt->fetch(PDO::FETCH_ASSOC);
	 //Returning the result
	 echo json_encode(array('did' => $row['id'], 'dname' => $row['DepartmentName']));
}


// Get all subject for student
if(isset($_POST["student_subject"])) 
{
  $student_subject = $_POST["student_subject"];
  //Dynamic query from here
    $squery = mysqli_query($con, "SELECT * FROM tblstudents WHERE StudentId = '$student_subject' ");
    $sqresult = mysqli_fetch_assoc($squery);
    $cid2 = $sqresult['Departments'];
    //Run base
  $status=0;	
  $stmt = $dbh->prepare("SELECT tblsubjects.SubjectName,tblsubjects.id FROM tblsubjectcombination join  tblsubjects on  tblsubjects.id=tblsubjectcombination.SubjectId WHERE tblsubjectcombination.ClassId=:cid and tblsubjectcombination.status!=:stts order by tblsubjects.SubjectName DESC");
  $stmt->execute(array(':cid' => $cid2,':stts' => $status));
  
  while($row=$stmt->fetch(PDO::FETCH_ASSOC))
  {
  	$rows[] = array('name' => $row['SubjectName'], 'formcontrol' => 'tmarks');
  }

  $newarray = array('subject_name' => $rows);
  echo json_encode($newarray);
}

//Load result for publish or empty
if (isset($_GET["load_result"])) {
      $tiid = $_GET["load_result"];
      //SQL
      $sql = "SELECT  distinct tblstudents.StudentName,tblstudents.logo,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblclasses.ClassName,tblclasses.Section,tblresult.Department,tblresult.Status,tblresult.year,tblresult.term from tblresult join tblstudents on tblstudents.StudentId=tblresult.StudentId  join tblclasses on tblclasses.id=tblresult.ClassId WHERE tblclasses.id = '$tiid' ORDER BY tblresult.id DESC";
      //Run query
      $query = $dbh->prepare($sql);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
      if($query->rowCount() > 0)
      {
          echo json_encode(array('response' => $results ));
      }else{
           echo json_encode(array('response' => array() ));
      }
}
//Load result for publish or empty ends here


//Check Result
if (isset($_POST["view_result"])) {
    //Parameter
    $rollid=$_POST['studentid'];
    $classid=$_POST['classid'];

  //SQL
   $query ="select t.Departments, t.StudentName,t.StudentId,t.RollId,t.ClassId,t.marks,t.tmarks,t.id,t.term,SubjectId,tblsubjects.SubjectName from (select sts.Departments ,sts.StudentName,sts.StudentId,sts.RollId,sts.ClassId,tr.marks,tr.id,tr.tmarks,SubjectId,tr.term from tblstudents as sts join  tblresult as tr on tr.StudentId=sts.StudentId) as t join tblsubjects on tblsubjects.id=t.SubjectId where (t.RollId=:rollid and t.ClassId=:classid)";
    $query= $dbh -> prepare($query);
    $query->bindParam(':rollid',$rollid,PDO::PARAM_STR);
    $query->bindParam(':classid',$classid,PDO::PARAM_STR);
    $query-> execute();  
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    if($countrow=$query->rowCount()>0)
    {
      $info2 = array();
      foreach ($results as $result) {
          $new = array('SubjectName' => $result->SubjectName, 'marks' => $result->tmarks.','.$result->marks );
          array_push($info2, $new);
      }
      //Return result
      echo json_encode(array('info' => $results, 'info2' => $info2, 'did' => $results[0]->Departments, 'term' => $results[0]->term));
    }else{
      echo json_encode(array('info' => "No result" ));
    }
}

//Load terms
if (isset($_POST['getterm'])) {
    $depart = $_POST['stid'];
     $query = mysqli_query($con, "SELECT * FROM tblresult WHERE StudentId='$depart' ") or die();
     $resultde = mysqli_fetch_assoc($query);
     echo json_encode(array('info' => $resultde ));
}

function revision($id, $con)
{
    $query = mysqli_query($con, "SELECT * FROM tblresult WHERE id ='$id' ") or die();
    $resultde = mysqli_fetch_assoc($query);
    return (int)$resultde["revision_"] + 1;
}

//Update result
if(isset($_POST['update_result']))
  {
      $con_marks = explode(",", $_POST["marks"]);
      $con_tmarks = explode(",", $_POST["tmarks"]);
      $con_id = explode(",", $_POST["id"]);

      $rowid=$con_id;
      $marks=$con_marks;
      $tmarks=$con_tmarks; 
      $daysschool=$_POST['daysschool']; 
      $dayspresent=$_POST['dayspresent']; 
      $daysabsence=$_POST['daysabsence']; 
      $termbegin=$_POST['termbegin']; 
      $termends=$_POST['termends']; 
      $termnext=$_POST['termnext']; 

      foreach($rowid as $count => $id){
      $mrks = $marks[$count];
      $tmrks = $tmarks[$count];
      $iid = $rowid[$count];
      $revision_ = revision($iid, $con);

          $sql="UPDATE tblresult SET marks = :mrks, tmarks = :tmrks, daysschool = :daysschool, dayspresent = :dayspresent, daysabsence = :daysabsence, termbegin = :termbegin, termends = :termends, termnext = :termnext, adminstatus=:adminstatus, revision_=:revision_ WHERE id = :iid ";
          $query = $dbh->prepare($sql);
          $query->bindParam(':mrks',$mrks,PDO::PARAM_STR);
          $query->bindParam(':tmrks',$tmrks,PDO::PARAM_STR);
          $query->bindParam(':daysschool',$daysschool,PDO::PARAM_STR);
          $query->bindParam(':dayspresent',$dayspresent,PDO::PARAM_STR);
          $query->bindParam(':daysabsence',$daysabsence,PDO::PARAM_STR);
          $query->bindParam(':termbegin',$termbegin,PDO::PARAM_STR);
          $query->bindParam(':termends',$termends,PDO::PARAM_STR);
          $query->bindParam(':termnext',$termnext,PDO::PARAM_STR);
          $query->bindParam(':adminstatus',"0",PDO::PARAM_STR);
          $query->bindParam(':revision_',$revision_,PDO::PARAM_STR);
          $query->bindParam(':iid',$iid,PDO::PARAM_STR);
          $query->execute();
    }
    if ($query) {
      echo json_encode(array('info' => "Result info updated successfully"));
    }else{
      echo json_encode(array('info' => "Failed to update" ));
    }
}

  
  if(isset($_GET['update_status']))
  {
      $Status = $_GET["Status"];
      $StudentId = $_GET["StudentId"];

       $sql="UPDATE tblresult SET Status = :Status WHERE StudentId = :StudentId ";
          $query = $dbh->prepare($sql);
          $query->bindParam(':Status',$Status,PDO::PARAM_STR);
          $query->bindParam(':StudentId',$StudentId,PDO::PARAM_STR);
          $query->execute();

          if ($query) {
            echo json_encode(array('info' => "Status Updated" ));
          }else{
            echo json_encode(array('info' => "Error updating status" ));
          }
  }

?>