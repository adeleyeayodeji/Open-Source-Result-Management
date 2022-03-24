<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{

// for Deleting Subject
if(isset($_GET['del']))
{
$del=intval($_GET['del']);
$sql="DELETE FROM tblpin WHERE id=:del ";
$query = $dbh->prepare($sql);
$query->bindParam(':del',$del,PDO::PARAM_STR);
$query->execute();
$msg="Pin Deleted successfully";
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
                        <h2 class="title">Manage Pin</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                            <li> Pin</li>
                            <li class="active">Manage Pin</li>
                        </ul>
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

            <section class="section">
                <div class="container-fluid">



                    <div class="row">
                        <div class="col-md-12" style="overflow: scroll;">

                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h5>Manage Pin</h5>
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
                                    <a href="javascript:;" id="generate" class="btn btn-primary"
                                        style="background: black;color: white;">
                                        Add new Pin
                                    </a> <a href="javascript:void();" class="btn btn-primary"
                                        style="background: black;color: white;float: right;"
                                        onclick="printDiv('printableArea')">
                                        <i class="fa fa-print"></i> Print Pin
                                    </a><br><br>
                                    <div id="printableArea">
                                        <table id="example" class="display table table-striped table-bordered"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Student</th>
                                                    <th>PIN</th>
                                                    <th>Remaining</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Student</th>
                                                    <th>PIN</th>
                                                    <th>Remaining</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $sql = "SELECT * from tblpin";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt);?></td>

                                                    <td>
                                                        <?php 
                                                               $tqid = $result->student_id;
                                                               $sql2 = "SELECT * from tblstudents WHERE StudentId = '$tqid' ";
                                                                $tq = mysqli_query($con,$sql2);
                                                                $tr = mysqli_fetch_assoc($tq);
                                                                
                                                                //Result here   
                                                                echo $tr["StudentName"] != null ? $tr["StudentName"] : "<span class='badge badge-success'>New Pin</span>";
                                                                ?>
                                                    </td>
                                                    <td><?php echo htmlentities($result->keytext);?></td>
                                                    <td>
                                                        <?php echo htmlentities($result->rem);?>
                                                    </td>
                                                    <td>
                                                        <a href="manage-pin.php?del=<?php echo htmlentities($result->id);?>"
                                                            onclick="confirm('do you really want to delete this student');"><i
                                                                class="fa fa-remove" title="Delete Student"
                                                                style="color: red;"></i> </a>
                                                    </td>
                                                </tr>
                                                <?php $cnt=$cnt+1;}} ?>


                                            </tbody>
                                        </table>
                                        <script>
                                        $(function() {
                                            $('#example').DataTable({
                                                "order": [
                                                    [1, "asc"]
                                                ]
                                            });
                                        });
                                        </script>
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
<script type="text/javascript">
function printDiv(printableArea) {
    var printContents = document.getElementById(printableArea).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
</script>
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
    $("#generate").click(function(e) {
        e.preventDefault();
        $.get("pin.php", {},
            (data, textStatus, jqXHR) => {
                window.location.reload();
            },
        );
    });

    $('#example2').DataTable({
        "scrollY": "300px",
        "scrollCollapse": true,
        "paging": false
    });

    $('#example3').DataTable();
});
</script>
</body>

</html>
<?php } ?>