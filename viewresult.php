<?php
session_start();
error_reporting(0);
include('includes/config.php');

?>
<?php include('includes/header.php');
$admint = $adminresult->term;
$admins = $adminresult->session;
?>
<style type="text/css">
.content-wrapper {
    margin: 0 auto;
    max-width: 1336px;
    min-width: 1336px;
}

@media print {
    .content-wrapper .yes_print {
        margin: 0 auto;
        max-width: 1100px;
        min-width: 1100px;
    }

    .print_p {
        padding-top: 0px !important;
    }

    .content-wrapper {
        margin: 0 auto;
        max-width: 100%;
        min-width: 100%;
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
$classid=$_POST['class'];
$_SESSION['rollid']=$rollid;
$_SESSION['classid']=$classid;
$qery = "SELECT tblstudents.StudentName,tblstudents.logo,tblstudents.Departments,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.RollId=:rollid and tblstudents.ClassId=:classid ";
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
                                    <?php echo $rowprint->address1 ?>
                                </p>
                                <p style="margin:0px;padding: 0px;">
                                    <?php echo $rowprint->address2 ?>
                                </p>
                            </div>
                            <div
                                style="float: left;background: url('images/<?php echo htmlentities($row->logo); ?>');height: 121px;width: 144px;background-position: center top;background-size: cover;background-repeat: no-repeat;margin-left: 39px;border: 2px solid #d3d3d3;">

                            </div>
                        </div>
                    </div>
                    <!-- For Printing -->
                    <div class="yes_print">
                        <div class="printing" style="width: 100%;margin-left: auto;margin-right: auto;">
                            <div style="margin-left: 207px;text-align: center;">
                                <div style="float: left;margin-left: -22%;">
                                    <img src="images/<?php echo htmlentities($rowprint->logo); ?>"
                                        style="height: 110px;margin-left: 0%;">
                                </div>

                                <div style="    float: left;margin-left: -5%;">
                                    <h1
                                        style="text-transform: uppercase;margin: 0px;font-size: 30px;margin-bottom: 7px;font-family: Arial Black;">
                                        <?php echo htmlentities($rowprint->title); ?></h1>
                                    <p
                                        style="text-transform: uppercase;font-weight: bold;background: black;color: white;padding: 5px;text-align: left;margin-bottom: 1px;">
                                        <b style="margin-left: 31px;">Motto:</b> <span
                                            style="margin-left:37px; "><?php echo htmlentities($rowprint->description); ?></span>
                                    </p>
                                    <p style="margin:0px;padding: 0px;">
                                        <?php echo $rowprint->address1 ?>
                                    </p>
                                    <p style="margin:0px;padding: 0px;">
                                        <?php echo $rowprint->address2 ?>
                                    </p>
                                </div>
                                <div style="float: left;">
                                    <img src="images/<?php echo htmlentities($row->logo); ?>" style="height: 113px;
    border: 2px solid #d3d3d3;
    object-fit: cover;
    width: 133px;
    object-position: center top;
    margin-left: 5px;">
                                </div>


                            </div>
                            <?php } 

    ?>


                        </div>
                    </div>
                    <!-- /.row -->

                    <!-- /.row -->
                </div>
                <!-- /.container-fluid --

                <section class="section print_p">
                   <div class="container-fluid">
                       <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel print_p">
                                    <div class="panel-heading print_p">
                                        <div class="panel-title print_p">

                                            <?php
                                    // code Student Data
                                    // code of student data 
                                    $rollid=$_POST['studentid'];
                                    $classid=$_POST['class'];
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
                                    { ?>
                                            <h2 style="text-align: center;margin-bottom: 5px;font-family: calibri;">
                                                Continuous Assessment Report <br>FOR
                                                <?php 
                                    $dpid = $row->Departments;
                                     $squery = mysqli_query($con, "SELECT * FROM tbldepartments WHERE id = '$dpid' ");
                                     $sqresult = mysqli_fetch_assoc($squery);
                                     echo $sqresult['DepartmentName'] == "General" ? "JUNIOR" : "SENIOR";
                                    ?>
                                                SECONDARY SCHOOLS</h2>
                                            <?php
                                    foreach($resultss as $row)
                                    {   ?>
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
                                                            <td id="studentnameid"
                                                                style="text-align: center;text-transform: uppercase;">
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
                                                            <td id="classname"
                                                                style="text-align: center;text-transform: uppercase;">
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
                                                                Days Absent</td>
                                                        </tr>
                                                        <tr>


                                                            <?php
                                                $moreid = $row->StudentId;
                                                $stmt = $dbh->query("SELECT * FROM tblresult WHERE StudentId = '$moreid' and term = '$admint' and year = '$admins'");
                                                $moredata = $stmt->fetch(PDO::FETCH_OBJ);
                                                ?>
                                                            <td><?php echo htmlentities($moredata->daysschool); ?></td>
                                                            <td><?php echo htmlentities($moredata->dayspresent); ?></td>
                                                            <td><?php echo htmlentities($moredata->daysabsence); ?></td>
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
                                                            <td><?php echo htmlentities($moredata->termbegin); ?></td>
                                                            <td><?php echo htmlentities($moredata->termends); ?></td>
                                                            <td><?php echo htmlentities($moredata->termnext); ?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php
                                     $termid = $row->StudentId;
                                     $query = mysqli_query($con, "SELECT term FROM tblresult WHERE StudentId='$termid' and term = '$admint' and year = '$admins'") or die();
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
                                        <div class="panel-body p-20">
                                            <table class="table table-hover table-bordered" style="text-align: center;">
                                                <div style="padding: 10px;text-align: center;background:lightgrey;text-transform: uppercase;clear: both;"
                                                    class="print_p">
                                                    <h3>Academic Performance</h3>
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
                                             $query ="select t.StudentName,t.RollId,t.ClassId,t.term,t.year,t.marks,t.tmarks,SubjectId,tblsubjects.SubjectName from
                                             (select sts.StudentName,sts.RollId,sts.ClassId,tr.term,tr.year,tr.marks,tr.tmarks,SubjectId from tblstudents as sts join  tblresult as tr on tr.StudentId=sts.StudentId) as t join 
                                             tblsubjects on tblsubjects.id=t.SubjectId where t.RollId=:rollid and t.ClassId=:classid and t.term = :term and t.year = :year ";
                                            //  and t.term = :term and t.year = :year 
                                            // $bettersql = "";
                                            $query= $dbh -> prepare($query);
                                            $query->bindParam(':rollid',$rollid,PDO::PARAM_STR);
                                            $query->bindParam(':classid',$classid,PDO::PARAM_STR);
                                            $query->bindParam(':term',$admint,PDO::PARAM_STR); //I stoped here
                                            $query->bindParam(':year',$admins,PDO::PARAM_STR);
                                            $query-> execute();  
                                            $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($countrow=$query->rowCount()>0)
                                            { 
                                            foreach($results as $result){
                                            ?>
                                                    <?php
                                                    if($result->marks+$result->tmarks > 1){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($result->SubjectName);?></td>
                                                        <td><?php echo htmlentities($result->tmarks < 1 ? "--" : $result->tmarks);?>
                                                        </td>
                                                        <td><?php echo htmlentities($result->marks < 1 ? "--" : $result->marks);?>
                                                        </td>
                                                        <td><?php echo htmlentities($totalmarks=$result->marks+$result->tmarks < 1 ? "--" : $result->marks+$result->tmarks );?>
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
                                                         echo $result->marks+$result->tmarks < 1 ? "--" : "F9";
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
                                                         echo $result->marks+$result->tmarks < 1 ? "--" : "Fail";
                                                        } 

                                                        ?></td>
                                                    </tr>

                                                    <?php
                                                    $totlcount+=$totalmarks;
                                                    $cnt++;
                                                       }
                                                }
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
                                                        <strong>Notice!</strong> Your result not declare yet
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
                                        <a href="manage-results.php">Back to Result</a>
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
    var name = $("#studentnameid").text();
    var data = name.replace(/\s{2,}/g, ' ');
    var className = $("#classname").text();
    var classsub = className.replace(/\s{2,}/g, ' ');
    document.title = data + " :: " + classsub;
});
</script>

<!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

</body>

</html>
