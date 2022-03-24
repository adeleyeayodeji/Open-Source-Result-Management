<?php 
include 'connection.php';
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die();

// Compress image
function compressImage($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

}
        
$adminsql = "SELECT * FROM settings";
$adminq = $dbh->query($adminsql);
$adminresult = $adminq->fetch(PDO::FETCH_OBJ);

?>