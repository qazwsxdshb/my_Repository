<?php
	print("
	<title>scoreboard</title>
		<center>
	<tr>
		<a href=scoreboard.php>scoreboard</a>
		<a href=create.html>create Flag</a>
		<a href=challenge.php>challenge</a>
		<a href=logout.php>logout</a>
	</tr>
	</center>");
	require("../../../config.php");
	$con=mysqli_connect('127.0.0.1',$user,$pass,'CTF');
	mysqli_query($con,"set character set 'utf8'");//讀庫 
	mysqli_query($con,"set names 'utf8'");//寫庫
	$result=mysqli_query($con,"select * from `USER`");
	$dd=0;
	while($a=mysqli_fetch_array($result)){
		if($a[0]==$_COOKIE['username'] and $a[1]==$_COOKIE['password']){
			echo"<center><h1>score:";
			print($a[2]);
			echo"</h1></center>";
			$dd=1;
		}
	}
	if ($dd==0){
		header("location:../");
	}
	$result=mysqli_query($con,"select * from `USER` order by score DESC");
	while($a=mysqli_fetch_array($result)){
		echo"<center><h3>$a[0] score:";
		print($a[2]);
		echo"</h3></center>";
	}
?>