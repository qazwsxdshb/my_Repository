<?php
	$username=$_COOKIE['username'];
	$password=$_COOKIE['password'];
	require("../../../config.php");
	$con=mysqli_connect('127.0.0.1',$user,$pass,'CTF');
	mysqli_query($con,"set character set 'utf8'");//讀庫 
	mysqli_query($con,"set names 'utf8'");//寫庫
	
	//username check
	$result=mysqli_query($con,"select * from `USER`");
	$dd=0;
	while($a=mysqli_fetch_array($result)){
		if($a[0]==$username and $a[1]==$password){
			$dd=1;
			$uid=$a[3];
		}
	}
	if ($dd==0){
		header("location:../../");
	}
	

	$name=$_POST['name'];
	$score=$_POST['score'];
	$FLAG=$_POST['FLAG'];
	
	$sql="select * from `CTF`";
	$result=mysqli_query($con,$sql);
	$dd=0;
	
	//CTF check
	while($a=mysqli_fetch_array($result)){
		if($a[0]==$name and $a[1]==$score){
			$dd=1;
			if($a[4]==$FLAG){
				$dd=2;
				$id=$a[5];
				break;
			}
		}
	}
	if ($dd==0){
		header("location:../../");
	}
	$pp=0;
	if ($dd==1){
		echo "<script>alert('error');history.back();</script>";
		$pp=11;
	}
	
	$challenge=explode(".",$uid);
	foreach($challenge as $a=>$b){
		if($b==$id){
			$dd=3;
			break;
		}
	}
	
	if ($dd==2){
		
		//加分
		$sql="UPDATE USER SET score=score+$score WHERE username='$username'";
		
		mysqli_query($con,$sql);
		
		//id
		$uid=$uid.".".$id;
		$sql="UPDATE USER SET uid='$uid' WHERE username='$username'";
		mysqli_query($con,$sql);
		header("location:home.html");
	}
	
	elseif($dd==3 and $pp!=11){
		//重複題目
		echo"<script>alert('重複做過不加分');window.location.href='challenge.php';</script>";
	}
	
	mysqli_close($con);

?>
