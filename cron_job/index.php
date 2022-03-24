<?php
    include "../includes/config.php";
    $sql = "ANALYZE TABLE tblresult";
    $query = $dbh->query($sql);
    $tblstudents = function(){
        global $dbh;
        $sql = "ANALYZE TABLE tblstudents";
        $query = $dbh->query($sql);
        // mail("biodunhi@gmail.com", "Cron Job", "Hello Adeleye Ayodeji, this is cron job");
        return "Database optimised";
    };
     $tblclasses = function(){
        global $dbh, $tblstudents;
        $sql = "ANALYZE TABLE tblclasses";
        $query = $dbh->query($sql);
        $tblstudents();
        return "Database optimised";
    };
     $tbldepartments = function(){
        global $dbh, $tblclasses;
        $sql = "ANALYZE TABLE tbldepartments";
        $query = $dbh->query($sql);
        $tblclasses();
        return "Database optimised";
    };
     $tblsubjectcombination = function(){
        global $dbh, $tbldepartments;
        $sql = "ANALYZE TABLE tblsubjectcombination";
        $query = $dbh->query($sql);
        $tbldepartments();
        return "Database optimised";
    };
     $tblsubjects = function(){
        global $dbh, $tblsubjectcombination;
        $sql = "ANALYZE TABLE tblsubjects";
        $query = $dbh->query($sql);
        $tblsubjectcombination();
        return "Database optimised";
    };
     
    echo $query ? $tblsubjects() : "Error Optimising";
    // mail("biodunhi@gmail.com", "Cron Job", "Hello Adeleye Ayodeji, this is cron job");
?>