<?php
ob_start();
session_start();
include "connect.php";
include "functions.php";
require'database.php';
// if the user is already logged in and enter that page then it will be directed to index.php
if(!isset($_SESSION['admin']))
{
    header("location: login.php");
}
if(!empty($_POST))
{
	$id1=$_POST["id"];
	if($id1)
    {
		if($id1>2)
		{
			$url="complaints.php";
		}
	   else{$url="complaints.php?id=$id1";}
    }else
    {
	   $url="complaints.php";
    }
	$message=$_POST["message"];
	$uid=$_POST["uid"];
	$aid=$_SESSION['id'];
	$num_r=$db->insertRow("insert into notifications (Message,U_ID,not_Admin,Date,Status,type) values(?,?,?,now(),0,0)",array($message,$uid,$aid));
	if($num_r<0)
	{
		echo "error";
	}
	else
	{
		show(0);
		//echo "<a href=".$url." class='btn btn-primary' style='font-size: 20px;font-weight: bold;width:100px;'> السابقة</a>";
		header("Refresh:0;url=$url");
	}		
}else
{
	show(1);
}
function show($mess)
{
?>
<!DOCTYPE html>
<html lang="en">
<title>ارسال اشعار خاص لهذا المستخدم</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/sty.css">
<body>
<!-- Sidebar/menu -->
<div class="navbar">
    <a href="logout.php" class="logout">تسجيل خروج <i class="fa fa-sign-out" aria-hidden="true"></i></a>
    <a href="complaints.php" class="notif"><?php echo compl()?><i class="fa fa-bell" aria-hidden="true"></i></a>
    </div>
    
    
<nav class="w3-sidebar  w3-collapse w3-top w3-large" style="z-index:3;width:250px;font-weight:bold;background-color:RGB(34, 45 , 50);" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px;float:left">اغلاق القائمة</a>
  <div class="element">
    <span > <img src="images/point.jpg"> <?php echo $_SESSION['admin'] ;?> <i class="fa fa-user" aria-hidden="true"></i></span>
  
    <a href="index.php" onclick="w3_close()" class="btn">لوحة التحكم <i class="fa fa-home" aria-hidden="true"></i></a> 
    <a href="insert.php" onclick="w3_close()" class="btn "> ادخال الفاتورة <i class="fa fa-plus-square" aria-hidden="true"></i></a>
    <a href="edit.php" onclick="w3_close()" class="btn "> تعديل الفاتورة <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
       <a href="admin.php" onclick="w3_close()" class="btn "> المسؤولين <i class="fa fa-user" aria-hidden="true"></i></a>
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
<div class="container-fluid con">
 <div class="row">
   <h2>ارسال اشعار</h2>    
 </div>
 <form class="form-horizontal" method="post" action=<?php echo "sendnot.php";?>>
 <input type="hidden" name="uid" value=<?php if($mess){echo $_GET["uid"];}else{global $uid;echo $uid;} ?>>
 <input type="hidden" name="id" value=<?php if($mess){echo $_GET["id"];}else{global $id1;echo $id1;} ?>>
   <div class="form-group">
		<div class="col-md-7  col-sm-9">
			<textarea class="form-control message" required rows="5" name="message" id="comment"  oninvalid="this.setCustomValidity('ارجو ادخال رسالة التنبيه التى سوف ترسل للمستخدم')" oninput="setCustomValidity('')"></textarea>
		</div>
			<label class="control-label col-md-2 col-sm-3" for="comment">رسالة التنبيه :</label>
		<div class="col-md-3 col-sm-4 hide"></div>
    </div>
  <div class="form-group"> 
    <div class="col-md-7  col-sm-9">
      <button type='submit' name="submit" class='btn btn-primary btn-block' style="font-size: 22px;">ارسال الاشعار</button>
    </div>
      <div class="control-label col-md-2 col-sm-3"> </div>
      <div class="col-md-3 col-sm-4 hide"></div>
  </div>
</form>
<?php if($mess){}else{?>
<div> 
	<div class='col-md-7  col-sm-9'>
		<div class='alert alert-success' style='font-weight:bolder;font-size:20px;color:blue;'>تم ارسال الاشعار بنجاح العودة الى صفحة الشكاوى الان</div>
	</div>
	<div class='control-label col-md-2 col-sm-3'> </div>
	<div class='col-md-3 col-sm-4 hide'></div>
</div>
<?php }?>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
<?php } ?>
