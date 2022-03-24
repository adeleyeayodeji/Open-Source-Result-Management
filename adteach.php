<?php
session_start();
include('includes/config.php');
if (isset($_SESSION["alogin"])) {
    header("location: dashboard.php");
}
if (isset($_POST["login"])) {
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $mobileNo = $_POST["mobileNo"];
    $password = md5($_POST["password"]);

    $query = mysqli_query($con, "INSERT INTO teacher (fullName, email, mobileNo, password) VALUES('$fullName', '$email', '$mobileNo', '$password') ") or die();
    if (!$query) {
        $error = "Error Creating Account";
        session_destroy();
    }else{
         echo "Account Createad successfully";
         header('location: teach.php');

    }
}

?>
<?php include('includes/header.php');?> 
               <?php
                            $stmt = $dbh->query("SELECT * FROM settings");
                            $rowlog = $stmt->fetch(PDO::FETCH_OBJ);
                            ?>

            <div class="">
                <div class="row">
                        <section class="section">
                            <div class="row mt-40">
                                <div class="col-md-5 col-md-offset-4 ">

                                    <div class="row mt-30 ">
                                        <div class="col-md-11">
                                            <div class="panel">
                                                <?php if (isset($_POST["login"])) { ?>
                                                <div class="alert alert-danger left-icon-alert" role="alert">
                                                 <strong>Error!</strong> 
                                                   <?php  echo htmlentities($error);  ?>
                                                 </div>
                                                <?php } ?>
                                                <div class="panel-heading">
                                                    <h3 style="font-weight: normal;" class="text-center"><img src="images/<?php echo htmlentities($rowlog->logo); ?>" height="30px"> <?php echo htmlentities($rowlog->title); ?></h3>
                                                    <hr>
                                                    <div class="panel-title text-center">
                                                        <h4>Teacher Registration</h4>
                                                    </div>
                                                </div>
                                                <div class="panel-body p-20">

                                                    <div class="section-title">
                                                        <p class="sub-title" style="text-align: center;"></p>
                                                    </div>

                                                    <form class="form-horizontal" method="post">
                                                    	<div class="form-group">
                                                    		<label for="inputEmail3" class="col-sm-2 control-label">Full Name:</label>
                                                    		<div class="col-sm-10">
                                                    			<input type="text" name="fullName" class="form-control" id="inputEmail3" placeholder="Full Name" required="">
                                                    		</div>
                                                    	</div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">Email:</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="email" class="form-control" id="inputEmail3" placeholder="Email" required="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">Mobile No:</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="mobileNo" class="form-control" id="inputEmail3" placeholder="Mobile No" required="">
                                                            </div>
                                                        </div>

                                                    	<div class="form-group">
                                                    		<label for="inputPassword3" class="col-sm-2 control-label">Password:</label>
                                                    		<div class="col-sm-10">
                                                    			<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" required="">
                                                    		</div>
                                                    	</div>
                                                    
                                                        <div class="form-group mt-20">
                                                    		<div class="col-sm-offset-2 col-sm-10">
                                                           
                                                    			<button type="submit" name="login" class="btn btn-success btn-labeled pull-right">Register<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                                    		</div>
                                                    	</div>
                                                    </form>

                                            

                                                 
                                                </div>
                                            </div>
                                            <!-- /.panel -->
                                        </div>
                                        <!-- /.col-md-11 -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.col-md-12 -->
                            </div>
                            <!-- /.row -->
                        </section>

                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /. -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <?php include 'includes/credit.php'; ?>
        
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function(){

            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
