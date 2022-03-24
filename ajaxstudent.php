<?php
session_start();
include('includes/config.php');

// Code for Subjects
if(isset($_POST["classtype"])) 
{
$classtype = $_POST["classtype"];
$term = $_POST["term"];
$admint = $adminresult->term;
$admins = $adminresult->session;
?>
      <table id="exampleu" class="display table table-striped table-bordered"
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
if(empty($_POST["classtype"])){
    $sql = "SELECT  distinct tblstudents.StudentName,tblstudents.logo,tblstudents.RollId,
    tblstudents.RegDate,tblstudents.StudentId,tblclasses.ClassName,tblclasses.Section,tblresult.Department,
    tblresult.year,tblresult.term,tblresult.Status,tblresult.revision_,tblresult.adminstatus,
    tblresult.PostingDate,tblresult.UpdationDate from tblresult join tblstudents on 
    tblstudents.StudentId=tblresult.StudentId  join tblclasses on
    tblclasses.id=tblresult.ClassId WHERE tblresult.term = '$admint' AND tblresult.year = '$admins' GROUP BY tblstudents.StudentId ORDER BY tblresult.id DESC";
}else if($_POST["classtype"] == "all"){
    if(isset($admint) && !empty($admint)){
         $sql = "SELECT  distinct tblstudents.StudentName,tblstudents.logo,tblstudents.RollId,
        tblstudents.RegDate,tblstudents.StudentId,tblclasses.ClassName,tblclasses.Section,tblresult.Department,
        tblresult.year,tblresult.term,tblresult.Status,tblresult.revision_,tblresult.adminstatus,
        tblresult.PostingDate,tblresult.UpdationDate from tblresult join tblstudents on 
        tblstudents.StudentId=tblresult.StudentId  join tblclasses on
        tblclasses.id=tblresult.ClassId WHERE tblresult.term = '$admint' AND tblresult.year = '$admins' GROUP BY tblstudents.StudentId ORDER BY tblresult.id DESC";   
    }else{
         $sql = "SELECT  distinct tblstudents.StudentName,tblstudents.logo,tblstudents.RollId,
        tblstudents.RegDate,tblstudents.StudentId,tblclasses.ClassName,tblclasses.Section,tblresult.Department,
        tblresult.year,tblresult.term,tblresult.Status,tblresult.revision_,tblresult.adminstatus,
        tblresult.PostingDate,tblresult.UpdationDate from tblresult join tblstudents on 
        tblstudents.StudentId=tblresult.StudentId  join tblclasses on
        tblclasses.id=tblresult.ClassId WHERE tblresult.term = '$term' AND tblresult.year = '$admins' GROUP BY tblstudents.StudentId ORDER BY tblresult.id DESC";   
    }
    
}else{
     $sql = "SELECT  distinct tblstudents.StudentName,tblstudents.logo,tblstudents.RollId,
    tblstudents.RegDate,tblstudents.StudentId,tblclasses.ClassName,tblclasses.Section,tblresult.Department,
    tblresult.year,tblresult.term,tblresult.Status,tblresult.revision_,tblresult.adminstatus,
    tblresult.PostingDate,tblresult.UpdationDate from tblresult join tblstudents on 
    tblstudents.StudentId=tblresult.StudentId  join tblclasses on
    tblclasses.id=tblresult.ClassId WHERE tblresult.term = '$term' AND tblresult.year = '$admins' AND 
    tblresult.ClassId = $classtype GROUP BY tblstudents.StudentId ORDER BY tblresult.id DESC";   
}

$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
$_SESSION["check"] = $results;
if($query->rowCount() > 0)
{

foreach($results as $result)
{   ?>
        <tr>
            <td><?php echo htmlentities($cnt);?></td>
        <td>
        <a href="images/<?php echo htmlentities($result->logo); ?>" data-fancybox="images" data-caption="<?php echo htmlentities($result->StudentName);?>">
        <img src="images/<?php echo htmlentities($result->logo); ?>" class="lazy"
        data-srcset="images/<?php echo htmlentities($result->logo); ?>"
        data-src="images/<?php echo htmlentities($result->logo); ?>"
        style="height: 33px;" loading="lazy">
        </a>
        </td>
            <td><?php echo htmlentities($result->StudentName);?></td>
             <td>
                 <div style="width: 83px;
        text-align: center;">
                    <a
                    href="edit-result.php?stid=<?php echo htmlentities($result->StudentId);?>&term=<?php echo htmlentities($result->term);?>&session=<?php echo htmlentities($result->year);?>"><i
                        class="fa fa-edit" title="Edit Record"
                        style="font-size: 20px;"></i> <b class="bg-primary"
                        style="padding: 3px;border-radius: 5px;font-family: calibri;"><small
                            class="text-white">edited
                        </small> <?php echo $result->revision_; ?>
                    </b></a> 
                 </div>
                
            </td>
            <td>
                <a
                    href="adcheck_preview.php?studentid=<?php echo htmlentities($result->StudentId);?>&term=<?php echo $result->term; ?>&year=<?php echo $result->year; ?>"><i
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
        <?php 
        $cnt = $cnt+1; 
    }
 }
}


?>

                                        </tbody>
                                    </table>

<script>
$(function($) {
    $('#exampleu').DataTable({
        "order": [
            [2, "asc"]
        ]
    });
});
</script>