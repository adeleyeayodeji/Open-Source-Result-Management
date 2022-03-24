<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
//Get Current session


// for Deleting Subject
if(isset($_GET['del']))
{
$del=intval($_GET['del']);
$sql="DELETE FROM tblresult WHERE StudentId=:del ";
$query = $dbh->prepare($sql);
$query->bindParam(':del',$del,PDO::PARAM_STR);
$query->execute();
$msg="Class Deleted successfully";
}

?>
<?php include('includes/header.php');?>
<style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
}

.succWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
}
</style>

<!-- ========== TOP NAVBAR ========== -->
<?php include('includes/topbar.php');?>
<!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
<div class="content-wrapper">
    <div class="content-container">
        <?php include('includes/leftbar.php');?>

        <div class="main-page">
            <div class="container-fluid">
                <div class="row page-title-div">
                    <div class="col-md-6">
                        <h2 class="title">Manage <?php 
                                    if (isset($_SESSION["teacher"])) {
                                        $tiid = $_SESSION["teachercid"];
                                        $qrq = mysqli_query($con, "SELECT * FROM tblclasses WHERE id = '$tiid' ") or die();
                                        $qrqr = mysqli_fetch_assoc($qrq);
                                        echo $qrqr["ClassName"];
                                    }
                                     ?> Result Declared</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                            <li> Result Declared</li>
                            <li class="active">Manage <?php 
                                    if (isset($_SESSION["teacher"])) {
                                        $tiid = $_SESSION["teachercid"];
                                        $qrq = mysqli_query($con, "SELECT * FROM tblclasses WHERE id = '$tiid' ") or die();
                                        $qrqr = mysqli_fetch_assoc($qrq);
                                        echo $qrqr["ClassName"];
                                    }
                                     ?> Result Declared</li>
                        </ul>
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

            <section class="section">
                <div class="container-fluid">



                    <div class="row">
                        <div class="col-md-12">

                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h5>Manage Result Declared</h5>
                                        <?php
                                        echo "<p style='margin:0px;'>".$adminresult->term."</p>"; 
                                        echo "<small>".$adminresult->session."</small>";
                                        ?>
                                    </div>
                                </div>
                                <?php if($msg){?>
                                <div class="alert alert-success left-icon-alert" role="alert">
                                    <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                </div><?php } 
else if($error){?>
                                <div class="alert alert-danger left-icon-alert" role="alert">
                                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                </div>
                                <?php } ?>
                                <div class="panel-body p-20">
                                    <div class="row" style="margin-bottom: 15px;">
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <a href="add-result.php" class="btn btn-primary"
                                                style="background: black;color: white;">
                                                Add new result
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">

                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <?php
                                                         if (!isset($_SESSION["teacher"])) {
                                                            ?>
                                                    <select id="class_select" class="btn btn-primary"
                                                        style="background: black;color: white;">
                                                        <option value="">Select Class</option>
                                                        <option value="all">All Classes</option>
                                                        <?php
                                                                $classfetchsql = mysqli_query($con, "SELECT * FROM tblclasses ORDER BY id DESC") or die();
                                                                while($classfetch = mysqli_fetch_assoc($classfetchsql)){
                                                                 ?>
                                                        <option value="<?php echo $classfetch['id'] ?>">
                                                            <?php echo $classfetch['ClassName'] ?></option>
                                                        <?php
                                                                }
                                                                ?>
                                                    </select>
                                                    <?php
                                                        }
                                                         ?>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <select id="term_select" class="btn btn-primary"
                                                        style="background: black;color: white;">
                                                        <option value="<?php echo $admint; ?>">Select Term</option>
                                                        <option value="First Term">First Term</option>
                                                        <option value="Second Term">Second Term</option>
                                                        <option value="Third Term">Third Term</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <a href="javascript:;" id="pickclass" class="btn btn-primary"
                                                        style="background: black;color: white;">
                                                        Filter
                                                    </a>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div id="printableArea">
                                        <div id="alldata">

                                            <table id="example" class="display table table-striped table-bordered"
                                                cellspacing="0" width="100%" style="overflow:scroll;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Image</th>
                                                        <th>Student Name</th>
                                                        <th>Edit</th>
                                                        <th>View</th>
                                                        <th>Departments</th>
                                                        <th>Class</th>
                                                        <th>Year of Exam</th>
                                                        <th>Term</th>
                                                        <th>Status</th>
                                                        <th>Admin Status</th>

                                                        <th>Created</th>
                                                        <th>Last Edited</th>

                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Image</th>
                                                        <th>Student Name</th>
                                                        <th>Edit</th>
                                                        <th>View</th>
                                                        <th>Departments</th>
                                                        <th>Class</th>
                                                        <th>Year of Exam</th>
                                                        <th>Term</th>
                                                        <th>Status</th>
                                                        <th>Admin Status</th>

                                                        <th>Created</th>
                                                        <th>Last Edited</th>

                                                        <th>Delete</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php 
$admint = $adminresult->term;
$admins = $adminresult->session;
if (isset($_SESSION["teacher"])) {
    $sql = "SELECT  distinct tblstudents.StudentName,tblstudents.logo,tblstudents.RollId,
    tblstudents.RegDate,tblstudents.StudentId,tblclasses.ClassName,tblclasses.Section,tblresult.Department,
    tblresult.year,tblresult.term,tblresult.Status,tblresult.revision_,tblresult.adminstatus,tblresult.PostingDate,
    tblresult.UpdationDate from tblresult join tblstudents on tblstudents.StudentId=tblresult.StudentId  
    join tblclasses on tblclasses.id=tblresult.ClassId WHERE tblclasses.id = '$tiid' AND tblresult.term = '$admint' AND tblresult.year = '$admins' GROUP BY tblstudents.StudentId ORDER BY tblresult.id DESC";
}else{
    $sql = "SELECT  distinct tblstudents.StudentName,tblstudents.logo,tblstudents.RollId,
    tblstudents.RegDate,tblstudents.StudentId,tblclasses.ClassName,tblclasses.Section,tblresult.Department,
    tblresult.year,tblresult.term,tblresult.Status,tblresult.revision_,tblresult.adminstatus,
    tblresult.PostingDate,tblresult.UpdationDate from tblresult join tblstudents on 
    tblstudents.StudentId=tblresult.StudentId  join tblclasses on
    tblclasses.id=tblresult.ClassId WHERE tblresult.term = '$admint' AND tblresult.year = '$admins' GROUP BY tblstudents.StudentId ORDER BY tblresult.id DESC";
}

$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
$_SESSION["check"] = $results;
if($query->rowCount() > 0)
{

foreach($results as $result)
{
    ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt);?></td>
                                                        <td>
                                                            <a href="images/<?php echo htmlentities($result->logo); ?>"
                                                                data-fancybox="images"
                                                                data-caption="<?php echo htmlentities($result->StudentName);?>">
                                                                <img src="images/loading.gif" class="lazy"
                                                                    data-srcset="images/<?php echo htmlentities($result->logo); ?>"
                                                                    data-src="images/<?php echo htmlentities($result->logo); ?>"
                                                                    style="height: 33px;">
                                                            </a>
                                                        </td>
                                                        <td><?php echo htmlentities($result->StudentName);?></td>
                                                        <td>
                                                            <div style="width: 83px;
    text-align: center;">
                                                                <a
                                                                    href="edit-result.php?stid=<?php echo htmlentities($result->StudentId);?>"><i
                                                                        class="fa fa-edit" title="Edit Record"
                                                                        style="font-size: 20px;"></i> <b
                                                                        class="bg-primary"
                                                                        style="padding: 3px;border-radius: 5px;font-family: calibri;"><small
                                                                            class="text-white">edited
                                                                        </small> <?php echo $result->revision_; ?>
                                                                    </b></a>
                                                            </div>

                                                        </td>
                                                        <td>
                                                            <a
                                                                href="adcheck.php?studentid=<?php echo htmlentities($result->StudentId);?>"><i
                                                                    class="fa fa-eye" title="View Result"
                                                                    style="font-size: 20px;"></i></a>

                                                        </td>
                                                        <td><?php
                                                            $dpid = $result->Department;
                                                             $squery = mysqli_query($con, "SELECT * FROM tbldepartments WHERE id = '$dpid' ");
                                                              $sqresult = mysqli_fetch_assoc($squery);
                                                             echo htmlentities($sqresult['DepartmentName']);

                                                             ?></td>
                                                        <td><?php echo htmlentities($result->ClassName);?></td>
                                                        <td><?php echo htmlentities($result->year);?></td>
                                                        <td><?php echo htmlentities($result->term);?></td>
                                                        <td><?php if($result->Status==1){
echo ($result->adminstatus==1) ? '<i class="fa fa-check-circle text-success" aria-hidden="true"></i> Reviewed' : '<i class="fa fa-refresh text-success" aria-hidden="true"></i> Review';
}
else{
   echo ('<i class="fa fa-refresh text-warning" aria-hidden="true"></i> Pending'); 
}
                                                                ?></td>
                                                        <td><?php 
                                                
                                                    if($result->adminstatus==1){
                                                    echo '<i class="fa fa-check-circle-o text-success" aria-hidden="true"></i> Live';
                                                    }
                                                    else{
                                                    echo ('<i class="fa fa-eye-slash text-warning" aria-hidden="true"></i> Pending'); 
                                                    }   
                                                ?></td>

                                                        <td>
                                                            <?php echo htmlentities($result->PostingDate);?>
                                                        </td>
                                                        <td>
                                                            <?php echo htmlentities($result->UpdationDate);?>
                                                        </td>

                                                        <td>
                                                            <a href="manage-results.php?del=<?php echo htmlentities($result->StudentId);?>"
                                                                onclick="confirm('Do you really want to delete this decleared');"><i
                                                                    class="fa fa-remove" title="Delete Class"
                                                                    style="color: red;font-size: 20px;"></i> </a>
                                                        </td>
                                                    </tr>
                                                    <?php $cnt=$cnt+1;}} ?>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- /.col-md-12 -->
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->


                    </div>
                    <!-- /.col-md-12 -->
                </div>
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-md-6 -->

</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->
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
<script src="js/DataTables/datatables.min.js"></script>

<!-- ========== THEME JS ========== -->
<script src="js/main.js"></script>
<script>
$(function($) {
    $('#example').DataTable({
        "order": [
            [2, "asc"]
        ]
    });

    $('#example2').DataTable({
        "scrollY": "300px",
        "scrollCollapse": true,
        "paging": false
    });

    $('#example3').DataTable();

    $("#pickclass").click((e) => {
        e.preventDefault();
        var data =
            <?php echo !isset($_SESSION["teacher"]) ? '$("#class_select").find(":selected").val()' : $_SESSION["teachercid"]; ?>;
        var term = $("#term_select").find(":selected").val()
        // console.log(data);
        $.ajax({
            method: "POST",
            url: "ajaxstudent.php",
            data: {
                classtype: data,
                term
            },
            beforeSend: () => {
                $("table > tbody").html(`
              <tr>
                <td>
                  Getting results . . . 
                </td>
            </tr>
              `);
            },
            success: (result) => {
                $("#alldata").html(result);
                console.log(result);
            }
        });
    })


});
</script>
</body>

</html>
<?php } ?>