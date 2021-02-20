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
<title>تعديل الفاتورة</title>
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
<div class="container-fluid">
 <div class="row">
   <h2>تعديل الفاتورة</h2>    
 </div>
    <form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
  <div class="form-group">
      <div class="col-md-1  col-sm-2">
          <button type="submit" class="btn btn-primary btn-block search" ><i class="fa fa-search" aria-hidden="true"></i></button>
      </div>
    <div class="col-md-6  col-sm-7">
      <input type="text" class="form-control once" id="social" name="social" placeholder="ادخل الرقم القومي" required oninvalid="this.setCustomValidity('الرجاء ادخال الرقم القومي')" oninput="setCustomValidity('')">
    </div>
    <label class="control-label col-md-2 col-sm-3" for="social"> :بحث بالرقم القومي</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
   
</form>
 <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $err=array();
        $social=$_POST['social'];
        if(empty($social)){
            $err[]='حقل الرقم القومي فارغ' ;
        }
        if(!preg_match("/[0-9]{14}/", $social)) 
       {
          $err[] = ' الرقم القومى غير صالح ادخل 14 رقم ';
       }
        if(preg_match("/[0-9]{14}/", $social)){
            
            $stmt=$con->prepare("select * from users where social_id=?");
                    $stmt->execute(array($social));
                    $row=$stmt->fetch();
                    if(empty($row['ID'])){
                        $err[]=' الرقم القومي غير موجود '.$social;
                        
                    }else{
                           ?>
                             
                            <div class="col-md-9 col-sm-12">
                              <table class="table table-striped  table-responsive" border="1">
                                  <thead>
                                    <tr>
                                       <th scope="col"> التعديل او الحذف</th>
                                      <th scope="col">الشهر</th>
                                      <th scope="col">نوع الخدمة</th>
                                      <th scope="col">قراءة العداد</th>
                                        <th scope="col">التكلفة</th>
                                        <th scope="col">الدفع</th>
                                        <th scope="col"> اسم المستخدم </th>
                                        <th scope="col"> الرقم القومي </th>
                                       
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                     
                                             $stmt=$con->prepare("select * from invoice where U_id =?");
                                             $stmt->execute(array($row['ID']));
                                             $rows=$stmt->fetchAll();
                        
                                   //echo date("d");
                        
                                    foreach($rows as $r){
                                     ?>
                                         <tr>
                                          <td><a href="edit2.php?uid=<?php echo $r['U_id'] . "&id=" . $r['inv_Id'];?>"  class="btn btn-success suc">تعديل الفاتورة <i class="fa fa-pencil-square-o" ></i></a><a href="edit.php?id=<?php echo $r['inv_Id'];?>"  class="btn btn-danger suc" style="margin:5px;">حذف الفاتورة <i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                         <td><?php $val=array('يناير' , 'فبراير','مارس','ابريل','مايو','يونيوا','يوليوا','اغسطس','سبتمبر','اكتوبر','نوفمبر','ديسمبر'); echo $val[$r['Month']] ?></td>
                                         <td><?php $val=array('e'=>'الكهرباء','g'=>'الغاز','w'=>'المياء'); echo $val[$r['service']] ?></td>
                                         <td><?php echo $r['meter_reading'] ?></td>
                                         <td><?php echo $r['cost'] ?></td>
                                         <td><?php echo $r['Paid'] ?></td>
                                         <td><?php echo $row['FullName'] ?></td>  
                                          <td><?php echo $social ?></td>
                                             
                                       </tr>
                                     <?php } ?>
                                  </tbody>
                             </table>
                           </div>
                           
                           <div class="col-md-3 col-sm-4 hide"></div>
                          <?php
                       
                    }
        }
            
        if(!empty($err)){
            foreach($err as $r){?>
              <div class="col-md-1  col-sm-2"></div>
             <div class="col-md-6  col-sm-7">
             <?php echo"<div class='alert alert-danger'>$r</div>";?>
           </div>
             <div class="control-label col-md-2 col-sm-3"> </div>
            <div class="col-md-3 col-sm-4 hide"></div> <?php
            }
            
        }
    }
    if(isset($_GET['id'])){
         $stmt=$con->prepare("delete from invoice  where inv_Id=?");
                      $stmt->execute(array($_GET['id']));
                      if($stmt){
                           ?>
                              <div class="col-md-7  col-sm-9">
                          <?php echo"<div class='alert alert-success'> تم الحذف بنجاح</div>";?>
                         </div>
                       <div class="control-label col-md-2 col-sm-3"> </div>
                         <div class="col-md-3 col-sm-4 hide"></div> 
                         <?php
                          // header( "refresh:3;url=edit.php");
                          // die();    
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
