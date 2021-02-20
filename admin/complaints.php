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
	$cid=$_POST['cid'];
	$rows=$db->updateRow("update complaints set status=1 where cid=?",array($cid));
}
?>
<!DOCTYPE html>
<html lang="en">
<title>الشكاوى</title>
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
    <a href="#" class="notif"><?php echo compl()?><i class="fa fa-bell" aria-hidden="true"></i></a>
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
	<a href="complaints.php" onclick="w3_close()" class="btn active">عرض الشكاوى<i class="fa fa-comments" aria-hidden="true"></i></a>
	<a href="hangcomplaints.php" onclick="w3_close()" class="btn" style="font-size:17px">عرض الشكوى التى تم التعامل معها<i class="fa fa-comments" aria-hidden="true"></i></a>
     
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="container-fluid w3-top w3-hide-large  w3-xlarge w3-padding" style="background-color: RGB(60, 141 , 188);">
    <a href="logout.php" class="logout">تسجيل خروج <i class="fa fa-sign-out" aria-hidden="true"></i></a>
    <a href="#" class="notif"><?php echo compl()?><i class="fa fa-bell" aria-hidden="true"></i></a>
  <a href="javascript:void(0)" class="w3-button " style="background-color: RGB(60, 141 , 188);" onclick="w3_open()">☰</a>
  
</header> 

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<!-- !PAGE CONTENT! -->
<div class="container-fluid con">
 <div class="row">
   <h2>الشكاوى</h2>    
 </div>
<div class="row con">
<div class="col-md-9  col-sm-12">
<?php
$row=$db->getRow("SELECT count(*) from complaints where status=0 and type='bad_service'",array());
$rows=$db->getRow("SELECT count(*) from complaints where status=0 and type='service_failure'",array());
$count1=$row[0];
$count2=$rows[0];
?>
<a href="complaints.php?id=1"> <button type="button" class="bttn btn btn-primary" style='width:auto;font-size:20px;margin-bottom:8px;'>خدمة سيئة <span class="badge"><?php echo $count1;?></span></button></a>
<a href="complaints.php?id=2" style="margin-right:30px;"><button type="button" class="bttn btn btn-primary" style='width:auto;font-size:20px;margin-bottom:8px;'>شكوى تعطل الخدمة <span class="badge"><?php echo $count2;?></span></button></a>
<div class="table-responsive">
<table class="table" border="1px">
    <thead>
      <tr>
        <th>رقم الشكوى</th>
        <th>اسم المستخدم</th>
        <!--<th>منطقة المستخدم</th>-->
        <th>الخدمة</th>
        <th>الشكوى</th>
		<th>نوع الشكوى</th>
		<th>حالة الشكوى</th>
		<th>الفعل</th>
      </tr>
    </thead>
    <tbody>
<?php
if(!empty($_GET))
{
	$id=$_GET["id"];
	if($id==1)
	{
		show("SELECT * from complaints where status=0 and type='bad_service';",1);
	}elseif($id==2)
	{
		show("SELECT * from complaints where status=0 and type='service_failure';",2);
	}else
	{
		show("SELECT * from complaints where status=0;",0);
	}
}else
{
	show("SELECT * from complaints where status=0;",0);
}
?>
    </tbody>
  </table> 
</div>
</div>
<div class="col-md-3 hide"></div>
</div>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
<?php
function show($q,$id){
   global $db;
   $arr=array("Default","success","danger","info","warning","active");
   $rows=$db->getRows($q,array());
   $i=0;
   if($id)
   {
	   $url="complaints.php?id=$id";
   }else
   {
	   $url="complaints.php";
   }
	if(count($rows)>0)
	{
		foreach($rows as $row)
		{
			$n=$db->getRow("SELECT * from users where ID=?",array($row["U_id"]));
			if($row["type"]=="bad_service")
			{
				$dis='خدمة سيئة';
			}elseif($row["type"]=="service_failure")
			{
				$dis='شكوى تعطل الخدمة';
			}   
			if($row["service"]=="gas")
			{
				$ser='الغاز';
			}else if($row["service"]=="electricity")
			{
				$ser='الكهرباء';
			}else
			{
				$ser='المياه';
			}
			echo "<form method='post' action='".$url."' name='modified' value='aa'><tr class=".$arr[$i]."><td>".$row["cid"] ."</td>";
			echo"<td>".$n["FullName"]."</td>";
			//echo"<td>".$n["Govern"]." - مركز ".$n["Center"]." - ".$n["District"]."</td>";
			echo"<td>".$ser."</td>";
			echo"<td>".$row["Complain"]."</td>";
			echo"<td>".$dis."</td>";
			echo"<td><input type='text' value='لم يتم التعامل' class='form-control' id=email></td>";
			echo "<td>
			<div class='form-group'><button type='submit' style='font-size:16px;font-weight:bold;' class='btn btn-success btn-block'>تم التعامل <i class='fa fa-check-square' aria-hidden='true'></i></i></button></div>
			<div class='form-group'><a href='sendnot.php?uid=".$row["U_id"]."&id=$id'><button type='button' style='font-size:16px;font-weight:bold;' class='btn btn-success btn-block'>
			ارسال اشعار</button></a></div>
			<input type='hidden' name='cid' value='".$row["cid"]."'>
			</td></tr></form>";
			$i=$i+1;
			if($i>5)
			{
				$i=1;
			}
		}
	}else
	{
		echo "<tr class=".$arr[0]."><td colspan='6'>جدول الشكاوى فارغ من هذا النوع من الشكوى</td><tr>";
	}
}
?>
