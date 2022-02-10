<?php
	print("
		<title>challenge</title>
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
			$uid=$a[3];
			break;
		}
	}
	if ($dd==0){
		header("location:../");
	}
	
	$challenge=explode(".",$uid);
	
	$sqlstr="select * from CTF";
	$result=mysqli_query($con,$sqlstr);
	print("<center><p>|Name------score|</p></center>");
	if($result==null){
		echo "NO";
	}
	else{
		while($a=mysqli_fetch_array($result)){
			$c=0;
			foreach($challenge as $aa=>$b){
				if($b==$a[5]){
					$c=1;
					print_r("<center><a href=FLAG/$a[0].php style='color:green'>$a[0] :$a[1]分</a>\n<br></center>","");
					break;
				}
			}
			if($c==0){
				print_r("<center><a href=FLAG/$a[0].php style='color:red'>$a[0] :$a[1]分</a>\n<br></center>","");
			}
		}
	}
	mysqli_close($con);
?>