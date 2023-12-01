<?php
require('C:\Users\a3574\OneDrive\桌面\html\config.php');
$con = mysqli_connect($host,$user,$passwd,$DBname);
mysqli_query($con,"SET NAMES 'UTF8'");

$sqlStr = "SELECT id,name,password FROM user;";
$result = mysqli_query($con,$sqlStr);

while($row = mysqli_fetch_array($result)){
  if($row[1]==$_COOKIE["name"] && $row[2]==$_COOKIE["password"]){
    $a=true;
    break;
  }
}

if($a){
  ;
}
elseif(isset($_COOKIE["name"])){
  header("Location:login.php?value=2");
}
else{
  header("Location:login.php?value=1");
}
?>

<head>
  <script defer src="https://cdn.jsdelivr.net/gh/zerodevx/zero-md@2/dist/zero-md.legacy.min.js"></script>
  <link rel="stylesheet" href="blog/compose.css">
  <link rel="stylesheet" href="./blog/title.css">

  <title>easn</title>
</head>

<body>
  
  <div class="title">
    <div class="right">
        <a class="content down" href="index.php">easn</a>
    </div>
    <div class="list">
        <a class="content" href="compose.php">compose</a>
        <a class="content" href="https://www.youtube.com/">about</a>
        <a class="content" href="we.php">we</a>
    </div>
  </div>

</body>