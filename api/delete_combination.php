<?php
    session_start();
    error_reporting(0);
    include('../includes/config.php');


    // for Deleting Subject
    if(isset($_POST['id']))
    {
    $del=intval($_POST['id']);
    $sql="DELETE FROM tblsubjectcombination WHERE id = :del ";
    $query = $dbh->prepare($sql);
    $query->bindParam(':del',$del,PDO::PARAM_STR);
    $query->execute();
    echo ($query) ? "Subject Deleted successfully" : "Error";
    }
?>