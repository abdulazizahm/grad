<?php function show($in=array()){?>
	  <div class="col-md-9 col-sm-12">
		<table class="table table-responsive table-striped" border="1">
          <thead>
            <tr>
                <th scope="col">حذف</th>
                <th scope="col">الكهرباء</th>
                <th scope="col">المياه</th>
                <th scope="col">الغاز</th>
                <th scope="col">الايميل</th>
                <th scope="col">رقم التليفون</th>
                <th scope="col">الرقم القومي</th>
                <th scope="col">الاسم بالكامل</th>
            </tr>
          </thead>
          <tbody>
              <?php
            if(count($in))
            {
            foreach($in as $r){
             ?>
                 <tr>
                  <td><a href="user.php?id=<?php echo $r['ID'];?>"  class="btn btn-danger suc">حذف المستخدم <i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                 <?php if($r['Electricity']==1){
                      echo "<td>مشترك</td>";
                  }else{
                      echo "<td> غير مشترك</td>";
                   } ?>
                     <?php if($r['Water']==1){
                      echo "<td>مشترك</td>";
                  }else{
                      echo "<td> غير مشترك</td>";
                   } ?>
                    <?php if($r['Gas']==1){
                      echo "<td>مشترك</td>";
                  }else{
                      echo "<td> غير مشترك</td>";
                   } ?>
                     
                 <td><?php echo $r['Email'] ?></td>
                 <td><?php echo $r['Phone'] ?></td>
                 <td><?php echo $r['social_id'] ?></td>  
                  <td><?php echo $r['FullName'] ?></td>

               </tr>
             <?php }
            }else{echo "<tr><td colspan='5'>لا يوجد مستخدمون بهذه المنطقة</td></tr>";} ?>
          </tbody>
     </table>
	  <a href="index.php" class="btn btn-primary" style="font-size: 20px;font-weight: bold;width:100px;"> السابقة</a>
   </div>
    <?php 
    }
?>


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
else
{
?>
      
<title>ادخال الفاتورة</title>
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
    <a href="insert.php" onclick="w3_close()" class="btn active"> ادخال الفاتورة <i class="fa fa-plus-square" aria-hidden="true"></i></a>
    <a href="edit.php" onclick="w3_close()" class="btn ">تعديل الفاتورة <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
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
<div class="container-fluid">
 <div class="row">
   <h2>ادخال الفاتورة</h2>    
 </div>
    
  
    
    <form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">


 
    <div class="form-group">
    <div class="col-md-7  col-sm-9">
      <select class="form-control govern" id="govern" name="govern"  style="font-size: 22px;height: 45px; " >
            <option value="-1" hidden selected >اختار المحافظة</option>

            <?php
              $stmt=$con->prepare("select * from govern");
             $stmt->execute();
              $rows_govern=$stmt->fetchAll();

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
    <label class="control-label col-md-2 col-sm-3" for="govern"> : المحافظة</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
              
 <div class="form-group">
    <div class="col-md-7  col-sm-9">
  
            <select class="form-control center" name="center" id="center" disabled="disabled"  style="font-size: 22px;height: 45px; ">
        <option value="-1" hidden selected >اختار المركز</option>

        <?php

            foreach($rows_govern as $row_govern)
            {
                echo "<optgroup label='$row_govern[1]' style='display:none'>";
                    $stmt=$con->prepare("select * from centers where govern_id = ?");
                      $stmt->execute(array($row_govern[0]));
                     $rows_centers=$stmt->fetchAll();
                    foreach($rows_centers as $row_centers)
                    {
                        echo "<option value='$row_centers[1]'>$row_centers[1]</option>";
                    }

                echo "</optgroup>";
            }

        ?>

    </select>
    </div>
    <label class="control-label col-md-2 col-sm-3" for="center"> : المركز</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
              
    <div class="form-group">
    <div class="col-md-7  col-sm-9">
    <select class="form-control district" name="district"  id="district" disabled="disabled"  style="font-size: 22px;height: 45px;">
    <option value="-1" hidden selected >اختار المنطقة </option>

    <?php

        foreach($rows_govern as $row_govern)
        {
		    //echo "<optgroup label='$row_govern[1]' style='display:none'>";
            $stmt=$con->prepare("select * from centers where govern_id = ?");
            $stmt->execute(array($row_govern[0]));
            $rows_centers=$stmt->fetchAll();
		    foreach($rows_centers as $row_centers)
		    {
				echo "<optgroup label='$row_centers[1]' style='display:none'>";
				$stmt=$con->prepare("select * from districts where govern_id =? and center_id=?;");
				$stmt->execute(array($row_govern[0],$row_centers[0]));
				$rows_districts=$stmt->fetchAll();
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
    <label class="control-label col-md-2 col-sm-3" for="district"> : المنطقة</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
          
  <div class="form-group"> 
    <div class="col-md-7  col-sm-9">
      <input type="submit" class="btn btn-primary btn-block" name="submit" value="عرض">
    </div>
      <div class="control-label col-md-2 col-sm-3"> </div>
      <div class="col-md-3 col-sm-4 hide"></div>
  </div>
</form>
<?php
    if(isset($_GET['id'])){
         $stmt=$con->prepare("delete from users  where ID=?");
         $stmt->execute(array($_GET['id']));
         if($stmt){
               ?>
              <div class="col-md-7  col-sm-9">
              <div class='alert alert-success'> تم الحذف بنجاح</div>
              </div>
              <div class="control-label col-md-2 col-sm-3"> </div>
             <div class="col-md-3 col-sm-4 hide"></div> 
             <?php
    }
    }
    if($_SERVER["REQUEST_METHOD"]=="POST")
	{
        $govern=$_POST['govern'];
		if($govern!=-1)
		{
			$center=$_POST["center"];
			if($center!=-1)
			{
				$district=$_POST["district"];
				if($district!=-1)
				{
                    $stmt=$con->prepare("select * from users where Govern=? and Center=? and District=?");
                    $stmt->execute(array($govern,$center,$district));
                    $rows=$stmt->fetchAll();
                    show($rows);
				}else
				{
                    $stmt=$con->prepare("select * from users where Govern=? and Center=?");
                    $stmt->execute(array($govern,$center));
                    $rows=$stmt->fetchAll();
                    show($rows);
				}
			}else
			{
				$stmt=$con->prepare("select * from users where Govern=?");
				$stmt->execute(array($govern));
				$rows=$stmt->fetchAll();
				show($rows);
			}	
		}
        else
		{
            $stmt=$con->prepare("select * from users");
            $stmt->execute();
			$rows=$stmt->fetchAll();
            show($rows);
        }  
    }else
		{
            $stmt=$con->prepare("select * from users");
            $stmt->execute();
			$rows=$stmt->fetchAll();
            show($rows);
        } 
        
ob_end_flush();
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
<?php }?>


