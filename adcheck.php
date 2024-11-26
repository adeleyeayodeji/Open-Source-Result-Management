<?php
session_start();
error_reporting(0);
include('includes/config.php');?>
<!DOCTYPE html>
<?php include('includes/header.php');?>
<?php
                            $stmt = $dbh->query("SELECT * FROM settings");
                            $rowfrontt = $stmt->fetch(PDO::FETCH_OBJ);
                            ?>
<div class="login-bg-color bg-black-300"
    style="background: url('images/<?php echo htmlentities($rowfrontt->siteback); ?>');background-position: center;background-size: cover;">
    <div style="margin: 0px;">
        <center><img src="images/<?php echo htmlentities($rowfrontt->logo); ?>" height="100px"
                style="margin-top: 50px;"></center>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel login-box" style="background: #ffffff94;margin-top: 10px;">
                <div class="panel-heading">
                    <div class="panel-title text-center">
                        <h4><?php echo htmlentities($rowfrontt->title); ?></h4>
                    </div>
                </div>
                <div class="panel-body p-20">



                    <form action="viewresult.php" method="post">
                        <div class="form-group">
                            <label for="studentid">Student Id:</label>
                            <?php

                                        $studentid = $_GET["studentid"];
                                        $stmt = $dbh->query("SELECT * FROM tblstudents WHERE StudentId = '$studentid' ");
                                        $row = $stmt->fetch(PDO::FETCH_OBJ);
                                        ?>
                            <input type="text" class="form-control" id="studentid"
                                value="<?php echo htmlentities($row->RollId); ?>" autocomplete="off" name="studentid"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="default" class="control-label">Student Class:</label>
                            <select name="class" class="form-control" id="default" required="required" readonly>
                                <?php 
$newclass = $row->ClassId;
$sql = "SELECT * from tblclasses WHERE id = '$newclass' ";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
                                <option value="<?php echo htmlentities($result->id); ?>">
                                    <?php echo htmlentities($result->ClassName); ?></option>
                                <?php }} ?>
                            </select>
                        </div>


                        <div class="form-group mt-20">
                            <div class="">

                                <button type="submit" class="btn btn-success btn-labeled pull-right"
                                    style="background: #13382c;border-color: black;">Check Result<span
                                        class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                    </form>

                    <hr>

                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-md-6 col-md-offset-3 -->
    </div>
    <!-- /.row -->
</div>
<!-- /. -->

</div>
<!-- /.main-wrapper -->
<?php include 'includes/credit.php'; ?>
<!-- ========== COMMON JS FILES ========== -->

<script src="js/jquery-ui/jquery-ui.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/pace/pace.min.js"></script>
<script src="js/lobipanel/lobipanel.min.js"></script>
<script src="js/iscroll/iscroll.js"></script>

<!-- ========== PAGE JS FILES ========== -->
<script src="js/icheck/icheck.min.js"></script>

<!-- ========== THEME JS ========== -->
<script src="js/main.js"></script>
<script>
$(function() {
    $('input.flat-blue-style').iCheck({
        checkboxClass: 'icheckbox_flat-blue'
    });
});

$("form").submit();
</script>

<!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
</body>

</html>
