<?php
    include('../includes/config.php');
    //Fix cross Origin
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
    //Fix cross Origin
    header("Content-Type: application/json");

$message = "message";

if(isset($_POST['submit_result']))
{

$con_marks = explode(",", $_POST["marks"]);
$con_tmarks = explode(",", $_POST["tmarks"]);

$marks=array();
$class = $_POST['teacherid'];
$studentid=$_POST['studentid']; 
$mark = $con_marks;
$tmark= $con_tmarks;
//Adding more function
$term=$_POST['term'];
$year=$_POST['year'];
$Department=$_POST['Department'];
$daysschool=$_POST['daysschool'];
$dayspresent=$_POST['dayspresent'];
$daysabsence=$_POST['daysabsence'];
$termbegin=$_POST['termbegin'];
$termends=$_POST['termends'];
$termnext=$_POST['termnext'];

 $stmt = $dbh->prepare("SELECT tblsubjects.SubjectName,tblsubjects.id FROM tblsubjectcombination join  tblsubjects on  tblsubjects.id = tblsubjectcombination.SubjectId WHERE tblsubjectcombination.ClassId = :cid order by tblsubjects.SubjectName DESC");
 $stmt->execute(array(':cid' => $Department));
  $sid1=array();
  //Generate SubjectId for base
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
    //Concatinate new array
array_push($sid1,$row['id']);
   } 

//Loop through marks to save to base
for($i=0;$i<count($mark);$i++){
    $mar=$mark[$i];
    $tmar=$tmark[$i];
  $sid=$sid1[$i];
$sql="INSERT INTO  tblresult(StudentId,ClassId,SubjectId,marks,term,year,Department,tmarks,daysschool,dayspresent,daysabsence,termbegin,termends,termnext) VALUES(:studentid,:class,:sid,:marks,:term,:year,:Department,:tmarks,:daysschool,:dayspresent,:daysabsence,:termbegin,:termends,:termnext)";
$query = $dbh->prepare($sql);
$query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
//Adding more funtion
$query->bindParam(':term',$term,PDO::PARAM_STR);
$query->bindParam(':year',$year,PDO::PARAM_STR);
$query->bindParam(':Department',$Department,PDO::PARAM_STR);
$query->bindParam(':class',$class,PDO::PARAM_STR);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':marks',$mar,PDO::PARAM_STR);
$query->bindParam(':tmarks',$tmar,PDO::PARAM_STR);
$query->bindParam(':daysschool',$daysschool,PDO::PARAM_STR);
$query->bindParam(':dayspresent',$dayspresent,PDO::PARAM_STR);
$query->bindParam(':daysabsence',$daysabsence,PDO::PARAM_STR);
$query->bindParam(':termbegin',$termbegin,PDO::PARAM_STR);
$query->bindParam(':termends',$termends,PDO::PARAM_STR);
$query->bindParam(':termnext',$termnext,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
	$message = "Result info added successfully";
}
else 
{
	$message = "Something went wrong. Please try again";
}
}

echo json_encode(array('info' => $message ));
}



?>