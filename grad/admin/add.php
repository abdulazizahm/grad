<!DOCTYPE html>
<html lang="en">
    <?php
    include"connect.php";
    include"functions.php";
      ob_start();
    session_start();
    if(!isset($_SESSION['admin']))
    {
        header("location: login.php");
    }
    else{
?>
<title>اضافة مسؤول</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
    <style>
        .prob{
    direction: rtl;
    font-size: 22px;
    height: 45px;
        }
        @media only screen and (min-width: 1300px){
            .prob{
              margin-left: 30px;
            }
        }
    </style>
<body>
<!-- Sidebar/menu -->
<div class="navbar">
    <a href="logout.php" class="logout">تسجيل خروج <i class="fa fa-sign-out" aria-hidden="true"></i></a>
    <a href="complaints.php" class="notif"><?php echo compl()?><i class="fa fa-bell" aria-hidden="true"></i></a>
    </div>
<nav class="w3-sidebar  w3-collapse w3-top w3-large" style="z-index:3;width:250px;font-weight:bold;background-color:RGB(34, 45 , 50);" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px;float:left">اغلاق القائمة</a>
  <div class="element">
      <span><img src="images/point.jpg"> <?php echo $_SESSION['admin'] ;?> <i class="fa fa-user" aria-hidden="true"></i></span>
    <a href="index.php" onclick="w3_close()" class="btn ">لوحة التحكم <i class="fa fa-home" aria-hidden="true"></i></a>
     
    <a href="insert.php" onclick="w3_close()" class="btn "> ادخال الفاتورة <i class="fa fa-plus-square" aria-hidden="true"></i></a>
    <a href="edit.php" onclick="w3_close()" class="btn ">تعديل الفاتورة <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
  <a href="admin.php" onclick="w3_close()" class="btn active"> المسؤولين <i class="fa fa-user" aria-hidden="true"></i></a>
  <a href="notification.php" onclick="w3_close()" class="btn"> ارسال الاشعارات <i class="fa fa-comment" aria-hidden="true"></i></a>
	<a href="complaints.php" onclick="w3_close()" class="btn">عرض الشكاوى<i class="fa fa-comments" aria-hidden="true"></i></a>
	<a href="hangcomplaints.php" onclick="w3_close()" class="btn" style="font-size:17px">عرض الشكوى التى تم التعامل معها<i class="fa fa-comments" aria-hidden="true"></i></a>
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="container-fluid w3-top w3-hide-large  w3-xlarge w3-padding" style="background-color: RGB(60, 141 , 188);">
    <a href="logout.php" class="logout">تسجيل خروج <i class="fa fa-sign-out" aria-hidden="true"></i></a>
    <a href="complaints.php" class="notif"><?php echo compl()?><i class="fa fa-bell" aria-hidden="true"></i></a>
  <a href="javascript:void(0)" class="w3-button " style="background-color: RGB(60, 141 , 188);" onclick="w3_open()">☰</a>
  
</header> 

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="container-fluid">
 <div class="row">
   <h2>اضافة مسؤول</h2>    
 </div>
    
     <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $err=array();
        $phone=$_POST['phone'];
        $password=$_POST['password'];
        if(empty($_POST['admin'])){
            $err[]='حقل اسم المسؤول فارغ' ;
        }
        if(empty($_POST['password'])){
            $err[]='حقل كلمة المرور فارغ' ;
        }
       if(strlen($password) < 5) {
           $err[] = " كلمة المرور يجب الإ تقل عن 5 احرف وارقام";
       }
        if($password!==$_POST['repassword']){
            $err[]='ادخل  نفس كلمة المرور في حقل التاكيد' ;
        }
        if(empty($phone)){
            $err[]='حقل رقم التليفون فارغ' ;
        }
        if(!preg_match("/(01)[0-9]{9}/", $phone)) 
       {
          $err[] = ' رقم التليفون غير صالح ';
       }
        if(empty($_POST['name'])){
            $err[]='حقل اسم المسؤول بالكامل  فارغ' ;
        }
        if(empty($_POST['email'])){
            $err[]='حقل الايميل فارغ' ;
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $err[] = "الايميل غير صحيح"; 
       }
        if(empty($err)){
            
            $stmt=$con->prepare("insert into admin(UserName,Password,Phone,FullName,Email)values(?,?,?,?,?)");
                      $stmt->execute(array($_POST['admin'],$_POST['password'],$_POST['phone'],$_POST['name'],$_POST['email']));
                      if($stmt){
                          ?>
                     <div class="col-md-7  col-sm-9">
                    <?php echo"<div class='alert alert-success'> تم الاضافة بنجاح</div>";?>
                  </div>
                   <div class="control-label col-md-2 col-sm-3"> </div>
                    <div class="col-md-3 col-sm-4 hide"></div> <?php
                          
                         header("refresh:3;url=admin.php");
                            die();
                              
                      }
            
            
        }
    }
 ?>  

    <form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
  <div class="form-group">
    <div class="col-md-7  col-sm-9">
      <input type="text" class="form-control" id="admin" name="admin" placeholder=" اسم المسؤول" required oninvalid="this.setCustomValidity('الرجاء ادخال اسم المسؤول')" oninput="setCustomValidity('')">
    </div>
    <label class="control-label col-md-2 col-sm-3" for="admin"> : اسم المسؤول</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
  
  <div class="form-group">
    <div class="col-md-7  col-sm-9">
      <input type="password" class="form-control prob"  id="password" name="password" placeholder=" اكلمة المرور" required oninvalid="this.setCustomValidity('الرجاء ادخال كلمة المرور')" oninput="setCustomValidity('')" >
    </div>
    <label class="control-label col-md-2 col-sm-3" for="password"> : كلمة المرور </label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
    <div class="form-group">
    <div class="col-md-7  col-sm-9">
      <input type="password" class="form-control prob"  id="repassword" name="repassword" placeholder=" تاكيد كلمة المرور" required oninvalid="this.setCustomValidity('الرجاء ادخال تاكيد كلمة المرور')" oninput="setCustomValidity('')">
    </div>
    <label class="control-label col-md-2 col-sm-3" for="repassword"> :  تاكيد كلمة المرور </label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
  <div class="form-group">
    <div class="col-md-7  col-sm-9">
      <input type="text" class="form-control" id="phone" name="phone" placeholder="رقم التليفون" required oninvalid="this.setCustomValidity('الرجاء ادخال رقم التليفون')" oninput="setCustomValidity('')">
    </div>
    <label class="control-label col-md-2 col-sm-3" for="phone"> : رقم التليفون</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
        <div class="form-group">
    <div class="col-md-7  col-sm-9">
      <input type="text" class="form-control" id="name" name="name" placeholder="اسم المسؤل بالكامل" required oninvalid="this.setCustomValidity('الرجاء ادخال اسم المسؤول بالكامل')" oninput="setCustomValidity('')">
    </div>
    <label class="control-label col-md-2 col-sm-3" for="name"> : اسم المسؤول بالكامل</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
        <div class="form-group">
    <div class="col-md-7  col-sm-9">
      <input type="email" class="form-control prob" id="email" name="email" placeholder="الايميل" required oninvalid="this.setCustomValidity('الرجاء ادخال الايميل')" oninput="setCustomValidity('')">
    </div>
    <label class="control-label col-md-2 col-sm-3" for="email"> : الايميل</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
  <div class="form-group"> 
    <div class="col-md-7  col-sm-9">
      <input type="submit" class="btn btn-primary btn-block" name="submit" value="اضافة" >
    </div>
      <div class="control-label col-md-2 col-sm-3"> </div>
      <div class="col-md-3 col-sm-4 hide"></div>
  </div>
</form>
 <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(!empty($err)){
            foreach($err as $r){?>
             <div class="col-md-7  col-sm-9">
             <?php echo"<div class='alert alert-danger'>$r</div>";?>
           </div>
             <div class="control-label col-md-2 col-sm-3"> </div>
            <div class="col-md-3 col-sm-4 hide"></div> <?php
            }
            
        }
    }
    ?>   
    

</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
<?php
    }
    ob_end_flush();
    ?>
</body>
</html>
