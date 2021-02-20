<?php
$card=$_REQUEST['card'];
$xdate=$_REQUEST['xdate'];
$vcode=$_REQUEST['vcode'];
$owner=$_REQUEST['owner'];
$s=$_REQUEST['s'];
$mon=$_REQUEST['mon'];
include "include/DBClass.php";
session_start();
$id=isset($_SESSION['userid'])?$_SESSION['userid']:0;

try{
$v=$db->getRow("select * from invoice ,users where ID=U_id and ID=? and service=? and Month=? ",[$id,$s,$mon]);
$row=$db->getRow("select * from vbank where c_num=$card ");
$xxx=$db->getCount("select * from vbank where c_num=$card ");
$xc=$db->getCount("select cost from invoice, users where ID=U_id and ID=? and service=? and Month=? ",[$id,$s,$mon]);
	$wrow=$db->getRow("select cost from invoice, users where ID=U_id and ID=? and service=? and Month=? ",[$id,$s,$mon]);
$c=$wrow['cost'];		
if(strlen($card)!=16){
	echo"رقم الكارت يجب ان يكون 16 رقم";
}	
elseif(strlen($vcode)!=3){
	echo" الكود يجب أن يكون 3 ارقام ";
}	
elseif(strlen($xdate) >10 || strlen($xdate) < 8   ){
	echo"من فضلك ادخل تاريخ صحيح";
}	
else{	
if($xxx==0){
	echo"رقم الكارت غير مطابق لاى حساب بنكى";
}
else{
	
if($vcode!=$row['cvc'] ){
	echo" الكود غير متطابق مع هذا الحساب   ";
}	
elseif($xdate!=$row['exdate']){
	echo"تاريخ الانتهاء غير صحيح";
}	
elseif($owner!=$row['c_owner'] ){
	echo"اسم المالك غير صحيح";
}	
	
else{
if($xc > 0){
	if($v['Paid']==0){
	if($vcode==$row['cvc'] && $owner==$row['c_owner'] && $xdate==$row['exdate'] && (intval($row['count']) >= intval($c)) ){
	
$service=$s;

$db->updateRow("update invoice set Paid=? where U_id=? and service=? and Month=?" ,[1,$id,$service,$mon]);	
echo"<p style='color:green'>تم الدفع بنجاح</p>";	


$ncount=intval($row['count'])-intval($c);	
$r=$db->updateRow("update vbank set count=? where c_num=?",[$ncount,$card]);	
	
}
	
elseif($vcode==$row['cvc'] && $owner==$row['c_owner'] && $xdate==$row['exdate'] && (intval($row['count']) < intval($c)) ){
	echo"!الرصيد البنكى لايكفى";
}

else{
	echo"<p style='color:green'>!عفوا بيانات الدفع غير صحيحة  </p>";
}	
	}
	else{
	echo"!تم دفع الفاتورة مسبقا";
}
}
else{echo "لا توجد فاتورة لهذا الشهر";
}
}	
	
}

}
}	
	
	

catch(Exception $e){
	echo"!من فضلك ادخل الحقول صحيحة";
}