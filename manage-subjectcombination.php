
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
 // for activate Subject   	
if(isset($_GET['acid']))
{
$acid=intval($_GET['acid']);
$status=1;
$sql="update tblsubjectcombination set status=:status where id=:acid ";
$query = $dbh->prepare($sql);
$query->bindParam(':acid',$acid,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$msg="Subject Activate successfully";
}

 // for Deactivate Subject
if(isset($_GET['did']))
{
$did=intval($_GET['did']);
$status=0;
$sql="update tblsubjectcombination set status=:status where id=:did ";
$query = $dbh->prepare($sql);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$msg="Subject Deactivate successfully";
}

// for Deleting Subject
if(isset($_GET['del']))
{
$del=intval($_GET['del']);
$sql="DELETE FROM tblsubjectcombination WHERE ClassId = :del ";
$query = $dbh->prepare($sql);
$query->bindParam(':del',$del,PDO::PARAM_STR);
$query->execute();
$msg="Subject Deleted successfully";
}

?>
<?php include('includes/header.php');?> 
          <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}

.subjects {
    background: black;
    color: white;
    width: fit-content;
    padding: 2px;
    border-radius: 4px;
    font-family: calibri;
    box-shadow: 1px 0px 6px 0px black;
    margin: 6px;
}

.post-tag{
    display: inline-block;
    padding: .4em .5em;
    margin: 2px 2px 2px 0;
    font-size: 11px;
    line-height: 1;
    white-space: nowrap;
    text-decoration: none;
    text-align: center;
    border-width: 1px;
    border-style: solid;
    border-radius: 3px;
    }
    .post-tag:hover{
    background: #0000009e;
    color: white !important;
    }
        </style>
    <script>
       
           $(document).ready(function () {
            $(".post-tag").hover(function () {
                    const uniqueid = $(this).attr("id");
                    $("#"+ uniqueid + " .tagme").css('display', 'inline-block');
                    $("#"+ uniqueid + " .tagme").attr('id', uniqueid);
                    // console.log("On tag "+$(this).attr("id"));
                    
                }, function () {
                    const uniqueid = $(this).attr("id");
                    $("#"+ uniqueid +" .tagme").css('display', 'none');
                    // console.log("Leaving "+$(this).attr("id"));
                }
            );

            $(".tagme").click(function (e) { 
                e.preventDefault();
                const uniqueid = $(this).attr("id");
                const combination_id = $(this).data("scid");
                // console.log(combination_id);
                
                // alert("Deleted "+uniqueid);
                $.ajax({
                    type: "POST",
                    url: "api/delete_combination.php",
                    data: {
                        'id' : combination_id
                    },
                    beforeSend: function(){
                        console.log("Connecting");
                        
                    },  
                    success: function (response) {
                        if (response == "Subject Deleted successfully") {
                            $("#"+uniqueid).fadeOut();
                        }
                        // console.log(response);
                        
                    }
                });
                
            });

           });
       
    </script>
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
                                    <h2 class="title">Manage Subjects Combination</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Subjects</li>
            							<li class="active">Manage Subjects Combination</li>
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
                                                    <h5>View Subjects Combination Info</h5>
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
                                                  <a href="add-subjectcombination.php" class="btn btn-primary" style="background: black;color: white;">
                                                    Create new subject Combination
                                            </a><br><br>
                                                <table id="example" class="display table table-striped table-bordered text-center" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Department</th>
                                                            <th>Subject </th>
                                                            <!-- <th>Status</th> -->
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                          <th>#</th>
                                                            <th>Department</th>
                                                            <th>Subject </th>
                                                            <!-- <th>Status</th> -->
                                                            <th>Action</th>
                                                            
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
<?php $sql = "SELECT tbldepartments.id,tbldepartments.DepartmentName,tblsubjects.SubjectName,tblsubjectcombination.id as scid,tblsubjectcombination.status from tblsubjectcombination join tbldepartments on tbldepartments.id=tblsubjectcombination.ClassId  join tblsubjects on tblsubjects.id=tblsubjectcombination.SubjectId GROUP BY tbldepartments.DepartmentName ORDER BY tblsubjectcombination.id DESC";
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
                                                            <td><?php echo htmlentities($result->DepartmentName);?></td>
                                                            <td style="width: 50%;text-align:left;">
                                                            <div style="width:100%;height:auto;">
                                                                <?php
                                                                $dprtid = $result->id;
                                                                $sql = "SELECT tbldepartments.id,tbldepartments.DepartmentName,tblsubjects.SubjectName,tblsubjectcombination.id as scid,tblsubjectcombination.status from tblsubjectcombination join tbldepartments on tbldepartments.id=tblsubjectcombination.ClassId  join tblsubjects on tblsubjects.id=tblsubjectcombination.SubjectId WHERE tbldepartments.id = '$dprtid' ORDER BY tblsubjectcombination.id DESC";
                                                                $query = $dbh->query($sql);
                                                                $result = $query->fetchAll(PDO::FETCH_OBJ);
                                                                foreach ($result as $result) {
                                                                    ?>
                                                                    <a href="javascript:void(0)" class="post-tag" title="" id="tagme<?php echo(rand(1,1000000)); ?>" rel="tag"><?php echo $result->SubjectName; ?> <i class="fa fa-times tagme" style="display: none;" data-scid="<?php echo $result->scid; ?>"></i></a>  
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            </td>
                                                             <!-- <td><?php $stts=$result->status;
if($stts=='0')
{
	echo htmlentities('Inactive');
}
else
{
	echo htmlentities('Active');
}
                                                             ?></td> -->
                                                            
<td>
<!-- <?php if($stts=='0')
{ ?>
<a title="Acticvate Record" href="manage-subjectcombination.php?acid=<?php echo htmlentities($result->scid);?>" onclick="confirm('do you really want to ativate this subject');"><i class="fa fa-check"</i> Acticvate</a><?php } else {?>

<a title="Deactivate Record" href="manage-subjectcombination.php?did=<?php echo htmlentities($result->scid);?>" onclick="confirm('do you really want to deativate this subject');"><i class="fa fa-times"></i> Deactivate</a>
<?php }?>
| -->
<a title="Delete Combination" href="manage-subjectcombination.php?del=<?php echo htmlentities($result->id);?>" onclick="confirm('do you really want to delete this subject');"><i class="fa fa-remove" style="color: red;"></i> Delete</a>
</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
                                                       
                                                    
                                                    </tbody>
                                                </table>

                                         
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
        <?php include 'includes/credit.php'; ?>
        
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $('#example').DataTable({
        "order": [
            [1, "asc"]
        ]
    });

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });
        </script>
    </body>
</html>
<?php } ?>

