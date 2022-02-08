<?php
	require("../../config.php"); 
	$con=mysqli_connect("127.0.0.1",$user,$pass,"CTF");
	$sql="CREATE TABLE USER(username varchar(33),password varchar(33),score int,uid varchar(10000));";
	mysqli_query($con,$sql);
	$username=$_POST["username"];
	$password=$_POST["password"];
	$password2=$_POST["password2"];
	if($password==$password2){
		$sql="SELECT username from USER";
		$aa=mysqli_query($con,$sql);
		$a=0;
		while($row = mysqli_fetch_array($aa))
		{
			if($username==$row[0]){
				$a=1;
			}
		}
		if($a==0){
			$sql="INSERT INTO USER(username,password,score) VALUE('$username','$password',0);";
			mysqli_query($con,$sql);
			header("location:index.php");
		}
		else{
			echo"<script>alert('帳號名稱重複');history.back();</script>";
		}
	}
	else{
		echo"<script>alert('密碼錯誤');history.back();</script>";
	}
	mysqli_close();
?>