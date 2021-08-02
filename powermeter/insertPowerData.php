<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require('../../../config.php');
	
	$sIP=_GetRequest('IP');
	if($sIP==-1 || $sIP==0)
		$sIP = get_client_ip_server();
	$KitID=_GetRequest('ID');
	$TT1=_GetRequest('TT1');
	$TT2=_GetRequest('TT2');
	
	$conn = mysqli_connect($host,$user,$passwd,$HomePowerMeterDBname);
	
	$dateTime1 = date(strtotime("+0 hours"));
	$dateTime = gmdate("Y/m/d H:i:s", $dateTime1);
	$dateTimeStock = gmdate("Y/m/d", $dateTime1);
	$year = gmdate("Y", $dateTime1);
	$Month = gmdate("m", $dateTime1);
	$date = gmdate("d", $dateTime1);
	
	$tableName = $KitID."_".$year.$Month.$date;
	CheckTableExistAndCreate($tableName);
	
	$postdata = file_get_contents("php://input");
	
	$ar = unpack('C*', $postdata);
	
//	for($j=0;$j<60;$j++)
	for($j=0;$j<60;$j++)
	{
		$T=$TT2-60+$j;
		{
			$index=$j*1+60*0;
			$AItem = ($ar[4+$index*4]<<24) + ($ar[3+$index*4]<<16) + ($ar[2+$index*4]<<8) + $ar[1+$index*4];
			$index=$j*1+60*1;
			$BItem = ($ar[4+$index*4]<<24) + ($ar[3+$index*4]<<16) + ($ar[2+$index*4]<<8) + $ar[1+$index*4];
			$index=$j*1+60*2;
			$CItem = ($ar[4+$index*4]<<24) + ($ar[3+$index*4]<<16) + ($ar[2+$index*4]<<8) + $ar[1+$index*4];
		}
		
		$sqlStr = "
		INSERT INTO `$tableName`
		(`sourceIP`, `MeterTime`
			, `A`, `B`, `C`
		) VALUES 
		('$sIP',$T
			,$AItem,$BItem,$CItem
		)
		";

		$result = mysqli_query($conn,$sqlStr);
	}
	
	$timestamp = time()+3600*0;
	echo "timestamp=$timestamp\r\n";
	
	mysqli_close($conn);

function CheckTableExistAndCreate($tableName)
{
	global $conn;
	{
		mysqli_query($conn,'set names utf8');
		
		$exists = mysqli_query($conn,"select 1 from $tableName");
		if($exists !== FALSE)
		{
			//echo("This table exists<br>");
		}
		else
		{
			echo("This table doesn't exist<br>");
			$sqlStr = "
				CREATE TABLE `$tableName` (
					`ID` int(11) NOT NULL,
					`sourceIP` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
					`MeterTime` bigint(11) DEFAULT NULL,
					`A` int(11) DEFAULT NULL,
					`B` int(11) DEFAULT NULL,
					`C` int(11) DEFAULT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
			";
			//echo $sqlStr;
			$result = mysqli_query($conn,$sqlStr);
			if($result)
			{
				//echo $result."create OK<br>";
				$sqlStr = "
					ALTER TABLE `$tableName`
						ADD PRIMARY KEY (`ID`);
				";
				$result = mysqli_query($conn,$sqlStr);
				$sqlStr = "
					ALTER TABLE `$tableName`
						MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
				";
				$result = mysqli_query($conn,$sqlStr);

			}
			else
			{
				echo "create faile";
			}
		}
	}
}

	function _GetRequest($str)
	{
		if (isset($_REQUEST[$str]))
		{
			if(empty($_REQUEST[$str]))
			{

				$Ret=0;
			}
			else
			{
				$Ret = $_REQUEST[$str];
			}
		}
		else
		{
			$Ret = -1;
		}
		return $Ret;
	}
	
	function get_client_ip_server() 
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
            $ipaddress =getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;		
	}


	
?>
