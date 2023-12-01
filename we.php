<html>
<head>
    <title>Blog</title>
    <link rel="stylesheet" href="./blog/we.css">
    <link rel="stylesheet" href="./blog/title.css">
    <?php
        require('C:\Users\a3574\OneDrive\桌面\html\config.php');
        $con = mysqli_connect($host,$user,$passwd,$DBname);
        mysqli_query($con,"SET NAMES 'UTF8'");
    ?>

</head>
<body>

    <div class="title">
        <div class="right">
            <a class="content down" href="index.php">easn</a>
        </div>
        <div class="list">
            <a class="content" href="compose.php">compose</a>
            <a class="content" href="https://www.youtube.com/">about</a>
            <a class="content" href="author.php">we</a>
        </div>
    </div>

    <div class="author">
    <?php
        $sqlStr = "SELECT id,user FROM user;";
        $result = mysqli_query($con,$sqlStr);
        while($row = mysqli_fetch_array($result)){
            $a='<div class="name">'.$row[1];
            $a.='<div class="avatar"><img src="./blog/img/'.$row[0].'.png"></div></div>';
            echo $a;
        }
    ?>
    </div>

</body>
</html>