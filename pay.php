<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>دفع الفاتورة</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #3a5b42">

<div class="container">

<div class="page-header">
    <h1 class="text-center" style="color:#fff" >دفع الفاتورة</h1>
</div>

<!-- Credit Card Payment Form - START -->
<?php
	session_start();

	?>
<div class="container">
    <div class="row ">
        <div class="col-xs-12 col-md-4  col-md-offset-4 col-lg-6 col-lg-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <h3 class="text-center">Payment Details</h3>
                        <img class="img-responsive cc-img" src="http://www.prepbootstrap.com/Content/images/shared/misc/creditcardicons.png">
                    </div>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>CARD NUMBER</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Valid Card Number" name="card" id="card" />
                                        <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-group">
                                    <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                    <input type="text" class="form-control" placeholder="DD/MM / YYYY" name="exdate" id="xdate" />
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group">
                                    <label>CV CODE</label>
                                    <input type="text" class="form-control" placeholder="CVC" name="cvcode" id="vcode" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>CARD OWNER</label>
                                    <input type="text" class="form-control" placeholder="Card Owner Names"  name="cowner" id="owner" />
                                </div>
                            </div>
                        </div>
						<input type="hidden" name="s" id="s" value="<?php echo $_GET['s']?>">
						
						  <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>الشهر</label>
										<select class="form-control"  id="mon">
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
                                </div>
                            </div>
                        </div>
						
						  <div class="row">
                        <div class="col-xs-12">
                            <input  onclick="valid()" class="btn btn-warning btn-lg btn-block" type="button" name="pay" id="pay" value="أتمام الدفع" />
							<br>
                        </div>
							  <div class="col-xs-12">
                           <p class="form-control text-center" id="out" style="color:red"></p>
							
                        </div>
                    </div>
                    </form>
                </div>
                <div class="panel-footer">
                  
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .cc-img {
        margin: 0 auto;
    }
</style>
<!-- Credit Card Payment Form - END -->

</div>

	<script>
		function valid(){
	var card=document.getElementById("card").value;
	var xdate=document.getElementById("xdate").value;
		var vcode=document.getElementById("vcode").value;
		var owner=document.getElementById("owner").value;
			var s=document.getElementById("s").value;
				var mon=document.getElementById("mon").value;
	
	var xm=new XMLHttpRequest();
		xm.onreadystatechange=function(){
			if(xm.status==200 && xm.readyState==4){
				document.getElementById("out").innerHTML=xm.responseText;
			}
		}
		xm.open("GET","valid.php?card="+card+"&xdate="+xdate+"&vcode="+vcode+"&owner="+owner+"&s="+s+"&mon="+mon,true);
		xm.send();	
		}
	</script>
</body>
</html>









