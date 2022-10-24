<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

</head>
<body>
                   
<form action="login_db.php" method="post">
    <?php if(isset($_SESSION['error'])){ ?>
        <div class="alert alert-danger" role="alert">
            <?php
                echo $_SESSION['error']; 
                unset($_SESSION['error']);
            ?>
        </div>
    <?php }?>
    <?php if(isset($_SESSION['success'])){ ?>
        <div class="alert alert-danger" role="alert">
            <?php
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
            ?>
        </div>
    <?php }?>                                  
    <label for="email">Email</label>
    <input  type="email" name="email" > 
    <br>                                       
    <label for="password">Password</label>
    <input type="password" name="password" >                                    
    <button type="submit" name="login">เข้าสู่ระบบ</button>
    <p>ยังไม่เป็นสมาชิก? <a href="register.php" >สมัครสมาชิก</a></p> 
</form>
                                  
</body>
</html>