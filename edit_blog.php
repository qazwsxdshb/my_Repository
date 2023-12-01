<?php
$blog_name=$_COOKIE["name"];
$blog_password=$_COOKIE["password"];

$save=$_POST["save"];
$title=$_POST["title"];
$type=$_POST["type"];
$ID=$_POST["ID"];

require('C:\Users\a3574\OneDrive\桌面\html\config.php');
$con = mysqli_connect($host,$user,$passwd,$DBname);
mysqli_query($con,"SET NAMES 'UTF8'");

$date=date("M d, Y");
$sql_str="UPDATE `Blog` SET title='$title',type='$type',content='$save' INNER JOIN user ON $blog_name=user.name and $blog_password=user.password WHERE Blog_id=$ID and user_id=user.id";
echo $sql_str;
// mysqli_query($con,$sql_str);

// header("Location: index.php");
?>