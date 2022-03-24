<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
if(isset($_POST['submit']))
{
    $marks=array();
$class = (isset($_SESSION['teacher'])) ? $_POST['classidteacher'] : $_POST['class'] ;
$studentid=$_POST['studentid']; 
$mark=$_POST['marks'];
$tmark=$_POST['tmarks'];
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
$msg="Result info added successfully";
}
else 
{
$error="Something went wrong. Please try again";
}
}
}
?>
<?php include('includes/header.php');?> 
<script>
function getStudent(val) {
    $.ajax({
    type: "POST",
    url: "get_student.php",
    data:'classid='+val,
    success: function(data){
        $("#studentid").html(data);
        $("#studentid").selectator(); //Disable for admin
        console.log("Loaded");
        
    }
    });
}

    </script>
<script>

function getresult(val,clid) 
{   
var clid = <?php echo (isset($_SESSION['teacher'])) ? '$("#classidteacher").val();' : '$(".clid").val();' ; ?>
var val=$(".stid").val();;
var abh=clid+'$'+val;
//alert(abh);
    $.ajax({
        type: "POST",
        url: "get_student.php",
        data:'studclass='+abh,
        beforeSend: function(){
            // console.log("Checking user previous reg");
        },  
        success: function(data){
            // console.log("User checked " + abh);
            if (data.trim() == "added") {
                $('#submit').prop('disabled',true);
                $("#studentid").notify(
                "Result already added", 
                { position:"top" }
                );
            }else{
                $("#studentid").notify(
                "You can add result", 
                "info" ,
                { position:"top" }
                );
                $('#submit').prop('disabled',false);
            }
            //Getting result for subjects
            $.ajax({
                type: "POST",
                url: "get_student.php",
                data:'classid1='+val,
                beforeSend: function () {
                    console.log("Getting subjects on "+val );
                    $("#subject").html(`<img src="images/loader.gif" alt="" style="height: 40px;" id="loaderimg">`);
                },
                success: function(data){
                    
                        $("#subjectme").html(data);
                        console.log("Subject loaded");
                    
                    
                }
                });

            //Getting Department for student
                 $.ajax({
                type: "POST",
                url: "get_student.php",
                data:'dpartment='+val,
                beforeSend: function(){
                    // console.log("Getting departments on "+val);
                    
                },
                success: function(data){
                    // console.log("Departments loaded");
                    $("#Department").html(data);
                    
                }
                });        
        }
        });

    
}
</script>

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                   <?php include('includes/leftbar.php');?>  
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Declare Result <?php 
                                    if (isset($_SESSION["teacher"])) {
                                        $tiid = $_SESSION["teachercid"];
                                        $qrq = mysqli_query($con, "SELECT * FROM tblclasses WHERE id = '$tiid' ") or die();
                                        $qrqr = mysqli_fetch_assoc($qrq);
                                        echo "for ".$qrqr["ClassName"];
                                    }
                                     ?></h2>
                                    <?php
                                        echo "<p style='margin:0px;'>".$adminresult->term."</p>"; 
                                        echo "<small>".$adminresult->session."</small>";
                                        ?>
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">Student Result</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-12">
                                                
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12">
                                                          <div class="panel">
                                           
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                                <form class="form-horizontal" method="post">

 <div class="form-group" <?php if (isset($_SESSION['teacher'])) { echo "style='display:none !important;'"; } ?>>
<label for="default" class="col-sm-2 control-label">Class</label>
 <div class="col-sm-10">
 <select name="class" class="form-control clid" id="classid" onChange="getStudent(this.value);" <?php if (!isset($_SESSION['teacher'])) {
     ?>
     
     <?php
 } ?>>
<option value="">Select Class</option>
<?php
 if (isset($_SESSION["teacher"])) {
    $cidd = $_SESSION['teachercid'];
    $sql = "SELECT * from tblclasses WHERE id = '$cidd'"; 
 }else{
    $sql = "SELECT * from tblclasses";
 }
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?></option>
<?php } ?>
</select>
<!-- for teacher only -->
<input type="hidden" name="classidteacher" id="classidteacher" value="<?php echo htmlentities($results[0]->id); ?>">
 <!-- For teacher only -->
 <?php
} ?>
 
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">Student Name</label>
                                                        <div class="col-sm-10">
                                                    <select name="studentid" class="form-control stid studentname" id="studentid"  onChange="getresult(this.value);">
                                                        
                                                    </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">Term of Exam</label>
                                                        <div class="col-sm-10">
                                                            <?php
                                                                 if (isset($_SESSION["teacher"])) {
                                                                   ?>
                                                                    <input name="term" class="form-control stid" value="<?php echo $adminresult->term; ?>" readonly required>
                                                                   <?php
                                                                 }else{
                                                                    ?>
                                                                    <select class="form-control" name="term" required>
                                                                    <option value="<?php echo $adminresult->term; ?>">Current - <?php echo $adminresult->term; ?></option>
                                                                    <option value="First Term">First Term</option>
                                                                    <option value="Second Term">Second Term</option>
                                                                        <option value="Third Term">Third Term</option>
                                                                    </select>
                                                                    <?php
                                                                 }
                                                            ?>
                                                        </div>
                                                    </div>

                                                       <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">Year of Exam</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" name="year" class="form-control" placeholder="2019, 2020" value="<?php echo $adminresult->session; ?>" readonly="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">No. of Days School Opened</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" name="daysschool" class="form-control" placeholder="E.g 118">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">No. of Days Present</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" name="dayspresent" class="form-control" placeholder="E.g 114">
                                                        </div>
                                                    </div>

                                                      <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">No. of Days Absence</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" name="daysabsence" class="form-control" placeholder="E.g 4">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">Term Begins</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" name="termbegin" class="form-control" placeholder="E.g 06/01/14">
                                                        </div>
                                                    </div>

                                                     <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">Term Ends</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" name="termends" class="form-control" placeholder="E.g 11/04/14">
                                                        </div>
                                                    </div>
                                                    

                                                     <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">Next Term Begins</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" name="termnext" class="form-control" placeholder="E.g 05/05/14">
                                                        </div>
                                                    </div>

                                                     <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">Department</label>
                                                        <div class="col-sm-10">
                                                    <select name="Department" class="form-control stid" id="Department"  readonly>
                                                       

                                                    </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                      
                                                        <div class="col-sm-10">
                                                    <div  id="reslt">
                                                    </div>
                                                        </div>
                                                    </div>
                                                    
<div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label">Subjects</label>
                                                        <div class="col-sm-10" id="subjectme">
                                                            <img src="images/loader.gif" alt="" style="height: 40px;" id="loaderimg">
                                                        </div>
                                                    </div>


                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Save Result</button>

                                                            <a href="manage-results.php" class="btn btn-primary" style="float: right;background: black;color: white;">
                                                    Manage Results
                                            </a>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-12">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <?php include 'includes/credit.php'; ?>
        
        <script src="js/notify.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });

            <?php
               if (isset($_SESSION['teacher'])) {
                   ?>
                        console.log("Teacher class id valid"+ $("#classidteacher").val());
                        const loaddata = $("#classidteacher").val();
                        $.ajax({
                        type: "POST",
                        url: "get_student.php",
                        data:'classid='+loaddata,
                        success: function(data){
                            $("#studentid").html(data);
                            $("#studentid").selectator();
                            console.log("Loaded");
                            
                        }
                        });
                   <?php
               }

            ?>
        </script>
            <script src="js/fm.selectator.jquery.js"></script>
    </body>
</html>
<?PHP } ?>
