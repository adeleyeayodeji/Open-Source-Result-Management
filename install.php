<?php
session_start();
if (isset($_POST["install"])) {
    if(isset($_SESSION["page"]) && $_SESSION["page"] == 2){
        include './includes/config.php';
        $sql = "INSERT INTO admin(fullname, email, username, password, role) VALUES(?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$_POST["username"], $_POST["email"], $_POST["username"], md5($_POST["password"]), 'admin']);
        $success = "Admin added successfully, Redirecting to homepage...";
        ?>
<script>
setTimeout(() => {
    window.location.href = "<?php echo BASE_URL ?>";
}, 3000);
</script>
<?php
    }else{
        $filename = './includes/connection.php';
        $utf = "'utf8'";
        $content = '
            <?php
                // DB credentials.
                define("DB_HOST","'.$_POST['host'].'");
                define("DB_USER","'.$_POST['databaseuser'].'");
                define("DB_PASS","'.$_POST['databasepassword'].'");
                define("DB_NAME","'.$_POST['database'].'");
                // Establish database connection.
                try
                {
                $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '.$utf.'"));
                }
                catch (PDOException $e)
                {
                exit("Error: " . $e->getMessage());
                } 
    
                                                    
                if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on")   
                    $url = "https://";   
                else  
                    $url = "http://";   
                // Append the host(domain name, ip) to the URL.   
                $url.= $_SERVER["HTTP_HOST"];   
                
                // Append the requested resource location to the URL   
                $url.= $_SERVER["REQUEST_URI"];    
    
                define("BASE_URL", "'.$_POST['siteurl'].'");
    
        ';
        if(file_put_contents($filename, $content)){
            // Name of the file
            $filename = 'biggiresult.sql';
            // MySQL host
            $mysql_host = $_POST['host'];
            // MySQL username
            $mysql_username = $_POST['databaseuser'];
            // MySQL password
            $mysql_password = $_POST['databasepassword'];
            // Database name
            $mysql_database = $_POST['database'];
    
            // Connect to MySQL server
            $co = mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysqli_error($co));
            // Select database
            mysqli_select_db($co, $mysql_database) or die('Error selecting MySQL database: ' . mysqli_error($co));
    
            // Temporary variable, used to store current query
            $templine = '';
            // Read in entire file
            $lines = file($filename);
            // Loop through each line
            foreach ($lines as $line)
            {
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;
    
            // Add this line to the current segment
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';')
            {
                // Perform the query
                mysqli_query($co,$templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($co) . '<br /><br />');
                // Reset temp variable to empty
                $templine = '';
            }
            }
            $success = "Tables imported successfully";
            $_SESSION["page"] = 2;
        }else{
            $error = "Error in connection";
        };
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Install Software</title>
        <meta name="description" content="Install Software">
        <link rel="stylesheet" href="css/bootstrap.min.css" media="all">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="all">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="all">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="all">
        <link rel="stylesheet" href="css/prism/prism.css" media="all">
        <link rel="stylesheet" href="css/select2/select2.min.css" media="all">
        <link rel="stylesheet" href="css/main.css" media="all">
        <link rel="stylesheet" href="css/style2.css" media="all">
        <link rel="stylesheet" href="css/style.css" media="all">
        <link rel="stylesheet" src="css/print.css" type="text/css" media="print" />
        <script <?php echo !$_SESSION ? "async" : "" ?> src="js/modernizr/modernizr.min.js"></script>
        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
        <!-- <script src="js/jquery/jquery-2.2.4.min.js"></script> -->
        <script <?php echo !$_SESSION ? "async" : "" ?> src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script <?php echo !$_SESSION ? "async" : "" ?> src="http://code.jquery.com/jquery-migrate-1.1.0.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"
            integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg=="
            crossorigin="anonymous" />
        <script <?php echo !$_SESSION ? "async" : "" ?>
            src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"
            integrity="sha512-j7/1CJweOskkQiS5RD9W8zhEG9D9vpgByNGxPIqkO5KrXrwyDAroM9aQ9w8J7oRqwxGyz429hPVk/zR6IOMtSA=="
            crossorigin="anonymous"></script>
        <link href="css/fm.selectator.jquery.css" rel="stylesheet" type="text/css">
        <style type="text/css">
        .printing {
            display: none;
        }

        @media print {
            .printindis {
                display: none;
            }
        }

        @media print {
            .printing {
                display: block;
            }
        }

        #printableArea #example_wrapper .col-sm-12 {
            overflow: scroll;
        }
        </style>
    </head>

    <body class="top-navbar-fixed">
        <div class="main-wrapper">
            <div class="">
                <div class="row">
                    <section class="section">
                        <div class="row mt-40">
                            <div class="col-md-5 col-md-offset-4 ">

                                <div class="row mt-30 ">
                                    <div class="col-md-11">
                                        <div class="panel p-5">
                                            <div class="panel-heading">
                                                <h3 style="font-weight: normal;" class="text-center">
                                                    Install Software
                                                </h3>
                                                <hr>
                                            </div>
                                            <div class="panel-body p-20">

                                                <div class="section-title">
                                                    <p class="sub-title" style="text-align: center;"></p>
                                                </div>

                                                <form class="form-horizontal" method="post">

                                                    <?php
                                                    if(isset($success)){
                                                        ?>
                                                    <div class="alert alert-success">
                                                        <strong><?php echo $success ?> <i class="fa fa-mars-double"
                                                                aria-hidden="true"></i></strong>
                                                    </div>
                                                    <?php
                                                    }elseif(isset($error)){
                                                        ?>
                                                    <div class="alert alert-danger">
                                                        <strong><?php echo $error ?></strong>
                                                    </div>
                                                    <?php
                                                    }
                                                    if(isset($_SESSION["page"]) && $_SESSION["page"] == 2){
                                                        ?>
                                                    <div class="form-group">
                                                        <label for="email" class="col-sm-2 control-label">Admin
                                                            email:</label>
                                                        <div class="col-sm-10">
                                                            <input type="email" name="email" class="form-control"
                                                                id="host" placeholder="Admin email" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Username" class="col-sm-2 control-label">Admin User
                                                            Name:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="username" class="form-control"
                                                                id="username" placeholder="Admin username" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password" class="col-sm-2 control-label">Admin
                                                            Password:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="password" class="form-control"
                                                                id="password" placeholder="Admin password" required="">
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }else{
                                                        ?>
                                                    <input type="hidden" name="page" value="1">
                                                    <div class="form-group">
                                                        <label for="host" class="col-sm-2 control-label">Database
                                                            Host:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="host" class="form-control"
                                                                id="host" placeholder="Your host" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="database" class="col-sm-2 control-label">Database
                                                            Name:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="database" class="form-control"
                                                                id="database" placeholder="Your database" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="databaseuser"
                                                            class="col-sm-2 control-label">Database
                                                            Username:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="databaseuser" class="form-control"
                                                                id="databaseuser" placeholder="Your database user name"
                                                                required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="databasepassword"
                                                            class="col-sm-2 control-label">Database
                                                            Password:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="databasepassword"
                                                                class="form-control" id="databasepassword"
                                                                placeholder="Your database password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="siteurl" class="col-sm-2 control-label">Site
                                                            Home:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="siteurl" class="form-control"
                                                                id="siteurl"
                                                                placeholder="Site URL:: https://result.biggidroid.com/"
                                                                required="">
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>

                                                    <div class="form-group mt-20">
                                                        <div class="col-sm-offset-2 col-sm-10">

                                                            <button type="submit" name="install"
                                                                class="btn btn-success btn-labeled pull-right">Next<span
                                                                    class="btn-label btn-label-right"><i
                                                                        class="fa fa-check"></i></span></button>
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
        <style>
        .credit {
            position: fixed;
            bottom: 0px;
            width: 100%;
            padding: 20px;
            text-align: center;
            background: white;
        }
        </style>
        <!-- ========== COMMON JS FILES ========== -->

        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
        $(function() {

        });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>

</html>