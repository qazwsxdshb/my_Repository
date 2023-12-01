<?php
$blog_name=$_COOKIE["name"];
$blog_password=$_COOKIE["password"];

$save=$_POST["save"];
$title=$_POST["title"];
$type=$_POST["type"];

require('C:\Users\a3574\OneDrive\桌面\html\config.php');
$con = mysqli_connect($host,$user,$passwd,$DBname);
mysqli_query($con,"SET NAMES 'UTF8'");

$date=date("M d, Y");
$sql_str="INSERT INTO `Blog`(`user_id`, `title`, `time`, `type`, `content`, `view`, `how_view`) VALUES ((SELECT id FROM user WHERE ('$blog_name'=user.name and '$blog_password'=user.password)),'$title','$date','$type','$save',0,0)";

mysqli_query($con,$sql_str);

header("Location: index.php");
?>