<?php
 ob_start();
    $title = 'فاتورة غاز';

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>فاتورة مياه</title>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
<style>
	body{
		padding: 0;
		margin: 0;
	}	
.inquire
{
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
}	
	  .Winquire
{
    background-image: url(back-2.jpg);
	height: 100%;
	width: 100%;
	
}
	.table{
		width: 500px;
	
	}
	.table {
    text-align: right;
    height: 80px;
  direction: rtl
}
	.table td{
		    border: 1px solid #ddd;
	}	
.table th{

    color: white;
 text-align: right;
   background-color: #024148; 
	  border: 1px solid #ddd;
 
}
	.table td{
		    color: white;
 text-align: right;
	}
	.btn-primary{
		width: 80px;
		color: white;
		margin: 20px auto;
	}
	  </style>
<link rel="stylesheet" href="layout/css/bootstrap.min.css">
	<link  rel="stylesheet" href="layout/css/font-awesome.min.css">  
  </head>
  <body>
	  <?php
	  
	   include "include/DBClass.php";
	 
		  $ssid=$_POST['ssid'];
		$month=$_POST['month'];
	  
		  
		 $row=$db->getRow("select * from users , invoice where social_id=$ssid and service='g' and month=$month and U_id=(select ID from users where social_id=$ssid) ");
		$rcount=$db->getCount("select * from users , invoice where social_id=$ssid and service='g' and month=$month and U_id=(select ID from users where social_id=$ssid) ");
	    $m=$row['Month'];
		  $fn=$row['FullName'] ;
		  $g= $row['Govern'] ;
		 $c= $row['Center'];
		  $d=$row['District'];
		  $s=$row['social_id'];
		  $dad=$row['Date'];
		  $red=$row['meter_reading'];
		  $cos=$row['cost'];
		  $pa=$row['Paid'];
		   $p=$cos-2;
	  
	  if($rcount>0){
		
		  echo'
	  <h3 class="text-center">فاتورة غاز</h3>
	  
	<div class="inquire Winquire">
	<table  style="margin:20px auto;    width: 75%;" class="table">";
<tr>
<th>الاسم</th>
<th>الرقم القومى</th> 
<th>المحافظة</th>
<th>المركز</th>
<th>الحى</th> 
 <th>الشهر</th>
<th>قراءة العداد</th> 
<th>التكلفة</th> 
 <th>حالة السداد</th>
<tr>
   
   <tr>
<td>'.$fn.'</td>
<td>'.$ssid.'</td>
<td>'.$g.'</td>
<td>'.$c.'</td> 
<td>'.$d.'</td>  
<td>'.$month.'</td>
<td>'.$red.' م </td>
<td>'.$cos.' ج م </td>
<td>';  if($pa==0){echo"لم يتم الدفع";} else{echo"تم الدفع";} '</td>
</tr>

   
 <table><br><br>

	</div>
		 
	  
	  
  
	
';  }
	  else{
		  echo '  
		<h3 class="text-center">فاتورة غاز</h3>
        <div class="inquire Winquire">
	        <h3 style="color:white" class="text-center">لاتوجد فاتورة لهذا الشهر</h3>
	</div>

        
      ';
	  }
		  
   
	  ob_end_flush(); ?>
	  <script src="layout/js/jquery-3.1.1.min.js"></script>
	  <script src="layout/js/bootstrap.min.js"></script>
  </body>
</html>
