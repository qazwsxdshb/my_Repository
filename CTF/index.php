<?php
$aa=0;
if (isset($_COOKIE['post'])){
	setcookie('username','');
	setcookie('password','');
}
include("login.html");
if (isset($_COOKIE['username']) and isset($_COOKIE['password'])){
	$aa=1;
	$aa=check();

}

if($aa==1){
	setcookie('username','');
	setcookie('password','');
	echo"<script>alert('帳密錯誤');</script>";
}

function check(){
	require("../../config.php");
	$con=mysqli_connect('127.0.0.1',$user,$pass,'CTF');
	mysqli_query($con,"set character set 'utf8'");//讀庫 
	mysqli_query($con,"set names 'utf8'");//寫庫
	$sql='SELECT * FROM `USER`;';
	$result=mysqli_query($con,$sql);
	
	while($a=mysqli_fetch_array($result)){
		if($a[0]==$_COOKIE['username'] and $a[1]==$_COOKIE['password']){
			header("location:home");
			return 2;
		}
	}
	return 1;
}
mysqli_close();
?>