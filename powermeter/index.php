<?php

	ee();

	function ee(){
	require('../../../config.php');
	
	include("home.html");


	
	$conn = mysqli_connect($host,$user,$passwd,"PowerMeter2");
	
	echo "-----------------------------------------"."<br>"."|  日期  |  時間  | a | b | c |"."<br>"."-----------------------------------------"."<br>";
	//資料表切換
	
	$total=array();
	$A=array();
	$B=array();
	$C=array();
	
	$as=$_POST["search"];
	$as=str_replace("-","",$as);
	$data=$as;
	$as=date("Ymd",strtotime($as)-86400);
	
	
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
	
	$day=array();
	
	
	while($row = mysqli_fetch_array($result))
	{
		$x=$row[0]+$x;
		$y=$row[1]+$y;
		$z=$row[2]+$z;
		
		if($row[3]%3600==0 && ($data==date('Ymd',$row[3])))
		{	
			////print(hour);
			echo (date('m/d',$row[3]).date(' H',($row[3]-3600)).date('~H',$row[3])."  ".round($x/360000,0)."  ".round($y/360000,0)."  ".round($z/360000,0)."<br>");    
			////
			
			$w=$x+$y+$z;
			array_push($day,$w);
			
			echo ("h/W:".round($w/360000,0)."<br>"."<br>");
			
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
	
	}
	
	
	$sqlStr = "SELECT A,B,C,MeterTime FROM uPOM_84F8CA_".strval($as);
	$result = mysqli_query($conn,$sqlStr);
	while($row = mysqli_fetch_array($result))
	{
		$x=$row[0]+$x;
		$y=$row[1]+$y;
		$z=$row[2]+$z;
		
		if($row[3]%3600==0 && ($data==date('Ymd',$row[3])))
		{	
			////print(hour);
			echo (date('m/d',$row[3]).date(' H',$row[3]-3600).date('~H',$row[3])."  ".round($x/360000,0)."  ".round($y/360000,0)."  ".round($z/360000,0)."<br>");    
			////
			
			$w=$x+$y+$z;
			array_push($day,$w);
			
			echo ("h/W:".round($w/360000,0)."<br>"."<br>");
			
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
			//day
			echo ("每日用W數:".$data.":".(round(array_sum($day)/360000,0)/1000)."<br>"."<br>");
			
			array_push($total,(array_sum($day)/360000));
			array_push($A,($a/360000));
			array_push($B,($b/360000));
			array_push($C,($c/360000));
			
			$day=array();
		}
	
	}
	
	
	
	
	
	
	$str=file_get_contents("chart.html");
	
	$str=str_replace('$qwer$',$data,$str);
	$str=str_replace('$total$',implode(",",$total),$str);
	$str=str_replace('$A$',implode(",",$A),$str);
	$str=str_replace('$B$',implode(",",$B),$str);
	$str=str_replace('$C$',implode(",",$C),$str);
	
	echo $str;
	
	mysqli_close($conn);
	}
?>