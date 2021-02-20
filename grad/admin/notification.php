<?php
ob_start();
session_start();
include"connect.php";
include "functions.php";
require 'database.php';
// if the user is already logged in and enter that page then it will be directed to index.php
if(!isset($_SESSION['admin']))
{
    header("location: login.php");
}
if(!empty($_POST))
{
	$type=$_POST["type"];
	$govern=$_POST["govern"];
	$ids=$db->getRow("SELECT * from notifications order by Not_Id DESC limit 1",array());
    $id=(int)$ids["Not_Id"];
	$aid=$_SESSION['id'];
	$message=$_POST["message"];
	if($type==1)// نوع الشعار بضرورة الدفع
	{
		$rows=$db->getRows("SELECT * from users",array());
		foreach($rows as $row)
	    {
			$id=(int)$id+1;
			$num_r=$db->insertRow("insert into notifications (Not_Id,Message,U_ID,Date,Status,not_Admin,type) values(?,?,?,now(),0,?,?)",array($id,$message,$row["ID"],$aid,$type));
		}

	}
	else// نوع الشعار ايقاف الخدمة
	{
		if($govern!=-1)//لو اختار اسم المحافضة و كان نوع الشعار ايقاف الخدمة
		{
			$center=$_POST["center"];
			if($center!=-1)
			{
				$district=$_POST["district"];
				if($district!=-1)
				{
					$rows=$db->getRows("SELECT * from users where Govern=? and Center=? and District=?;",array($govern,$center,$district));
				}else
				{
					$rows=$db->getRows("SELECT * from users where Govern=? and Center=?",array($govern,$center));
				}
			}else
			{
				$rows=$db->getRows("SELECT * from users where Govern=?",array($govern));
			}
			if(count($rows)>0)
			{
				foreach($rows as $row)
				{
					$id=(int)$id+1;
					$num_r=$db->insertRow("insert into notifications (Not_Id,Message,U_ID,Date,Status,not_Admin,type) values(?,?,?,now(),0,?,?)",array($id,$message,$row["ID"],$aid,$type));
				}
			}else
			{
				show(1);
				die(show2("لا يوجد مستخدمون فى هذه المنطقة"));
			}
		}
		else//لو لم يختر اسم المحافضة و كان نوع الشعار ايقاف الخدمة بالمنطقة المحددة
		{
			die(show(1));
		}
	}
show(0);	
}
else
{
	show(1);
}
function show($mess){
?>
<!DOCTYPE html>
<html lang="en">
<title>ارسال اشعارات</title>
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
	   <a href="notification.php" onclick="w3_close()" class="btn active"> ارسال الاشعارات <i class="fa fa-comment" aria-hidden="true"></i></a>
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
   <h2>ارسال اشعارات</h2>    
 </div>
 <form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
 <?php
	global $db;
 ?>
<div class="form-group">
				<div class='col-md-7  col-sm-9'>
                        <select class="form-control govern area" name="govern" id='sel1' required>
                            <option value="-1" hidden>اختار اسم المحافضة :</option>
                            
                            <?php
                                $q = "select * from govern;";
                                $rows_govern = $db->getRows($q,array());
                                
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
	<label class='control-label col-md-2 col-sm-3' for='sel1'> اسم المحافضة:</label><div class='col-md-3 col-sm-4 hide'></div>
</div>
 <div class="form-group">
				<div class='col-md-7  col-sm-9'>
                        <select class="form-control center area" name="center" disabled="disabled" id='sel2' required>
                            <option value="-1" hidden>اختار اسم المركز :</option>
                            
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
	<label class='control-label col-md-2 col-sm-3' for='sel2'>اسم المركز:</label><div class='col-md-3 col-sm-4 hide'></div>
 </div>
 <div class="form-group">
				<div class='col-md-7  col-sm-9'>
                        <select class="form-control district area" name="district" disabled="disabled" id='sel3' required>
                            <option value="-1">اختار اسم الحى :</option>
                            
                            <?php
                            
                                foreach($rows_govern as $row_govern)
                                {
									//echo "<optgroup label='$row_govern[1]' style='display:none'>";
									$rows_centers = $db->getRows("select * from centers where govern_id = ?;", array($row_govern[0]));
									foreach($rows_centers as $row_centers)
									{
										echo "<optgroup label='$row_centers[1]' style='display:none'>";
                                        $rows_districts = $db->getRows("select * from districts where govern_id =? and center_id=?;", array($row_govern[0],$row_centers[0]));
                                        foreach($rows_districts as $row_districts)
                                        {
                                            echo "<option value='$row_districts[1]'>$row_districts[1]</option>";
                                        }
										echo "</optgroup>";
									}
									//echo "</optgroup>";
                                }
                            
                            ?>
                            
                        </select>
                </div>
		<label class='control-label col-md-2 col-sm-3' for='sel3'> اسم الحى:</label><div class='col-md-3 col-sm-4 hide'></div>
</div>
<br><br>
<div class="form-group">
  <div class="col-md-7  col-sm-9">
	<select class='form-control area' name='type' id='sel4'>
	<option  value='0' selected>اشعار لاعلام المستخدمين بايقاف الخدمة بهذه المنطقة</option>
	<option  value='1'>اشعار لاعلام جميع المستخدمين بضرورة الدفع</option></select>
  </div>
		<label class="control-label col-md-2 col-sm-3" for="sel4"> نوع الاشعار:</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
   <div class="form-group">
		<div class="col-md-7  col-sm-9">
			<textarea class="form-control message" required rows="5" name="message" id="comment" oninvalid="this.setCustomValidity('ارجو ادخال رسالة التنبيه التى سوف ترسل للمستخدمين بعد اختيار المنطقة')" oninput="setCustomValidity('')"></textarea>
		</div>
			<label class="control-label col-md-2 col-sm-3" for="comment">رسالة التنبيه:</label>
		<div class="col-md-3 col-sm-4 hide"></div>
    </div>
  <div class="form-group"> 
    <div class="col-md-7  col-sm-9">
      <button type='submit' name="submit" class='btn btn-primary btn-block' style="font-size: 22px;">ارسال الاشعارات</button>
    </div>
      <div class="control-label col-md-2 col-sm-3"> </div>
      <div class="col-md-3 col-sm-4 hide"></div>
  </div>
 </form>
 <?php
 if($mess){}else
 {
	show2("تم ارسال الاشعارات بنجاح");
 }
?>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
<script>
 $(".govern").on("change", function(){
        
        if($(this).val() == -1)
        {
            $(".center").val(-1);
            $(".center").attr("disabled","disabled");
            
            $(".district").val(-1);
            $(".district").attr("disabled","disabled");
        }
        else
        {
            $(".center").removeAttr("disabled");
            $(".center").val(-1);
            $(".district").val(-1);
            $(".center optgroup").css("display","none");
            $(".center optgroup[label = " + $(this).val() + "]").css("display","block");
        }
    });
    
    $(".center").on("change", function(){
        
        if($(this).val() == -1)
        {
            $(".district").val(-1);
            $(".district").attr("disabled","disabled");
        }
        else /*if($(this).val() == $(".govern").val())*/
        {
            $(".district").removeAttr("disabled");
            $(".district").val(-1);
            $(".district optgroup").css("display","none");
            $(".district optgroup[label = " + $(this).val() + "]").css("display","block");
        }
        /*else
        {
            $(".district").val(-1);
            $(".district").attr("disabled","disabled");
        }*/
    });

</script>
</body>
</html>
<?php } 
function show2($m){
if($m!="تم ارسال الاشعارات بنجاح"){
?>
<div> 
	<div class='col-md-7  col-sm-9'>
		<div class='alert alert-danger' style='font-weight:bolder;font-size:20px;'><?php echo $m;?></div>
	</div>
	<div class='control-label col-md-2 col-sm-3'> </div>
	<div class='col-md-3 col-sm-4 hide'></div>
</div>
<?php 
}else{
 ?>
 <div> 
	<div class='col-md-7  col-sm-9'>
		<div class='alert alert-success' style='font-weight:bolder;font-size:20px;'><?php echo $m;?></div>
	</div>
	<div class='control-label col-md-2 col-sm-3'> </div>
	<div class='col-md-3 col-sm-4 hide'></div>
</div>
<?php } }?>