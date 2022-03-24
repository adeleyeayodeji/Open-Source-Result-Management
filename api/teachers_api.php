<?php
    include('../includes/config.php');
    //Fix cross Origin
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
    //Fix cross Origin
    header("Content-Type: application/json");

    //Login teacher
    if (isset($_POST["teacher_login"])) {
        $email = str_replace(" ","", $_POST["email"]);
        $password = md5(str_replace(" ","", $_POST["password"]));
        //Query
        $sql = "SELECT * FROM teacher WHERE email = ? AND password = ?";
        $query = $dbh->prepare($sql);
        $query->execute([$email, $password]);
        $result = $query->fetch(PDO::FETCH_OBJ);
        $count = $query->rowCount();
        if ($count < 1) {
            echo json_encode(array("info" => "Teacher not found", "email" => $email));
        }else{
            echo json_encode(array("info" => "Teacher Found", "response" => $result));
        }
    }
    
        //Registered student
    if (isset($_POST["teacher_dashboard"])) {
        $tcid = $_POST["teacher_dashboard"];
        $sql1 ="SELECT StudentId from tblstudents WHERE ClassId = '$tcid' ";
        $query1 = $dbh -> prepare($sql1);
        $query1->execute();
        $results1=$query1->fetchAll(PDO::FETCH_OBJ);
        $totalstudents1 = $query1->rowCount();

        //Result Declared
        $sql3="SELECT  distinct StudentId from  tblresult WHERE ClassId = '$tcid' ";
        $query3 = $dbh -> prepare($sql3);
        $query3->execute();
        $results3=$query3->fetchAll(PDO::FETCH_OBJ);
        $totalresults2 = $query3->rowCount();

        echo json_encode(array('response' =>"valid", "details" => array('registered' => $totalstudents1, 'declared' => $totalresults2 )));
    }
    
    
    if(isset($_POST["student_data"])){
        $tiid = $_POST["student_data"];
        $sql = "SELECT tblstudents.StudentName,tblstudents.session,tblstudents.logo,tblstudents.RollId,tblstudents.Departments,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId WHERE tblclasses.id = '$tiid' ORDER BY tblstudents.StudentId DESC"; 
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
            echo json_encode(array("response" => "valid", "data" => $results));
        }else{
            echo json_encode(array("response" => "No data"));
        }
    }
    
    if(isset($_POST["result_declared"])){
        $tiid = $_POST["result_declared"];
        
        $sql = "SELECT distinct tblstudents.StudentName,tblstudents.logo,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section,tblresult.Department,tblresult.year,tblresult.term from tblresult join tblstudents on tblstudents.StudentId=tblresult.StudentId  join tblclasses on tblclasses.id=tblresult.ClassId WHERE tblclasses.id = '$tiid' ORDER BY tblresult.id DESC";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
            echo json_encode($results);
        }
    }
?>