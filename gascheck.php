<?php

$ssid=$_REQUEST['ssid'];

include "include/DBClass.php";
if(strlen($ssid>0)){
$count=$db->getCount("select * from users , invoice where social_id=$ssid and service='g'  and U_id=(select ID from users where social_id=$ssid) ");

if($count >0){
	

//echo"<a href='gas.php?ssid=$ssid'>عرض الفاتورة</a>";	
	echo'
	<form method="post" action="gas.php">
<select class="form-control"  name="month">
    <option   value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
</select>
<input type="hidden" name="ssid" value="'.$ssid.'">
<label style="color:white">اختر الشهر</label><br><br>
<input class="form-control" type="submit" value="عرض الفاتورة">
</form>';
	
}
else{
	echo"الرقم القومى غير صحيح";
}
}
else{
	echo"من فضلك ادخل الرقم القومى";
}


