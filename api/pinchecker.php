<?php
include('../includes/config.php');
//Fix cross Origin
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
//Fix cross Origin
header("Content-Type: application/json");
    
function encrypt($string) {
    $key = strlen($string);
    $result = '';
    for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = $char * $keychar;
        $result.=$char;
    }
    return sha1($result);
}

//If PIN is Set
if (isset($_POST["pin"])) {
    $pin = sha1($_POST['pin']);
    $sid = $_POST['studentid'];
    $que = $dbh->prepare("SELECT * FROM tblpin WHERE pin = '$pin'");
    $que->execute();
    $res = $que->fetchObject();
    //Error Checking
    if($que->rowCount() == 1){ //If found 
        $sid = $_POST['studentid'];
        $que2 = $dbh->prepare("SELECT * FROM tblstudents WHERE RollId = '$sid'");
        $que2->execute();
        //If cant is greater than one
        if ($que2->rowCount() == 1) {
            //Run more conditions
            if($res->student_id == NULL || $res->student_id == $sid){
                //If PIN Have not been used
                echo json_encode(array('info' => 'PIN VALID'));
            }elseif($res->student_id != $sid){
                //If userid is not valid
                echo json_encode(array('info' => 'PIN ALREADY BEEN USED'));
            }elseif($res->rem < 1){
                //If remaining is less than one
                echo json_encode(array('info' => 'PIN EXHAUSTED')); 
            }
        } else {// If student id not found
            echo json_encode(array('info' => 'STUDENT ID NOT FOUND'));
        }
        
    }else{// If PIN not found
        echo json_encode(array('info' => 'WRONG PIN'));
    }
}