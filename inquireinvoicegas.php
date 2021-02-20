<?php
    
    ob_start();
    $title = 'Inquire Invoice';
    include 'init.php';

?>
<!-- chat Script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=c19d9dcc-731c-4a28-aa46-a8cddd09f7d7"> </script>

<div class="inquire Ginquire">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 socialid">
                <h1>الاستعلام عن الفاتورة</h1>
                <p>ادخل الرقم القومي</p>

                   <div class="form-inline">
                    <div class="form-group">
                        <input type="number" class="form-control" name="ssid" id="ssid">
                    </div>
                    <input type="button" value="الاستعلام عن الفاتورة" name="inquiry" onclick="inq()">
					<div style="color:red" id="pr"></div>
				</div>
            </div>
            
            <div class="col-xs-6 logo">
               <img src="layout/images/gas2.png" alt="bulb" class="img-responsive" style="margin-top:60px; height:550px">
            </div>
        </div>
    </div>
</div>
<script>
function inq(){
	var ssid=document.getElementById("ssid").value;
var xm=new XMLHttpRequest();
		xm.onreadystatechange=function(){
			if(xm.status==200 && xm.readyState==4){
				document.getElementById("pr").innerHTML=xm.responseText;
			}
		}
		xm.open("GET","gascheck.php?ssid="+ssid,true);
		xm.send();	
		}
</script>
<?php

    include "$tpl/footer.php";
    ob_end_flush();

?>