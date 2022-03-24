<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="<?php echo BASE_URL; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        $stmt = $dbh->query("SELECT * FROM settings");
        $rowdesc = $stmt->fetch(PDO::FETCH_OBJ);
        ?>
    <title><?php echo htmlentities($rowdesc->title); ?></title>
    <meta name="description" content="<?php echo htmlentities($rowdesc->description); ?>">
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
    <script <?php echo !$_SESSION ? "async" : "" ?> src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"
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
    
    #printableArea #example_wrapper .col-sm-12{
        overflow: scroll;
    }
    </style>
                  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-156956107-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-156956107-1');
</script>
</head>

<body class="top-navbar-fixed">
    <div class="main-wrapper">