<?php

	require('../../../config.php');
	
	include("range.html");


	
	$conn = mysqli_connect($host,$user,$passwd,"PowerMeter2");
	//資料表切換
	
	$qwqq=array();
	$total=array();
	$A=array();
	$B=array();
	$C=array();
	
	$as=$_POST["search"];
	$zx=$_POST["search2"];
	
	$as=str_replace("-","",$as);
	$zx=str_replace("-","",$zx);
	
	
	$as=date("Ymd",strtotime($as)-86400);
	
	$mission=1+(abs(strtotime($as)-strtotime($zx))/86400);
	$qq=$mission;
	
	while(0<$mission)
	{
	
	$mission=$mission-1;
	
	
	$sqlStr = "SELECT A,B,C,MeterTime FROM uPOM_84F8CA_".strval($as);
		//echo "$sqlStr\n";
	$as=date("Ymd",strtotime($as)+86400);
	$result = mysqli_query($conn,$sqlStr);
	
	$x=0;
	$y=0;
	$z=0;
	
	$a=0;
	$b=0;
	$c=0;
	
	$momth=array();
	$day=array();
	
	
	while($row = mysqli_fetch_array($result))
	{
		$x=$row[0]+$x;
		$y=$row[1]+$y;
		$z=$row[2]+$z;
		
		if($row[3]%3600==0)
		{	
			
			$w=$x+$y+$z;
			array_push($day,$w);
			
			$a=$a+$x;
			$b=$b+$y;
			$c=$c+$z;
		}
		
		if($row[3]%3600==0)
		{
			$x=0;
			$y=0;
			$z=0;
		}
		
		if (($row[3]+32400)%86400==0)
		{	
			array_push($qwqq,date("Ymd",($row[3]+(8*3600))));
			array_push($total,(array_sum($day)/360000));
			array_push($A,($a/360000));
			array_push($B,($b/360000));
			array_push($C,($c/360000));
			
			$day=array();
		}
	
	}
	}
	
	
	unset($total[0]);
	unset($A[0]);
	unset($B[0]);
	unset($C[0]);
	
	$str=file_get_contents("chart.html");
	$str=str_replace('$qwer$',implode(",",$qwqq),$str);
	$str=str_replace('$total$',implode(",",$total),$str);
	$str=str_replace('$A$',implode(",",$A),$str);
	$str=str_replace('$B$',implode(",",$B),$str);
	$str=str_replace('$C$',implode(",",$C),$str);
	
	echo $str;
	
	mysqli_close($conn);
	
?>