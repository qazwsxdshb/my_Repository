<?php
	require("../../../config.php");
	$con=mysqli_connect('127.0.0.1',$user,$pass,'CTF');
	$sqlstr="CREATE TABLE CTF(name varchar(20),score INT,Time varchar(33),author varchar(33),FLAG varchar(100),id int);";
	mysqli_query($con,$sqlstr);

	
	$name=$_POST["name"];
	
	$score=(int)$_POST["score"];
	$ddd=date("Y-m-d");
	$FLAG=$_POST["FLAG"];
	$hint=$_POST["hint"];
	
	$result=mysqli_query($con,"select * from `USER`");
	$dd=0;
	while($a=mysqli_fetch_array($result)){
		if($a[0]==$_COOKIE['username'] and $a[1]==$_COOKIE['password']){
			$dd=1;
			$author=$_COOKIE['username'];
		}
	}
	if ($dd==0){
		header("location:../");
	}
	
	$id=1;
	$result=mysqli_query($con,"select * from `CTF`");
	while($a=mysqli_fetch_array($result)){
		$id=$id+1;
		if($a[0]==$name){
			$name=null;
			break;
		}
	}
	$dd=0;
	if($author==null or $name==null){
		echo"<script>alert('name重複');history.back();</script>";
		$dd=1;
	}
	else{
		$sqlstr="INSERT INTO `CTF`(`name`,`score`,`Time`,`author`,`FLAG`,`id`)VALUES('$name','$score','$ddd','$author','$FLAG','$id')";
		mysqli_query($con,$sqlstr);
	}
	mysqli_close($con);
	
	

	$content=$_POST["content"];
	
	
	if($name!=null){
		# 檢查檔案是否上傳成功
		if ($_FILES['my_file']['error'] === UPLOAD_ERR_OK){
		  echo '檔案名稱: ' . $_FILES['my_file']['name'] . '<br/>';
		  echo '檔案類型: ' . $_FILES['my_file']['type'] . '<br/>';
		  echo '檔案大小: ' . ($_FILES['my_file']['size'] / 1024) . ' KB<br/>';
		  echo '暫存名稱: ' . $_FILES['my_file']['tmp_name'] . '<br/>';

		  # 檢查檔案是否已經存在
		  if (file_exists('upload/' . $_FILES['my_file']['name'])){
			echo '檔案已存在。<br/>';
		  } else {
			$file = $_FILES['my_file']['tmp_name'];
			$a=$_FILES['my_file']['name'];
			$x=0;
			$ee='';
			for($i=0;$i<strlen($a);$i++){
				if($a[$i]=='.'){
					$x=1;
				}
				if($x==1){
					$ee=$ee.$a["$i"];
				}
			}
			$dest = "/var/www/html/CTF/home/FLAG/$name$ee";

			# 將檔案移至指定位置
			move_uploaded_file($file, $dest);
			echo $file."<br>";
			echo $dest."<br>";
			
			$main=" 
			<html>
				<head>
					<meta charset='utf-8'>
					<title>$name</title>
				</head>
				
				<body>	
					
					<h1>$name</h1>
					<h2>作者:$author</h2>
					<h2>分數:$score</h2>
					
					<center>
						<h3>內容</h3>
						<p>$content</p><br><br>
						
						<form action='../check.php' method='post'>
							<input type='text' value='$name' name='name' hidden>
							<input type='text' value='$score' name='score' hidden>
							FLAG:<input type='text' name='FLAG' required><br><br>
							<button>submit</button>
						</form>
						<a href='$name$ee' download='$name$ee'>下載<br><br></a>
						
						提示:<input type='submit' onclick='hint();' >
					
					</center>
					
				</body>
				</html>
				
				<script>
					function hint(){
						alert('提示:$hint');
					}
				</script>
			";
		  }
		  
		}
		else {
		  $main=" 
			<html>
				<head>
					<meta charset='utf-8'>
					<title>$name</title>
				</head>
				
				<body>	
					
					<h1>$name</h1>
					<h2>作者:$author</h2>
					<h2>分數:$score</h2>
					
					<center>
						<h3>內容</h3>
						<p>$content</p><br><br>
						
						<form action='../check.php' method='post'>
							<input type='text' value='$name' name='name' hidden>
							<input type='text' value='$score' name='score' hidden>
							FLAG:<input type='text' name='FLAG' required><br><br>
							<button>submit</button>
						</form>
						
						提示:<input type='submit' onclick='hint();' >
					
					</center>
					
				</body>
				</html>
				
				<script>
					function hint(){
						alert('提示:$hint');
					}
				</script>
			";
		}

	}
	
	$a="FLAG/$name.php";
	$file=fopen("$a","wa");
	
	header("location:index.php");
	
	fwrite($file,$main);
	fclose($file);
	
	
	
?>