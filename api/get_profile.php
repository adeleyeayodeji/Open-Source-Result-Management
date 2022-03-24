<?php
    
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
    header('Content-Type: application/json');

    session_start();
    // error_reporting(0);
    include('../includes/config.php');
    $token = "e95b2a34c733917f0b96f8a5dc20f4f3";
    
    
    if(isset($_GET["student_id"])){
        $web_token = $_GET["web_token"];
        if(!empty($_GET["student_id"])){
            if($token == $web_token){
                $stid = $_GET["student_id"];
                $sql = "SELECT * FROM tblstudents WHERE RollId = ?";
                $query = $dbh->prepare($sql);
                $query->execute([$stid]);
                $result = $query->fetch(PDO::FETCH_OBJ);
                if($result){
                    echo json_encode(["code" => 200, "info" => $result]);
                }else{
                    echo json_encode(["code" => 404, "info" => "No user found"]);
                }
            }else{
                    echo json_encode(["code" => 404, "info" => "Invalid token"]);
                }
        }else{
                    echo json_encode(["code" => 404, "info" => "Empty Id given"]);
                }
        
        
    }
    
    if(isset($_GET["all_student"])){
    $web_token = $_GET["web_token"];
    
        if($token == $web_token){
            $sql = "SELECT * FROM tblstudents";
            $query = $dbh->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            if($result){
                echo json_encode(["code" => 200, "info" => $result]);
            }else{
                echo json_encode(["code" => 404, "info" => "No user found"]);
            }
        }else{
                echo json_encode(["code" => 404, "info" => "Invalid token"]);
                }
        
        
    }
    
    //Getting user profile
    if (isset($_GET['get_profile'])) {
        //Student id
        $stid = $_GET['stid'];
        //Query
        $sql = "SELECT tblstudents.StudentName,tblstudents.logo,tblstudents.classtype,tblstudents.session,tblstudents.Departments,tblstudents.RegDate,tblstudents.StudentId,
        tblstudents.Status,tblstudents.StudentEmail,tblstudents.Gender,tblstudents.DOB,tblclasses.ClassName,tblstudents.ClassId,tblstudents.RollId from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.StudentId=:stid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':stid',$stid,PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetch(PDO::FETCH_OBJ);
        //Append to object
        $array = array();
        //Pushing array
        array_push($array, $results);
        //Get student department
        $dpid = $results->Departments;
        $squery = mysqli_query($con, "SELECT * FROM tbldepartments WHERE id = '$dpid' ");
        $sqresult = mysqli_fetch_assoc($squery);
        $depart_ = $sqresult['DepartmentName'];
        //Converting RegDate 
        $regdate = date('F j, Y', strtotime($results->RegDate));
        //DOB converting 
        $dob = date('F j, Y', strtotime($results->DOB));
        //Converting classtype
        $newp = $results->ClassId;
        $classtype2 = $results->classtype;
        if ($newp == 13 || $newp == 14 || $newp == 15) {
            //Getting details for registration for Senior Secondary
                if (isset($classtype2)) {
                    //Show previous class type
                    if ($classtype2 == "newintakeart") {
                        
                        $classtype = 'New Intake Art';
                    }elseif ($classtype2 == "newintakescience") {
                        
                        $classtype = 'New Intake Science';
                        
                    }elseif ($classtype2 == "termlyartcomm") {
                        
                        $classtype = 'Termly Art & Comm. Dept';
                    }elseif ($classtype2 == "termlyscience") {
                        
                        $classtype = 'Termly Science Dept';
                    }elseif ($classtype2 == "sss3artcomm") {
                        
                        $classtype = 'SSS 3 Art & Comm. Dept';
                    }elseif ($classtype2 == "sss3science") {
                        
                        $classtype = 'SSS 3 Science Dept';
                    }elseif ($classtype2 == "NewIntakeSSS3Art") {
                        
                        $classtype = 'New Intake SSS 3 Art';
                    }elseif ($classtype2 == "NewIntakeSSS3Science") {
                        
                        $classtype = 'New Intake SSS 3 Science';
                    }
                }
            
                }elseif ($newp == 16 || $newp == 17 || $newp == 18) {
                    //Getting details for junior 
                        if (isset($classtype2)) {
                            //Show previous class type
                            if ($classtype2 == "newintake") {
                                
                                $classtype = 'New Intake';
                                
                            }elseif ($classtype2 == "termly") {
                                
                                $classtype = 'Termly';
                                
                            }elseif ($classtype2 == "jss3") {
                                
                                $classtype = 'JSS 3';
                                
                            }elseif ($classtype2 == "NewIntakeJSS3") {
                                    
                                $classtype = 'New Intake JSS 3';
                                
                            }
                        }
                
                }
            //Get if user is declared 
            $query = $dbh->prepare("SELECT StudentId,ClassId FROM tblresult WHERE StudentId=:StudentId and ClassId=:ClassId ");
            $query-> bindParam(':StudentId', $stid, PDO::PARAM_STR);
            $query-> bindParam(':ClassId', $newp, PDO::PARAM_STR);
            $query-> execute();
            $count = ($query->rowCount() < 1) ? 0 : 1;
            //Pushing new files into array
            $arrayName = array('depart' => $depart_,  'regdate' => $regdate, 'dob' => $dob, 'classtype' => $classtype, 'dpcount' => $count);
            //Push
            array_push($array, $arrayName);
            echo json_encode($array);
    }

?>