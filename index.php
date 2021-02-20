<?php
    
    ob_start();
    session_start();
    $title = 'الرئيسية';
    include 'init.php';

?>
<!-- chat Script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=c19d9dcc-731c-4a28-aa46-a8cddd09f7d7"> </script>

<div class="index">
    <div class="overlay">
    
    <div class="container">
        <div class="reglog">
            <div class="row">
                
                <?php 
                    
                    if(!isset($_SESSION['userid']))
                    {
                
                ?>
                
                <div class="col-xs-6">
                    <a class="btn btn-default center-block reg" href="signup.php" role="button"><i class="fa fa-edit fa-x" style="color:white; margin-right:3px"></i>التسجيل</a>
                </div>
                <div class="col-xs-6">
                    <a class="btn btn-default center-block log" href="login.php" role="button"><i class="fa fa-edit fa-x" style="color:white; margin-right:3px"></i>تسجيل الدخول</a>
                </div>
                
                <?php
                    }
                
                    else
                    {
                ?>
                        <div class="col-xs-12 center-block">
                            <a class="btn btn-default center-block logout" href="logout.php" role="button"><i class="fa fa-edit fa-x" style="color:white; margin-right:3px"></i>تسجيل الخروج</a>
                        </div>
                <?php
                    }
                ?>
                
            </div>
        </div>

        <div class="services">
            <div class="row">
                <div class="col-xs-4">
                    <div class="serv center-block">
                        <div class="logo center-block">
                            <img src="layout/images/water.jpg" class="img-responsive">
                        </div>
                        <a href="water-main.php" class="center-block text-center homepage">الصفحة الرئيسية</a>
                        <div class="functions">
                            <ul dir="rtl">
								
                                <li><a href="inquireinvoicewater.php">الاستعلام عن الفاتورة</a></li>
								<li><a href="pay.php?s=w">دفع الفاتورة</a></li>
                                <li><a href="#">تقييم الخدمة</a></li>
                                <li><a href="complaints.php?service=water">تقديم شكوى</a></li>
                                <li><a href="new.php?s=w">إظهار الأفرع</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="serv center-block">
                        <div class="logo center-block">
                            <img src="layout/images/gas.jpg" class="img-responsive">
                        </div>
                        <a href="gas-main.php" class="center-block text-center homepage">الصفحة الرئيسية </a>
                        <div class="functions">
                            <ul dir="rtl">
							
                                <li><a href="inquireinvoicegas.php">الاستعلام عن الفاتورة</a></li>
								 <li><a href="pay.php?s=g">دفع الفاتورة</a></li>
                                <li><a href="#">تقييم الخدمة</a></li>
                                <li><a href="complaints.php?service=gas">تقديم شكوى</a></li>
                                <li><a href="new.php?s=g">إظهار الأفرع</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="serv center-block">
                        <div class="logo center-block">
                            <img src="layout/images/elec.jpg" class="img-responsive">
                        </div>
                        <a href="electricity-main.php" class="center-block text-center homepage">الصفحة الرئيسية </a>
                        <div class="functions">
                            <ul dir="rtl">
							
                                <li><a href="inquireinvoiceelec.php">الاستعلام عن الفاتورة</a></li>
								<li><a href="pay.php?s=e">دفع الفاتورة</a></li>
                                <li><a href="">تقييم الخدمة</a></li>
                                <li><a href="complaints.php?service=electricity">تقديم شكوى</a></li>
                                <li><a href="new.php?s=e">إظهار الأفرع</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    
    </div>   
</div>


<?php

    include "$tpl/footer.php";
    ob_end_flush();

?>