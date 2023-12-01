<html>
<head>
    <title>easn</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./blog/index.css">
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
            <a class="content" href="we.php">we</a>
        </div>
    </div>

    <input placeholder="search" id="search" class="search" size="10">

    <div class="god">
        <div class="rank_title">hot</div>
        <?php
            $sqlStr = "SELECT title,Blog_id FROM Blog ORDER BY Blog_id;";
            $result = mysqli_query($con,$sqlStr);
            while($row = mysqli_fetch_array($result))
            {
                $a='<div class="rank">';
                $a.='<a class="rank_a" href="post.php?id='.$row[1].'">'.$row[0].'</a></div>';
                echo $a;
            }
        ?>
    </div>

    <div class="table">
        <?php
        if(isset($_GET["search"])){
            $sqlStr = "SELECT user.name,title,time,type,Blog_id FROM Blog Inner join user on Blog.user_id=user.id WHERE title LIKE '%".$_GET["search"]."%' OR user.name LIKE '%".$_GET["search"]."%' OR Blog.type LIKE '%".$_GET["search"]."%' ORDER BY Blog_id DESC;";
        }
        else{
            $sqlStr = "SELECT user.name,title,time,type,Blog_id FROM Blog Inner join user on Blog.user_id=user.id ORDER BY Blog_id DESC;";
        }
        
        $result = mysqli_query($con,$sqlStr);
        
        while($row = mysqli_fetch_array($result))
        {
            $a='<div class="comment">';
            $a.='<div class="'.$row[0].'-avatar" onclick="window.location='.'\'http://google.com\''.'"><a class="author" href="post.php">'.$row[0].'</a></div>';
            $a.='<a class="project" href="post.php?id='.$row[4].'">'.$row[1].'</a><div class="comment_tt">';
            
            $NewString=$row[3];
            $NewString=explode(' ',$NewString);

            for($i=0;$i<count($NewString);$i++){
                $a.='<div class="tt">'.$NewString[$i].'</div>';
            }

            $a.='</div><div class="date">'.$row[2].'</div></div>';
            echo $a;
        }
        ?>
        
    </div>
</body>
</html>

<script>
var input = document.getElementById("search");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
    var a=document.getElementById('search').value

    window.location.replace("?search="+a);
  }
});
</script>