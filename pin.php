<?php
session_start();
if(!isset($_SESSION['alogin'])) header("Location: index.php");
error_reporting(0);
include('includes/config.php');

function encrypt($string, $key) {
    $result = '';
    return sha1($string);
}
$string_to_encrypt = date('Y').rand(0,500).time().rand(0,500);
$password = strlen($string_to_encrypt);
$encrypted_string = encrypt($string_to_encrypt, $password);
// $decrypted_string=decrypt($encrypted_string, $password);

$stmt = $dbh->prepare("INSERT INTO tblpin(pin, keytext) VALUES(?, ?)");
$stmt->execute([$encrypted_string, $string_to_encrypt]);
 
// echo $encrypted_string."<br>";
echo $string_to_encrypt;

?>