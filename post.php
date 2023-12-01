<?php
require('C:\Users\a3574\OneDrive\桌面\html\config.php');
$con = mysqli_connect($host,$user,$passwd,$DBname);
mysqli_query($con,"SET NAMES 'UTF8'");
$id=$_GET["id"];
$sqlStr="SELECT Blog_id,user.name,title,time,type,Blog.content FROM Blog INNER JOIN user ON user_id=user.id WHERE(`Blog_id`=$id)";
$result=mysqli_query($con,$sqlStr);
while($row=mysqli_fetch_array($result)){
	$user=$row[1];
	$title=$row[2];
	$time=$row[3];
	$type=$row[4];
    $content=$row[5];
}
mysqli_close($con);
?>

<html>
<head>
    <title>post</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./blog/title.css">
    <link rel="stylesheet" href="./blog/post.css">
    <script defer src="https://cdn.jsdelivr.net/gh/zerodevx/zero-md@2/dist/zero-md.legacy.min.js"></script>
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
    
    <div class="people">
        <div class="author"><?php echo $user;?></div>
        <div class="avatar"></div>
        <div class="connect">link</div>
    </div>
    
    <div class="comment">
        <div class="comment-title">
            <?php
                echo $title;
            ?>
        </div>
        <div class="comment-time">
            <?php
                echo $time;
            ?>
        </div>
        
        <div class="comment_tt">
        <?php
            $NewString=$type;
            $NewString=explode(' ',$NewString);

            for($i=0;$i<count($NewString);$i++){
                $a='<div class="comment-type">'.$NewString[$i].'</div>';
                echo $a;
            }
        ?>
        </div>

        <div class="comment-content">
            <zero-md class="output">
                <script type="text/markdown" data-dedent><?php echo $content;?></script>
            </zero-md>
            
        </div>
    </div>

</body>
</html>
