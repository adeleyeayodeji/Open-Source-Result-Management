<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<?php include('includes/header.php');?>
<style type="text/css">
.content-wrapper {
    margin: 0 auto;
    max-width: 1336px;
    min-width: 1336px;
}

@media print {
    .content-wrapper {
        margin: 0 auto;
        max-width: 1100px;
        min-width: 1100px;
        font-size: 20px;
    }
}
</style>
<div class="content-wrapper">
    <div class="content-container">
        <!-- /.left-sidebar -->
        <div class="main-page">
            <div class="container-fluid">
                <div class="row page-title-div" style="background: transparent;">

                    <?php
                            $stmt = $dbh->query("SELECT * FROM settings");
                            $rowprint = $stmt->fetch(PDO::FETCH_OBJ);
                            ?>
                    <?php
// code Student Data
$rollid=$_POST['studentid'];
$pin=$_POST['pin'];
$classid=$_POST['class'];
$examyear=$_POST['examyear'];
$term=$_POST['term'];
$_SESSION['rollid']=$rollid;
$_SESSION['classid']=$classid;
$_SESSION['examyear']=$examyear;
$_SESSION['term']=$term;
$qery = "SELECT   tblstudents.StudentName,tblstudents.logo,tblstudents.Departments,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.RollId=:rollid and tblstudents.ClassId=:classid ";
$stmt = $dbh->prepare($qery);
$stmt->bindParam(':rollid',$rollid,PDO::PARAM_STR);
$stmt->bindParam(':classid',$classid,PDO::PARAM_STR);
$stmt->execute();
$resultss=$stmt->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($stmt->rowCount() > 0)
{
foreach($resultss as $row)
{   ?>
                    <div class="printindis" style="width: 100%;">
                        <img src="images/<?php echo htmlentities($rowprint->logo); ?>"
                            style="height: 124px;margin-left: 12%;">
                        <div style="float: right;margin-right: 16%;text-align: center;">
                            <div style="float: left;">
                                <h1
                                    style="text-transform: uppercase;margin: 0px;font-size: 38px;margin-bottom: 7px;font-family: Arial Black;">
                                    <?php echo htmlentities($rowprint->title); ?></h1>
                                <p
                                    style="text-transform: uppercase;font-weight: bold;background: black;color: white;padding: 5px;text-align: left;margin-bottom: 1px;">
                                    <b style="margin-left: 31px;">Motto:</b> <span
                                        style="margin-left:37px; "><?php echo htmlentities($rowprint->description); ?></span>
                                </p>
                                <p style="margin:0px;padding: 0px;">
                                    3, Awotunde Temidire Street, Off Shogbesan Ave, Moshalasi Bus Stop, Alagbado, Lagos.
                                </p>
                                <p style="margin:0px;padding: 0px;">
                                    <b>PRIMARY: </b>11, Temidire Street, Off Awolu, Moshalasi Bus Stop, Alagbado, Lagos.
                                </p>
                            </div>
                            <div
                                style="float: left;background: url('images/<?php echo htmlentities($row->logo); ?>');height: 121px;width: 144px;background-position: center top;background-size: cover;background-repeat: no-repeat;margin-left: 39px;border: 2px solid #d3d3d3;">

                            </div>
                        </div>
                    </div>
                    <!-- For Printing -->
                    <div class="printing" style="width: 100%;margin-left: auto;margin-right: auto;">
                        <div style="margin-left: 207px;text-align: center;">
                            <div style="float: left;margin-left: -8%;">
                                <img src="images/<?php echo htmlentities($rowprint->logo); ?>"
                                    style="height: 67px;margin-left: 0%;">
                            </div>

                            <div style="    float: left;margin-left: 0%;font-size: medium;">
                                <h1
                                    style="text-transform: uppercase;margin: 0px;font-size: 30px;margin-bottom: 7px;font-family: Arial Black;">
                                    <?php echo htmlentities($rowprint->title); ?></h1>
                                <p
                                    style="text-transform: uppercase;font-weight: bold;background: black;color: white;padding: 5px;text-align: left;margin-bottom: 1px;">
                                    <b style="margin-left: 31px;">Motto:</b> <span
                                        style="margin-left:37px; "><?php echo htmlentities($rowprint->description); ?></span>
                                </p>
                                <p style="margin:0px;padding: 0px;">
                                    3, Awotunde Temidire Street, Off Shogbesan Ave, Moshalasi Bus Stop, Alagbado, Lagos.
                                </p>
                                <p style="margin:0px;padding: 0px;">
                                    <b>PRIMARY: </b>11, Temidire Street, Off Awolu, Moshalasi Bus Stop, Alagbado, Lagos.
                                </p>
                            </div>
                            <div style="float: left;">
                                <img src="images/<?php echo htmlentities($row->logo); ?>" style="height: 74px;
    border: 2px solid #d3d3d3;
    object-fit: cover;
    width: 74px;
    object-position: center top;
    margin-left: 5px;">
                            </div>


                        </div>
                        <?php } 

    ?>


                    </div>
                    <!-- /.row -->

                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->

                <section class="section">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h2 style="text-align: center;margin-bottom: 5px;font-family: calibri;">
                                                Continuos Assessment Report <br>FOR SENIOR SECONDARY SCHOOLS</h2>
                                            <?php
                                    // code Student Data
                                    $rollid=$_POST['studentid'];
                                    $classid=$_POST['class'];
                                    $m_term = $_POST["term"];
                                    $m_year = $_POST["examyear"];
                                    $_SESSION['rollid']=$rollid;
                                    $_SESSION['classid']=$classid;
                                    $qery = "SELECT   tblstudents.StudentName,tblstudents.Gender,tblstudents.DOB,tblstudents.Departments,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.RollId=:rollid and tblstudents.ClassId=:classid ";
                                    $stmt = $dbh->prepare($qery);
                                    $stmt->bindParam(':rollid',$rollid,PDO::PARAM_STR);
                                    $stmt->bindParam(':classid',$classid,PDO::PARAM_STR);
                                    $stmt->execute();
                                    $resultss=$stmt->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($stmt->rowCount() > 0)
                                    {
                                    foreach($resultss as $row)
                                    {   ?>
                                            <?php 
                                            $query_result ="select t.StudentName,t.RollId,t.ClassId,t.marks,t.term,t.year,t.adminstatus,t.daysschool,t.dayspresent,t.daysabsence,t.termbegin,t.termends,t.termnext,t.Status,t.tmarks,SubjectId,tblsubjects.SubjectName from (select sts.StudentName,sts.RollId,sts.ClassId,tr.marks,tr.Status,tr.adminstatus,tr.daysschool,tr.term,tr.dayspresent,tr.daysabsence,tr.year,tr.termbegin,tr.termends,tr.termnext,tr.tmarks,SubjectId from tblstudents as sts join  tblresult as tr on tr.StudentId=sts.StudentId) as t join tblsubjects on tblsubjects.id=t.SubjectId where (t.RollId=:rollid and t.ClassId=:classid)";
                                            $query_result= $dbh -> prepare($query_result);
                                            $query_result->bindParam(':rollid',$rollid,PDO::PARAM_STR);
                                            $query_result->bindParam(':classid',$classid,PDO::PARAM_STR);
                                            $query_result-> execute();  
                                            $results_check = $query_result -> fetchAll(PDO::FETCH_OBJ);
                                            // echo var_dump($results_check);
                                            if ($results_check[0]->adminstatus == 0) {
                                                ?>
                                            <style type="text/css">
                                            table {
                                                display: none !important;
                                            }
                                            </style>
                                            <div class="alert alert-warning left-icon-alert" role="alert">
                                                <center><strong>Notice!</strong> Result not active yet</center>
                                            </div>
                                            <!--JS TO REMOVE DIV-->
                                            <script>
                                                $(() => {
                                                    $("#all_result").remove();
                                                })
                                            </script>
                                            <?php
                                            }elseif($m_term != $results_check[0]->term){
                                                ?>
                                                <style type="text/css">
                                            table {
                                                display: none !important;
                                            }
                                            </style>
                                            <div class="alert alert-warning left-icon-alert" role="alert">
                                                <center><strong>Notice!</strong> Result Term Not Match</center>
                                            </div>
                                             <!--JS TO REMOVE DIV-->
                                            <script>
                                                $(() => {
                                                    $("#all_result").remove();
                                                })
                                            </script>
                                                <?php
                                            }elseif($m_year != $results_check[0]->year){
                                                ?>
                                                        <style type="text/css">
                                                table {
                                                    display: none !important;
                                                }
                                                </style>
                                                <div class="alert alert-warning left-icon-alert" role="alert">
                                                    <center><strong>Notice!</strong> Result Year Not Match</center>
                                                </div>
                                                 <!--JS TO REMOVE DIV-->
                                            <script>
                                                $(() => {
                                                    $("#all_result").remove();
                                                })
                                            </script>
                                                <?php
                                            }else{



                                        ?>
                                            <div class="firsttable" style="float: left;width: 35%;">
                                                <table class="table table-hover table-bordered"
                                                    style="width: 100%;text-align: left;">

                                                    <thead>
                                                        <tr>
                                                            <th scope="row" colspan="3" class="tst"
                                                                style="padding: 10px;text-transform: uppercase;">
                                                                <h3>Student Personal Data</h3>
                                                            </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td scope="row" colspan="2" style="font-weight: bold;">Name
                                                                <em>(Surname First)</em>
                                                            </td>
                                                            <td style="text-align: center;text-transform: uppercase;">
                                                                <?php echo htmlentities($row->StudentName);?></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" colspan="2" style="font-weight: bold;">Date
                                                                of Birth</td>
                                                            <td style="text-align: center;text-transform: uppercase;">
                                                                <?php echo htmlentities(date("F j, Y", strtotime($row->DOB)));?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" colspan="2" style="font-weight: bold;">Sex
                                                            </td>
                                                            <td style="text-align: center;text-transform: uppercase;">
                                                                <?php echo htmlentities($row->Gender);?></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" colspan="2" style="font-weight: bold;">Class
                                                            </td>
                                                            <td style="text-align: center;text-transform: uppercase;">
                                                                <?php echo htmlentities($row->ClassName);?></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" colspan="2" style="font-weight: bold;">
                                                                Department </td>
                                                            <td style="text-align: center;text-transform: uppercase;"><?php
                                                     $dpid = $row->Departments;
                                                             $squery = mysqli_query($con, "SELECT * FROM tbldepartments WHERE id = '$dpid' ");
                                                              $sqresult = mysqli_fetch_assoc($squery);
                                                             echo htmlentities($sqresult['DepartmentName']);
                                                 ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" colspan="2" style="font-weight: bold;">
                                                                Student ID </td>
                                                            <td style="text-align: center;text-transform: lowercase;">
                                                                <code><?php echo htmlentities($row->RollId);?></code>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="secondtable" style="float: right;width: 64%;">
                                                                
                                                <table class="table table-hover table-bordered"
                                                    style="width: 100%;text-align: center;">

                                                    <thead>
                                                        <tr>
                                                            <th scope="row" colspan="3" class="tst"
                                                                style="padding: 10px;text-transform: uppercase;">
                                                                <h3>attendance</h3>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td scope="row" colspan="1"
                                                                style="text-align: center;font-weight: bold;">No. of
                                                                Days School Opened</td>
                                                            <td scope="row" colspan="1"
                                                                style="text-align: center;font-weight: bold;">No. of
                                                                Days Present</td>
                                                            <td scope="row" colspan="1"
                                                                style="text-align: center;font-weight: bold;">No. of
                                                                Days Absence</td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $results_check[0]->daysschool; ?></td>
                                                            <td><?php echo $results_check[0]->dayspresent; ?></td>
                                                            <td><?php echo $results_check[0]->daysabsence; ?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                                <table class="table table-hover table-bordered"
                                                    style="width: 100%;text-align: center;">

                                                    <thead>
                                                        <tr>
                                                            <th scope="row" colspan="3" class="tst"
                                                                style="padding: 10px;text-transform: uppercase;">
                                                                <h3>terminal duration</h3>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td scope="row" colspan="1"
                                                                style="text-align: center;font-weight: bold;">Term
                                                                Begins</td>
                                                            <td scope="row" colspan="1"
                                                                style="text-align: center;font-weight: bold;">Term Ends
                                                            </td>
                                                            <td scope="row" colspan="1"
                                                                style="text-align: center;font-weight: bold;">Next Term
                                                                Begins</td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $results_check[0]->termbegin; ?></td>
                                                            <td><?php echo $results_check[0]->termends; ?></td>
                                                            <td><?php echo $results_check[0]->termnext; ?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php } ?>
                                            <?php
                                     $termid = $row->StudentId;
                                     $query = mysqli_query($con, "SELECT term FROM tblresult WHERE StudentId='$termid' ") or die();
                                     $resultterm = mysqli_fetch_assoc($query);
                                     ?>
                                            <?php }
                                    }
                                        ?>
                                        </div>
                                        <style type="text/css">
                                        table {
                                            text-align: center;
                                        }

                                        th {
                                            text-align: center;

                                        }

                                        .tst {
                                            background: lightgrey;
                                        }
                                        </style>
                                        <div class="panel-body p-20" id="all_result">
                                            <table class="table table-hover table-bordered" style="text-align: center;">
                                                <div
                                                    style="padding: 10px;text-align: center;background:lightgrey;text-transform: uppercase;clear: both;">
                                                    <h3>Academic Preformance</h3>
                                                </div>
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Cont. Assess.</th>
                                                        <th>Exam Score</th>
                                                        <th><?php echo $resultterm["term"];?> Score</th>
                                                        <th>Grade</th>
                                                        <th>Teacher's Comment</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="tst">Max Obt. Mark</th>
                                                        <th class="tst">40%</th>
                                                        <th class="tst">60%</th>
                                                        <th class="tst">100%</th>
                                                        <th class="tst"></th>
                                                        <th class="tst"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php                                              
                                            // Code for result

                                             $query ="select t.StudentName,t.RollId,t.ClassId,t.marks,t.tmarks,SubjectId,tblsubjects.SubjectName from (select sts.StudentName,sts.RollId,sts.ClassId,tr.marks,tr.tmarks,SubjectId from tblstudents as sts join  tblresult as tr on tr.StudentId=sts.StudentId) as t join tblsubjects on tblsubjects.id=t.SubjectId where (t.RollId=:rollid and t.ClassId=:classid)";
                                            $query= $dbh -> prepare($query);
                                            $query->bindParam(':rollid',$rollid,PDO::PARAM_STR);
                                            $query->bindParam(':classid',$classid,PDO::PARAM_STR);
                                            $query-> execute();  
                                            $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($countrow=$query->rowCount()>0)
                                            { 
                                            foreach($results as $result){
                                            ?>

                                                    <tr>
                                                        <td><?php echo htmlentities($result->SubjectName);?></td>
                                                        <td><?php echo htmlentities($result->tmarks);?></td>
                                                        <td><?php echo htmlentities($result->marks);?></td>
                                                        <td><?php echo htmlentities($totalmarks=$result->marks+$result->tmarks);?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                        if ($result->marks+$result->tmarks >= 75 && $result->marks+$result->tmarks <= 100) { 
                                                         echo "A1";
                                                        } 

                                                        if ($result->marks+$result->tmarks >= 70 && $result->marks+$result->tmarks <= 74) { 
                                                         echo "B2";
                                                        } 

                                                        if ($result->marks+$result->tmarks >= 65 && $result->marks+$result->tmarks <= 69) { 
                                                         echo "B3";
                                                        } 

                                                        if ($result->marks+$result->tmarks >= 60 && $result->marks+$result->tmarks <= 64) { 
                                                         echo "C4";
                                                        } 

                                                        if ($result->marks+$result->tmarks >= 55 && $result->marks+$result->tmarks <= 59) { 
                                                         echo "C5";
                                                        } 

                                                        if ($result->marks+$result->tmarks >= 50 && $result->marks+$result->tmarks <= 54) { 
                                                         echo "C6";
                                                        } 

                                                        if ($result->marks+$result->tmarks >= 45 && $result->marks+$result->tmarks <= 49) { 
                                                         echo "D7";
                                                        } 

                                                         if ($result->marks+$result->tmarks >= 40 && $result->marks+$result->tmarks <= 44) { 
                                                         echo "D8";
                                                        } 

                                                        if ($result->marks+$result->tmarks >= 0 && $result->marks+$result->tmarks <= 39) { 
                                                         echo "F9";
                                                        } 

                                                        ?></td>

                                                        <td>
                                                            <?php 
                                                        if ($result->marks+$result->tmarks >= 75 && $result->marks+$result->tmarks <= 100) { 
                                                         echo "Excellent";
                                                        } 

                                                        if ($result->marks+$result->tmarks >= 70 && $result->marks+$result->tmarks <= 74) { 
                                                         echo "Very Good";
                                                        } 

                                                        if ($result->marks+$result->tmarks >= 65 && $result->marks+$result->tmarks <= 69) { 
                                                         echo "Good";
                                                        } 

                                                        if ($result->marks+$result->tmarks >= 60 && $result->marks+$result->tmarks <= 64) { 
                                                         echo "Credit";
                                                        } 

                                                        if ($result->marks+$result->tmarks >= 55 && $result->marks+$result->tmarks <= 59) { 
                                                         echo "Credit";
                                                        } 

                                                        if ($result->marks+$result->tmarks >= 50 && $result->marks+$result->tmarks <= 54) { 
                                                         echo "Credit";
                                                        } 

                                                        if ($result->marks+$result->tmarks >= 45 && $result->marks+$result->tmarks <= 49) { 
                                                         echo "Pass";
                                                        } 

                                                         if ($result->marks+$result->tmarks >= 40 && $result->marks+$result->tmarks <= 44) { 
                                                         echo "Pass";
                                                        } 

                                                        if ($result->marks+$result->tmarks >= 0 && $result->marks+$result->tmarks <= 39) { 
                                                         echo "Fail";
                                                        } 

                                                        ?></td>
                                                    </tr>

                                                    <?php 
                                                $totlcount+=$totalmarks;
                                                $cnt++;}
                                                ?>
                                                    <tr>
                                                        <th scope="row" colspan="1" class="tst">Num Of Sub</th>
                                                        <th scope="row" colspan="2" class="tst">Total Marks</th>
                                                        <th scope="row" colspan="1" class="tst">Percentage</th>
                                                        <th scope="row" colspan="1" class="tst">Grade</th>
                                                        <th scope="row" colspan="1" class="tst">Teacher's Comment</th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="1"><?php $nud = $cnt-1; echo $nud; ?>
                                                        </th>
                                                        <th scope="row" colspan="2">
                                                            <b><?php echo htmlentities($totlcount); ?></b>
                                                        </th>
                                                        <td><b><?php 
                                                                    $nuc = $cnt-1;
                                                                    $num =  $totlcount/$nuc;
                                                                    $totalnum =  round($num);
                                                                    echo htmlentities($totalnum);
                                                                ?> %</b></td>
                                                        <td>
                                                            <?php 
                                                        if ($totalnum >= 75 && $totalnum <= 100) { 
                                                         echo "A1";
                                                        } 

                                                        if ($totalnum >= 70 && $totalnum <= 74) { 
                                                         echo "B2";
                                                        } 

                                                        if ($totalnum >= 65 && $totalnum <= 69) { 
                                                         echo "B3";
                                                        } 

                                                        if ($totalnum >= 60 && $totalnum <= 64) { 
                                                         echo "C4";
                                                        } 

                                                        if ($totalnum >= 55 && $totalnum <= 59) { 
                                                         echo "C5";
                                                        } 

                                                        if ($totalnum >= 50 && $totalnum <= 54) { 
                                                         echo "C6";
                                                        } 

                                                        if ($totalnum >= 45 && $totalnum <= 49) { 
                                                         echo "D7";
                                                        } 

                                                         if ($totalnum >= 40 && $totalnum <= 44) { 
                                                         echo "D8";
                                                        } 

                                                        if ($totalnum >= 0 && $totalnum <= 39) { 
                                                         echo "F9";
                                                        } 

                                                        ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                        if ($totalnum >= 75 && $totalnum <= 100) { 
                                                         echo "Excellent";
                                                        } 

                                                        if ($totalnum >= 70 && $totalnum <= 74) { 
                                                         echo "Very Good";
                                                        } 

                                                        if ($totalnum >= 65 && $totalnum <= 69) { 
                                                         echo "Good";
                                                        } 

                                                        if ($totalnum >= 60 && $totalnum <= 64) { 
                                                         echo "Credit";
                                                        } 

                                                        if ($totalnum >= 55 && $totalnum <= 59) { 
                                                         echo "Credit";
                                                        } 

                                                        if ($totalnum >= 50 && $totalnum <= 54) { 
                                                         echo "Credit";
                                                        } 

                                                        if ($totalnum >= 45 && $totalnum <= 49) { 
                                                         echo "Pass";
                                                        } 

                                                         if ($totalnum >= 40 && $totalnum <= 44) { 
                                                         echo "Pass";
                                                        } 

                                                        if ($totalnum >= 0 && $totalnum <= 39) { 
                                                         echo "Fail";
                                                        } 

                                                        ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="3">Print Result</th>
                                                        <td></td>
                                                        <th scope="row" colspan="3" onclick="window.print();"
                                                            style="cursor: pointer;background: lightgrey;"><i
                                                                class="fa fa-print"></i> Print Result</th>
                                                    </tr>
                                                    <?php } else { ?>
                                                    <div class="alert alert-warning left-icon-alert" role="alert">
                                                        <strong>Notice!</strong> Your result is not declare yet
                                                        <?php }
                                                    ?>
                                                    </div>
                                                    <?php 
                                                     } 
                                                     else{
                                                    ?>

                                                    <div class="alert alert-danger left-icon-alert" role="alert">
                                                        <strong>Oh snap!</strong>
                                                        <?php
                                                    echo htmlentities("Wrong Student ID or Class");
                                                    echo "<a href='find-result.php' class='btn btn-primary' style='float: right;background: black;color: white;'>Check again</a>";
                                                     }
                                                  ?>
                                                    </div>



                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <!-- /.panel -->
                                </div>
                                <!-- /.col-md-6 -->
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <a href="find-result.php">Back to Result</a>
                                    </div>
                                </div>

                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.container-fluid -->
                    </div>
                </section>
                <!-- /.section -->

            </div>
            <!-- /.main-page -->


        </div>
        <!-- /.content-container -->
    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /.main-wrapper -->
<?php include 'includes/credit.php'; ?>
<!-- ========== COMMON JS FILES ========== -->

<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/pace/pace.min.js"></script>
<script src="js/lobipanel/lobipanel.min.js"></script>
<script src="js/iscroll/iscroll.js"></script>

<!-- ========== PAGE JS FILES ========== -->
<script src="js/prism/prism.js"></script>

<!-- ========== THEME JS ========== -->
<script src="js/main.js"></script>
<script>
$(function($) {

});
</script>

<!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

</body>

</html>