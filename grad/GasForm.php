<?php
	ob_start();
	session_start();
	include 'init.php';
	if(isset($_SESSION['username']))
    {
    	$uname=$_SESSION['username'];
    	$id=$_SESSION['userid'] ;
    	$service="الغاز";

    	if($_SERVER['REQUEST_METHOD'] == 'POST')
	    {
	    	$msg = array();
	    	$row1 = $db->getRow("select * from sub where u_id = ? and service= ?", array($id,$service));
	    	if(!empty($row1))
            {
            $msg[] = "<div class='alert alert-danger' dir='rtl'> أنت مشترك بالفعل من قبل</div>";
            }
             else{
	    	    $row = $db->getRow("select * from users where UserName = ?", array($uname));

	    	   $id1=$row['ID'];
	    	   $db->insertRow("insert into sub(u_id,service) values(?, ?)", array($id1,$service));

               $success = "<div class='alert alert-success' dir='rtl'>تم الاشتراك بنجاح</div>";
            }  
	    }
    }
     else
    {
    	header("location: index.php");
    }
 ?>

<!DOCTYPE html>
<html>
<head>
	<!-- Start of  Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=c19d9dcc-731c-4a28-aa46-a8cddd09f7d7"> </script>
<!-- End of  Zendesk Widget script -->
	<meta charset="utf-8">
	<title>Gas Form</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css1/nunito-font.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css1/Gstyle.css"/>
    <!-- BootStrap Links-->
     <link rel="stylesheet" type="text/css" href="css1/bootstrap.min.css">
	 <link rel="stylesheet" type="text/css" href="css1/fontawesome.min.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	  <link rel="stylesheet" type="text/css" href="css1/main.css">
	  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	  <style type="text/css">
	  	.footer {
    padding: 30px 0;
    position: unset;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #343a40;
    color: #f25d5d;
    text-align: center;
}
	  </style>
</head>
<body class="form-v9">
	
	<nav class="navbar navbar-expand-sm bg-dark fixed-top" style="    height: 72px; margin-bottom: -24px;">
	<a class="navbar-brand" style="font-size: 50px; color: white" href="#">الغاز</a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a href="logout.php" class="logout" style="font-size: 26px; margin-left: 150px;color: #007bff " >تسجيل خروج <i class="fa fa-sign-out" aria-hidden="true"></i></a>
    </li>
    
  </ul>
</nav>
<br><br><br>
	<div class="container-fluid">
		<div class="row" style="background-color: #207d8f">
       <img src="images/a22.jpg" class="mx-auto d-block" style="width:100%;height: 200px">
       
   
   


	<div class="page-content">
		
		<div class="form-v9-content" style="background-image: url('images/a23.jpg')">

			<form class="form-detail"  method="post">
				<?php 
				if(isset($msg)) 
                    {
                        foreach($msg as $m)
                        {
                            echo $m;
                        }
                        header("refresh:2; url=index.php");
                    }
				if(isset($success))
                {
                    echo $success;
                    header("refresh:2; url=index.php");
                } ?>
				<h2>الإشتراك في الغاز</h2>
				<div class="form-row-total">
					<div class="form-row">
						الاسم بالكامل<input type="text" name="full-name" id="full-name" class="input-text change-color" placeholder="Your Name"
						 <?php echo "value='".$_SESSION['fullname']."'"; ?> required>
					</div>
					<div class="form-row">
						البريد الالكتروني<input type="text" name="your-email" id="your-email" class="input-text change-color" placeholder="Your Email" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}"  <?php echo "value='". $_SESSION['email']."'"; ?>>
					</div>
				</div>
			
				<div class="form-row-total">
					
					<div class="form-row">
						اسم المستخدم<input type="text" name="username" id="username" class="input-text change-color"  <?php echo "value='".$_SESSION['username']."'"; ?> required>
					</div>
					<div class="form-row">
						رقم التليفون<input type="text" name="phone" id="phone" class="input-text change-color" placeholder="Your Phone" <?php echo "value='".$_SESSION['phone']."'"; ?>required>
					</div>
					
					
				</div>
				<div class="form-row-total">
					<div class="form-row">

						المحافظه<input type="text" name="Govern" id="Govern" class="input-text change-color" placeholder="Your Govern" <?php echo "value='".$_SESSION['govern']."'"; ?>required>
					</div>
					<div class="form-row">
						الرقم القومي<input type="text" name="social_id" id="social_id" class="input-text change-color" placeholder="Your Social Id" <?php echo "value='".$_SESSION['socialid']."'"; ?> required>
					</div>
				</div>
				<div class="form-row-total">
					<div class="form-row">
						الحي<input type="text" name="Center" id="Center" class="input-text change-color" placeholder=" Center"  <?php echo "value='".$_SESSION['center']."'"; ?>required>
					</div>
				</div>
				<div class="form-row-total">
					<div class="form-row" >
						
					اختر ملف	<input type="file" name="filename"  class="input-text change-color" value="choose file"  style="border: none ; background-color: #333c59">
					</div>
					
					
				</div>
				<div class="form-row-last">
					<input type="submit" name="register" class="register" value="Register">
				</div>
			</form>
		</div>
	</div>
	</div>
	</div>
<div class="footer" id="footer" style="padding: 30px 0;">
  <div id="footer_contact" style="text-align: center; text-decoration: none;">
                <p style="text-align: center;">
                    <a href="#">الرئيسية </a>| <a href="#" id="ctl00_A32">
                        البحث فى الموقع </a>| <a href="#" id="ctl00_A33">مواقع مهمة
                        </a>| <a href="#" id="ctl00_A34">خريطة جوجل </a>| <a href="#" id="ctl00_A45" target="_blank">البريد الإلكتروني
                    </a>
                    <br />
                    <br />
                    جميع الحقوق محفوظة &copy; 2019
                    
                    
                </p>
            </div>
            <div class="clear">
         </div>
</div>

	<script type="text/javascript" src="js1/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js1/popper.min.js"></script>
	<script type="text/javascript" src="js1/bootstrap.min.js"></script>
	<script type="text/javascript" src="js1/main.js"></script>
</body>
</html>