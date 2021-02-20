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
    if(isset($_GET['f'])){
        $fr=1;
    }else{
        $fr=0;
    }
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
       
    <a href="insert.php" onclick="w3_close()" class="btn "> ادخال الفاتورة <i class="fa fa-plus-square" aria-hidden="true"></i></a>
    <a href="edit.php" onclick="w3_close()" class="btn active">تعديل الفاتورة <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
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
    <?php
    if(isset($_GET['id'])&&isset($_GET['uid'])){
         $id=$_GET['id'];
        $uid=$_GET['uid'];
         $stmt=$con->prepare("select * from invoice where U_id=? and inv_Id=?");
             $stmt->execute(array($uid,$id));
             $row=$stmt->fetch();
        
              $stmt2=$con->prepare("select * from users where ID=?");
             $stmt2->execute(array($uid));
             $row2=$stmt2->fetch();
    
    
    ?>
    <div class="container-fluid">
 <div class="row">
   <h2>  تعديل الفاتورة للمستخدم  <?php echo $row2['FullName']?></h2>    
 </div>
    <form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
        <div class="form-group">
    <div class="col-md-7  col-sm-9">
      <input type="text" class="form-control" id="social" name="social" value="<?php echo $row2['social_id']?>" placeholder="ادخل الرقم القومي" disabled>
        <input type="hidden" name="id" value="<?php echo $row['inv_Id'] ?>">
    </div>
    <label class="control-label col-md-2 col-sm-3" for="social"> : الرقم القومي للمستخدم</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
   <div class="form-group">
    <div class="col-md-7  col-sm-9">
         <select class="form-control" id="month" name='month' style="font-size: 22px;height: 45px; ">
             <option  value=' ' disabled selected>---</option>
             <?php $val=array('يناير' , 'فبراير','مارس','ابريل','مايو','يونيوا','يوليوا','اغسطس','سبتمبر','اكتوبر','نوفمبر','ديسمبر'); 
             
             for($i=0;$i<12;$i++){
                 echo "<option  value='$i'";
                 if($row['Month']==$i){
                     echo "selected";
                 }
                 echo">$val[$i]</option>";
             }
             ?>
         </select>
    </div>
    <label class="control-label col-md-2 col-sm-3" for="month"> : الشهر</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
  <div class="form-group">
    <div class="col-md-7  col-sm-9">
      <select class="form-control" id="service" name='service' style="font-size: 22px;height: 45px; ">
          <option  value=' ' disabled selected>---</option>
          <?php $val=array('e'=>'الكهرباء','g'=>'الغاز','w'=>'المياء'); 
             
             foreach($val as $key=>$v){
                 echo "<option  value='$key'";
                 if($row['service']==$key){
                     echo "selected";
                 }
                 echo">$v</option>";
             }
             ?>
          
             
         </select>
    </div>
    <label class="control-label col-md-2 col-sm-3" for="service"> : الخدمة</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
  <div class="form-group">
    <div class="col-md-7  col-sm-9">
      <input type="text" class="form-control" id="read" name="read" value="<?php echo $row['meter_reading']?>" placeholder="قراءة العداد" required oninvalid="this.setCustomValidity('الرجاء ادخال قراءة العداد')" oninput="setCustomValidity('')">
        <input type="hidden" class="form-control"  name="fr" value="<?php echo $fr;?>">
    </div>
    <label class="control-label col-md-2 col-sm-3" for="read"> : قراءة العداد</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
  <div class="form-group"> 
    <div class="col-md-7  col-sm-9">
      <input type="submit" class="btn btn-primary btn-block" name="submit" value="تعديل">
    </div>
      <div class="control-label col-md-2 col-sm-3"> </div>
      <div class="col-md-3 col-sm-4 hide"></div>
  </div>
</form>
 <?php
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $err=array();
        
        
        if(!isset($_POST['month'])){
            $err[]='اختار الشهر';
        }
        
        if(!isset($_POST['service'])){
            $err[]='اختار نوع الخدمة';
        }
        if(empty($_POST['read'])){
            $err[]='حقل قراءة العداد فارغ';
        }
        if(!is_numeric($_POST['read'])){
            $err[]=' اادخل القراءة صحيحة ,القراءة ارقام فقط';
        }
        
        if(empty($err)){
            $val=$_POST['read'];
            if($val>=0&&$val<=50){
                $cost=$val*0.13;
            }
            if($val>=50&&$val<=100){
                $cost=50*0.13+($val-50)*0.22;
            }
            if($val>=100&&$val<=200){
                $cost=100*0.22+($val-100)*0.27;
            }
            if($val>=200&&$val<=350){
                $cost=200*0.27+($val-200)*0.55;
            }
            if($val>=350&&$val<=650){
                $cost=350*0.55+($val-350)*0.75;
            }
            if($val>=650&&$val<=1000){
                $cost=650*0.75+($val-200)*1.25;
            }
            if($val>1000){
                $cost=$val*1.35;
            }
            $stmt=$con->prepare("update invoice set Month=?,service=?,meter_reading=?,invoice_admin=?,cost=? where inv_Id=?");
                      $stmt->execute(array($_POST['month'],$_POST['service'],$_POST['read'],$_SESSION['id'],$cost,$_POST['id']));
                      if($stmt){
                           ?>
                             
                              <div class="col-md-7  col-sm-9">
                          <?php echo"<div class='alert alert-success'> تم التعديل بنجاح</div>";?>
                         </div>
                       <div class="control-label col-md-2 col-sm-3"> </div>
                         <div class="col-md-3 col-sm-4 hide"></div> 
                         <?php
                          if($_POST['fr']==1){
                              header( "refresh:3;url=invoice.php");
                            die();
                          }else{
                            header( "refresh:3;url=edit.php");
                            die();
                          }
                      }
            
            
        }if(!empty($err)){
            foreach($err as $r){?>
             <div class="col-md-7  col-sm-9">
             <?php echo"<div class='alert alert-danger'>$r</div>";?>
           </div>
             <div class="control-label col-md-2 col-sm-3"> </div>
            <div class="col-md-3 col-sm-4 hide"></div> <?php
                     if($_POST['fr']==1){
                              header( "refresh:3;url=invoice.php");
                            die();
                          }else{
                            header( "refresh:3;url=edit.php");
                            die();
                          }
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
