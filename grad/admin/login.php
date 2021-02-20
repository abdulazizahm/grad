<!DOCTYPE html>

<html>
<?php
    
    ob_start();
    session_start();
    include"connect.php";
    // if the user is already logged in and enter that page then it will be directed to index.php
    if(isset($_SESSION['username']))
    {
        header("location: index.php");
    }

   ?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        
        <title>تسجيل الدخول</title>
        <link rel="stylesheet" href="css/front-style.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet"> 
        <style>
            body
            {
                font-family: 'Tajawal', sans-serif;
            }
        </style>
        
    </head>
    <body>
<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
         $stmt=$con->prepare("select * from admin where UserName = ? and Password = ?");
             $stmt->execute(array($username, $password));
             $row=$stmt->fetch();
        
        if($row !== false)
        {
            $_SESSION['admin']   = $username;
            $_SESSION['id']     = $row['Admin_id'];
            header("location: index.php");
        }
        else
        {
            $msg = "<div class='alert alert-danger' dir='rtl'>فشل تسجيل الدخول</div>";
        }
        
        // when using password hashing
        
        /*
        $row = $db->getRow("select Password from admin where UserName = ?", array($username));
        
        if($row !== false && password_verify($password,$row[0]))
        {
            $_SESSION['username']   = $username;
            $_SESSION['userid']     = $row['ID'];
            header("location: index.php");
        }
        */
    }

?>

<div class="login">
    <div class="overlay">
        <div class="container">

            <form method="post" class="center-block">

                <h2>تسجيل الدخول</h2>
                
                <?php if(isset($msg)) { echo $msg; } ?>

                <div class="form-group">
                    <label dir="rtl" style="float: right">اسم المستخدم</label>
                    <input type="text" class="form-control" name="username" required>
                </div>

                <div class="form-group">
                    <label dir="rtl" style="float: right">كلمة المرور</label>
                    <input type="password" class="form-control pass" name="password" required>
                    <i class="fa fa-eye"></i>
                </div>

                <input type="submit" value="تسجيل الدخول" class="form-control center-block">

            </form>

        </div>
    </div>
</div>
            <div>

            </div>

        
        <script src="js/html5shiv.min.js"></script>
        <script src="js/jquery-3.3.1.min.js"></script>
       <script src="js/bootstrap.min.js"></script>
        <script src="js/front-script.js"></script>
       <script src="js/script.js"></script>
    </body>
</html>
<?php

    ob_end_flush();

?>