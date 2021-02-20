<?php
    
    ob_start();
    session_start();

    // if the user is already logged in and enter that page then it will be directed to index.php
    if(isset($_SESSION['userid']))
    {
        header("location: index.php");
    }

    $title = 'التسجيل';
    include 'init.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $msg = array();
        
        $username        = $_POST['username'];
        $fullname        = $_POST['fullname'];
//        $username        = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
//        $fullname        = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
        
        
        $email           = $_POST['email'];
//        $email           = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        
        $socialid        = $_POST['socialid'];
        
        $password        = $_POST['password'];
        $password2       = $_POST['password2'];
//        $password_hash   = password_hash($password, PASSWORD_DEFAULT);
        
        $mobile          = $_POST['mobile'];
//        $mobile        = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
        
        $govern          = $_POST['govern'];
        $center          = $_POST['center'];
        $district        = empty($_POST['district'])? "none" : $_POST['district'];
        
        $address         = $_POST['address'];
//        $address        = filter_var($_POST['address'], FILTER_SANITIZE_STRING);

        $row = $db->getRow("select * from users where UserName = ?", array($username));
        
        
//        if(strlen($username) < 3 || strlen($username) > 10)
//        {
//            $msg[] = "<div class='alert alert-danger'>User Name should be between 3 and 10 characters</div>";
//        }

        if(!empty($row))
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>اسم المستخدم مستعمل!</div>";
        }
        
        if($password != $password2)
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>كلمة المرور لا تتطابق</div>";
        }
        
        if(empty($password) || strlen($password) < 3)
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>كلمة المرور يجب الإ تقل عن 3 احرف.</div>";
        }
        
//        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
//        {
//            $msg[] = "<div class='alert alert-danger' dir='rtl'>البريد الالكترونى غير صالح</div>";
//        }
        
//        if(filter_var($socialid, FILTER_VALIDATE_INT) == false || strlen($socialid) != 14)
//        {
//            $msg[] = "<div class='alert alert-danger' dir='rtl'>الرقم القومى غير صالح</div>";
//        }
        
//        if(filter_var($mobile, FILTER_VALIDATE_INT) == false)
//        {
//            $msg[] = "<div class='alert alert-danger' dir='rtl'>الهاتف غير صالح</div>";
//        }
        
//        if(empty($govern) || empty($center))
//        {
//            $msg[] = "<div class='alert alert-danger' dir='rtl'>يجب اختيار المحافظة والمركز</div>";
//        }

        if(empty($msg))
        {
            $db->insertRow("insert into users(UserName, Password, social_id, Phone, Email, Govern, District, address, Center, FullName, Electricity, Water, Gas) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 1, 1)", array($username, $password, $socialid, $mobile, $email, $govern, $district, $address, $center, $fullname));
            
            $_SESSION['username']   = $username;
            $_SESSION['userid']     = $row['ID'];
            
            $success = "<div class='alert alert-success' dir='rtl'>تم الاشتراك بنجاح</div>";
        }
    }

?>
<!-- chat Script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=c19d9dcc-731c-4a28-aa46-a8cddd09f7d7"> </script>


<div class="signup">
    <div class="overlay">
        <div class="container">

            <form method="post" class="center-block">

                <h2>التسجيل</h2>
                
                <?php
                
                    if(isset($msg)) 
                    {
                        foreach($msg as $m)
                        {
                            echo $m;
                        }
                    }
                
                if(isset($success))
                {
                    echo $success;
                    header("refresh:2; url=index.php");
                }
                
                ?>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user fa-fw"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="اسم المستخدم" name="username" required>
                        
<!--                         pattern=".{3,10}" title="Username should be between 3 and 10 characters"-->
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user fa-fw"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="الاسم بالكامل" name="fullname" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope fa-fw"></i>
                        </div>
                        <input type="email" class="form-control" placeholder="البريد الالكترونى" name="email" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <input type="number" class="form-control" placeholder="الرقم القومى" name="socialid" required>
<!--                        minlength="14" minlength="14"-->
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-key fa-fw"></i>
                        </div>
                        <input type="password" class="form-control" placeholder="كلمة المرور" name="password" required autocomplete="new-password">
<!--                        minlength="3" or we use pattern=".{3,}"-->
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-key fa-fw"></i>
                        </div>
                        <input type="password" class="form-control" placeholder="تاكيد كلمة المرور" name="password2" required autocomplete="new-password" >
<!--                        minlength="3"-->
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone fa-fw"></i>
                        </div>
                        <input type="number" class="form-control" placeholder="رقم الهاتف" name="mobile" required>
<!--                        minlength="11"-->
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map-marker fa-fw"></i>
                        </div>
                        <select class="form-control govern" name="govern" required>
                            <option value="-1">اختر المحافظة</option>
                            
                            <?php
                                $q = "select * from govern;";
                                $rows_govern = $db->getRows($q);
                                
                                if(!empty($rows_govern))
                                {
                                    foreach($rows_govern as $row_govern)
                                    {
                                        echo "<option value='$row_govern[1]'>$row_govern[1]</option>";
                                    }
                                }
                            ?>
                            
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map-marker fa-fw"></i>
                        </div>
                        <select class="form-control center" name="center" disabled="disabled" required>
                            <option value="-1">اختر المركز</option>
                            
                            <?php
                            
                                foreach($rows_govern as $row_govern)
                                {
                                    echo "<optgroup label='$row_govern[1]' style='display:none'>";
                                    
                                        $rows_centers = $db->getRows("select * from centers where govern_id = ?;", array($row_govern[0]));
                                        foreach($rows_centers as $row_centers)
                                        {
                                            echo "<option value='$row_centers[1]'>$row_centers[1]</option>";
                                        }
                                    
                                    echo "</optgroup>";
                                }
                                
                            ?>
                            
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map-marker fa-fw"></i>
                        </div>
                        <select class="form-control district" name="district" disabled="disabled" required>
                            <option value="-1">اختر الحى</option>
                            
                            <?php
                            
                                foreach($rows_govern as $row_govern)
                                {
                                    echo "<optgroup label='$row_govern[1]' style='display:none'>";
                                    
                                        $rows_districts = $db->getRows("select * from districts where govern_id = ?;", array($row_govern[0]));
                                        foreach($rows_districts as $row_districts)
                                        {
                                            echo "<option value='$row_districts[1]'>$row_districts[1]</option>";
                                        }
                                    
                                    echo "</optgroup>";
                                }
                            
                            ?>
                            
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <textarea class="form-control" placeholder="العنوان بالكامل" name="address" required dir="rtl"></textarea>
                </div>
                
                <input type="submit" value="التسجيل" class="form-control center-block">

            </form>

        </div>
    </div>
</div>

<?php

    include "$tpl/footer.php";
    ob_end_flush();

?>