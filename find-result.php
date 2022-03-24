<?php
session_start();
error_reporting(0);
if(isset($_SESSION["page"])){
    unlink("./install.php");
    unset($_SESSION["page"]);
}
include('includes/config.php');?>
<?php include('includes/header.php');?>
<?php
                            $stmt = $dbh->query("SELECT * FROM settings");
                            $rowfront = $stmt->fetch(PDO::FETCH_OBJ);
                            ?>
<div class="login-bg-color bg-black-300"
    style="background: url('images/background/<?php echo htmlentities($rowfront->siteback); ?>');background-position: center;background-size: cover;">
    <div style="margin: 0px;">
        <center><img src="images/<?php echo htmlentities($rowfront->logo); ?>" height="100px" style="margin-top: 50px;">
        </center>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel login-box" style="background: #ffffff94;margin-top: 10px;">
                <div class="panel-heading">
                    <div class="panel-title text-center">
                        <h4><?php echo htmlentities($rowfront->title); ?></h4>
                    </div>
                </div>
                <div class="panel-body p-20">
                    <form action="result.php" method="post">
                        <div class="form-group">
                            <label for="studentid">Enter PIN:</label>
                            <input type="text" class="form-control" placeholder="Enter PIN" id="pin" autocomplete="off"
                                name="pin" required="">
                        </div>
                        <div class="form-group">
                            <label for="studentid">Enter Student ID:</label>
                            <input type="number" class="form-control" id="studentid" placeholder="Enter Student ID"
                                autocomplete="off" name="studentid" required>
                        </div>
                        <div id="alert" style="display:none;">

                        </div>
                        <div class="form-group">
                            <label for="studentid">Year of Exam</label>
                            <select class="form-control" name="examyear">
                                <option value="2020/2021">2020/2021</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="studentid">Select Term of Exam:</label>
                            <select name="term" class="form-control stid" required="required">
                                <option value="First Term">First Term</option>
                                <option value="Second Term">Second Term</option>
                                <option value="Third Term">Third Term</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="default" class="control-label">Select Student Class:</label>
                            <select name="class" class="form-control" id="default" required="required">
                                <option value="">Select Class</option>
                                <?php $sql = "SELECT * from tblclasses";
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

                                <button type="submit" id="submit" class="btn btn-success btn-labeled pull-right"
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

//Check for PINS
var typingTimer; //timer identifier
var doneTypingInterval = 1000; //time in ms, 5 second for example
var $input = $('#pin');
var $studentid = $('#studentid');

//on keyup, start the countdown
$studentid.add($input).on('keyup', function() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping, doneTypingInterval);
});

//on keydown, clear the countdown 
$studentid.add($input).on('keydown', function() {
    clearTimeout(typingTimer);
});

//user is "finished typing," do something
function doneTyping() {
    $.ajax({
        type: "POST",
        url: "api/pinchecker.php",
        data: {
            studentid: $studentid.val(),
            pin: $input.val()
        },
        beforeSend: () => {
            $("#alert").html(`
                <div class="alert alert-warning alert-dismissible">
                <strong>Checking. . .</strong>                
                </div>
            `).fadeIn();
        },
        success: function(response) {
            if (response.info == "WRONG PIN") {
                $("#alert").html(`
                <div class="alert alert-danger">
                <strong>${response.info}</strong>                
                </div>
            `).fadeIn();
                $("#submit").prop("disabled", true);
            } else if (response.info == "PIN ALREADY BEEN USED") {
                $("#alert").html(`
                <div class="alert alert-danger">
                <strong>${response.info}</strong>                
                </div>
            `).fadeIn();
                $("#submit").prop("disabled", true);
            } else if (response.info == "PIN EXHAUSTED") {
                $("#alert").html(`
                <div class="alert alert-danger">
                <strong>${response.info}</strong>                
                </div>
            `).fadeIn();
                $("#submit").prop("disabled", true);
            } else if (response.info == "STUDENT ID NOT FOUND") {
                $("#alert").html(`
                <div class="alert alert-danger">
                <strong>${response.info}</strong>                
                </div>
            `).fadeIn();
                $("#submit").prop("disabled", true);
            } else if (response.info == "PIN VALID") {
                $("#alert").html(`
                <div class="alert alert-success">
                <strong>${response.info}</strong>                
                </div>
            `).fadeIn();
                //Enable button
                $("#submit").prop("disabled", false);
            }
            console.log(response);
        }
    });
}

$("#submit").prop("disabled", true);
</script>
<!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
</body>

</html>