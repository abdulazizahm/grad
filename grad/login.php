<?php
    
    ob_start();
    session_start();

    // if the user is already logged in and enter that page then it will be directed to index.php
    if(isset($_SESSION['username']))
    {
        header("location: index.php");
    }

    $title = 'تسجيل الدخول';
    include 'init.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        

        $row = $db->getRow("select * from users where UserName = ? and Password = ?", array($username, $password));
        
        if($row !== false)
        {
            $_SESSION['username']   = $username;
             $_SESSION['userid']     = $row['ID'];
            $_SESSION['socialid']   =$row['social_id'];
            $_SESSION['govern']     =$row['Govern'];
            $_SESSION['center']     =$row['Center'];
            $_SESSION['email']      =$row['Email'];
            $_SESSION['phone']      =$row['Phone'];
            $_SESSION['fullname']   =$row['FullName'];
            header("location: index.php");
        }
        else
        {
            $msg = "<div class='alert alert-danger' dir='rtl'>فشل تسجيل الدخول</div>";
        }
        
        // when using password hashing
        
        /*
        $row = $db->getRow("select Password from users where UserName = ?", array($username));
        
        if($row !== false && password_verify($password,$row[0]))
        {
            $_SESSION['username']   = $username;
            $_SESSION['userid']     = $row['ID'];
            header("location: index.php");
        }
        */
    }

?>
<!-- chat Script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=c19d9dcc-731c-4a28-aa46-a8cddd09f7d7"> </script>

<div class="login">
    <div class="overlay">
        <div class="container">

            <form method="post" class="center-block">

                <h2>تسجيل الدخول</h2>
                
                <?php if(isset($msg)) { echo $msg; } ?>

                <div class="form-group">
                    <label dir="rtl" style="float: right">اسم المستخدم</label>
                    <input type="text" class="form-control" name="username" required autocomplete="off">
                </div>

                <div class="form-group">
                    <label dir="rtl" style="float: right">كلمة المرور</label>
                    <input type="password" class="form-control pass" name="password" required autocomplete="new-password">
                    <i class="fa fa-eye"></i>
                </div>

                <input type="submit" value="تسجيل الدخول" class="form-control center-block">

            </form>

        </div>
    </div>
</div>

<?php

    include "$tpl/footer.php";
    ob_end_flush();

?>