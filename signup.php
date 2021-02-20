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
        
//        $username        = $_POST['username'];
//        $fullname        = $_POST['fullname'];
        $username        = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $fullname        = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
        
        
        $email           = $_POST['email'];
//        $email           = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        
        $socialid        = $_POST['socialid'];
        
        $password        = $_POST['password'];
        $password2       = $_POST['password2'];
        $password_hash   = password_hash($password, PASSWORD_DEFAULT);
        
        $mobile          = $_POST['mobile'];
//        $mobile        = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
        
        $govern          = $_POST['govern'];
        $center          = empty($_POST['center'])? "none" : $_POST['center'];
        $district        = empty($_POST['district'])? "none" : $_POST['district'];
        
//        $address         = $_POST['address'];
        $address        = filter_var($_POST['address'], FILTER_SANITIZE_STRING);

        $row = $db->getRow("select * from users where UserName = ?", array($username));
        
        
        if(strlen($username) < 3 || strlen($username) > 10)
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>اسم المستخدم يجب ان يكون بين 3 و 10 أحرف</div>";
        }

        if(!empty($row))
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>اسم المستخدم مستعمل!</div>";
        }
        
        
        if(strlen($fullname) < 10 || strlen($fullname) > 60)
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>الاسم الكامل للمستخدم يجب ان يكون بين 10 و 60 حرف</div>";
        }
        
        
        if($password != $password2)
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>كلمة المرور لا تتطابق</div>";
        }
        
        if(strlen($password) < 5 || strlen($password) > 15)
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>كلمة المرور يجب ان تكون بين 5 و 15 حرف</div>";
        }
        
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>البريد الالكترونى غير صالح</div>";
        }
        
        if(!is_numeric($socialid))
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>الرقم القومى غير صالح</div>";
        }
        
        $row_s = $db->getRow("select * from users where social_id = ?", array($socialid));
        if(!empty($row_s))
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>الرقم القومى مستعمل!</div>";
        }
        
        if(is_numeric($socialid) && strlen($socialid) != 14)
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>الرقم القومى غير صالح</div>";
        }
        
        
        if(!is_numeric($mobile))
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>الهاتف غير صالح</div>";
        }
        
        
        if(is_numeric($mobile) && strlen($mobile) != 11)
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>الهاتف غير صالح</div>";
        }
        
        
        if($govern == -1 || $center == -1)
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>يجب اختيار المحافظة والمركز</div>";
        }
        
        if(empty($address))
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>يجب كتابة العنوان بالكامل</div>";
        }

        if(empty($msg))
        {
            $db->insertRow("insert into users(UserName, Password, social_id, Phone, Email, Govern, District, address, Center, FullName, Electricity, Water, Gas) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 1, 1)", array($username, $password_hash, $socialid, $mobile, $email, $govern, $district, $address, $center, $fullname));
            
            $row = $db->getRow("select ID from users where UserName = ?", array($username)); 
            
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
                        <input type="text" class="form-control" placeholder="اسم المستخدم" name="username" required pattern=".{3,10}" title="اسم المستخدم يجب ان يكون بين 3 و 10 أحرف">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user fa-fw"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="الاسم بالكامل" name="fullname" required  pattern=".{10,60}" title="الاسم الكامل للمستخدم يجب ان يكون بين 10 و 60 حرف">
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
                        <input type="text" class="form-control" placeholder="الرقم القومى" name="socialid" required pattern="^[0-9]{14}$" title="الرقم القومى غير صالح">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-key fa-fw"></i>
                        </div>
                        <input type="password" class="form-control" placeholder="كلمة المرور" name="password" required autocomplete="new-password" pattern=".{5,15}" title="كلمة المرور يجب ان تكون بين 5 و 15 حرف">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-key fa-fw"></i>
                        </div>
                        <input type="password" class="form-control" placeholder="تاكيد كلمة المرور" name="password2" required autocomplete="new-password" pattern=".{5,15}" title="كلمة المرور يجب ان تكون بين 5 و 15 حرف">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone fa-fw"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="رقم الهاتف" name="mobile" required pattern="^[0-9]{11}$" title="رقم الهاتف مكون من 11 رقم">
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