<?php
    if(isset($_POST["name"],$_POST["password"])){
        setcookie("name",$_POST["name"],time()+3600);
        setcookie("password",$_POST["password"],time()+3600);
        
        header("Location:compose.php");
    }
?>
<html>
<head>  
    <title>login</title>
    <link rel="stylesheet" href="./blog/title.css">
    <link rel="stylesheet" href="./blog/login.css">
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
    <div class="table">
        <form method="post" action="login.php">
            <div class="input">
                username<br><input name="name">
            </div>
            <div class="input">
                password<br><input name="password">
            </div>
            <?php 
                if($_GET["value"]==1){
                    ;
                }
                elseif($_GET["value"]==2){
                    echo "<div class='error'>account or password error</div>";
                }
            ?>
            <input type="submit" class="save" value="save"/>
        </form>
    </div>
</body>

</html>
