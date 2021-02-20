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
<title>عرض المسؤولين</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
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
   <h2>عرض المسؤولين</h2>    
 </div>
<?php
    if(isset($_GET['id'])){
         $stmt=$con->prepare("delete from admin  where Admin_id=?");
                      $stmt->execute(array($_GET['id']));
    }
    ?>

    <div class="col-md-9 col-sm-12">
    <a href="add.php" class="btn btn-primary" style="font-size: 20px;font-weight: bold;margin-bottom:10px;"> اضافة مسؤول <i class="fa fa-plus" aria-hidden="true"></i></a>
	<div class="table-responsive">
      <table class="table table-responsive" border="1">
          <thead>
            <tr>
               <th scope="col"> التعديل او الحذف</th>
                <th scope="col">الايميل</th>
                <th scope="col">اسم المسؤول بالكامل</th>
                <th scope="col"> رقم التليفون </th>
                <th scope="col"> اسم المسؤول </th>

            </tr>
          </thead>
          <tbody>
              <?php

                     $stmt=$con->prepare("select * from admin");
                     $stmt->execute(array());
                     $rows=$stmt->fetchAll();

           //echo date("d");

            foreach($rows as $r){
             ?>
                 <tr>
                  <td><a href="modify.php?id=<?php echo $r['Admin_id'];?>"  class="btn btn-success suc">تعديل المسؤول <i class="fa fa-pencil-square-o" ></i></a><a href="admin.php?id=<?php echo $r['Admin_id'];?>"  class="btn btn-danger suc" style="margin:5px;">حذف المسؤول <i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                 <td><?php echo $r['Email'] ?></td>
                 <td><?php echo $r['FullName'] ?></td>
                 <td><?php echo $r['Phone'] ?></td>  
                  <td><?php echo $r['UserName'] ?></td>

               </tr>
             <?php } ?>
          </tbody>
     </table>
	 </div>
        
   </div>

   <div class="col-md-3 col-sm-4 hide"></div>
  <?php

                    
    
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
