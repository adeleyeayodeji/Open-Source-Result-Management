<?php
session_start();
include('includes/config.php');
if(!empty($_POST["classid"])) 
{
 $cid=intval($_POST['classid']);
 if(!is_numeric($cid)){
 
 	echo htmlentities("invalid Class");exit;
 }
 else{
 $stmt = $dbh->prepare("SELECT StudentName,StudentId, logo FROM tblstudents WHERE ClassId= :id order by StudentName ASC");
 $stmt->execute(array(':id' => $cid));
 ?><option value="">Select Name</option><?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
  <option value="<?php echo htmlentities($row['StudentId']); ?>" data-subtitle="<?php if (isset($_SESSION["teacher"])) {
                                        $tiid = $_SESSION["teachercid"];
                                        $qrq = mysqli_query($con, "SELECT * FROM tblclasses WHERE id = '$tiid' ") or die();
                                        $qrqr = mysqli_fetch_assoc($qrq);
                                        echo $qrqr["ClassName"];
                                    } ?>" data-left="images/<?php echo htmlentities($row['logo']); ?>"><?php echo htmlentities($row['StudentName']); ?></option>
  <?php
 }
}

}
//Getting department for students
if(!empty($_POST["dpartment"])) 
{
 $dpartment=intval($_POST['dpartment']);
 if(!is_numeric($dpartment)){
 
  echo htmlentities("invalid Class");exit;
 }
 else{
//Dynamic query from here
  $squery = mysqli_query($con, "SELECT * FROM tblstudents WHERE StudentId = '$dpartment' ");
  $sqresult = mysqli_fetch_assoc($squery);
  $cid2 = $sqresult['Departments'];

 $stmt = $dbh->prepare("SELECT * FROM tbldepartments WHERE id =:id");
 $stmt->execute(array(':id' => $cid2));
 ?><?php
 $row=$stmt->fetch(PDO::FETCH_ASSOC)
  ?>
  <option value="<?php echo htmlentities($row['id']); ?>" selected><?php echo htmlentities($row['DepartmentName']); ?></option>
  <?php
}

}

// Code for Subjects
if(isset($_POST["classid1"])) 
{
  $dpid = $_POST["classid1"];
  //Dynamic query from here
    $squery = mysqli_query($con, "SELECT * FROM tblstudents WHERE StudentId = '$dpid' ");
    $sqresult = mysqli_fetch_assoc($squery);
    $cid2 = $sqresult['Departments'];
    // echo $dpid;
  $status=0;	
  $stmt = $dbh->prepare("SELECT tblsubjects.SubjectName,tblsubjects.id FROM tblsubjectcombination join  tblsubjects on  tblsubjects.id=tblsubjectcombination.SubjectId WHERE tblsubjectcombination.ClassId=:cid and tblsubjectcombination.status!=:stts order by tblsubjects.SubjectName DESC");
  $stmt->execute(array(':cid' => $cid2,':stts' => $status));
  
  while($row=$stmt->fetch(PDO::FETCH_ASSOC))
  {?>
    <p>Cont Ass. for <?php echo htmlentities($row['SubjectName']); ?><input type="number"  name="tmarks[]" value="" class="form-control" placeholder="Enter marks out of 40" autocomplete="off" min="1" max="40"></p>
    <p><b>Exam for <?php echo htmlentities($row['SubjectName']); ?></b><input type="number"  name="marks[]" value="" class="form-control" placeholder="Enter marks out of 60" autocomplete="off" min="1" max="60"></p>
    
  <?php  }

}


?>

<?php

if(!empty($_POST["studclass"])) 
{
      $admint = $adminresult->term;
      $admins = $adminresult->session;
      $id= $_POST['studclass'];
      $dta=explode("$",$id);
      $id=$dta[0];
      $id1=$dta[1];
      $query = $dbh->prepare("SELECT StudentId,ClassId FROM tblresult WHERE StudentId=:id1 and ClassId=:id and term = :admint AND year = :admins ");
      //$query= $dbh -> prepare($sql);
      $query-> bindParam(':id1', $id1, PDO::PARAM_STR);
      $query-> bindParam(':id', $id, PDO::PARAM_STR);
      $query-> bindParam(':admint', $admint, PDO::PARAM_STR);
      $query-> bindParam(':admins', $admins, PDO::PARAM_STR);
      $query-> execute();
      $results = $query -> fetchAll(PDO::FETCH_OBJ);
      $cnt=1;
      if($query -> rowCount() > 0)
      { 
        echo "added";
      }else{
        echo "not added";

      }

  }?>


