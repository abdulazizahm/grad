<?php
    
    ob_start();
    session_start();
    $title = 'الشكاوى';
    include 'init.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $userid     = $_SESSION['userid'];
        $complaint  = $_POST['complaint'];
        $type       = $_POST['type'];
        $service    = $_POST['service'];
        $status     = 0;
        
        $q = "insert into complaints(U_id, Complain, service, type, date, status) values(?, ?, ?, ?, now(), ?);";
        
        $num = $db->insertRow($q, array($userid, $complaint, $service, $type, $status));
        
        if($num > 0)
        {
            $msg = "<div class='alert alert-success' dir='rtl'>تم ارسال الشكوى بنجاح.</div>";
        }
    }

?>
<!-- chat Script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=c19d9dcc-731c-4a28-aa46-a8cddd09f7d7"> </script>

<div class="complain">
    <div class="">
        <div class="container">

            <form class="center-block" method="post">
                
                <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($msg)) { echo $msg; } ?>
                
                <h1 class="text-center">خدمة الشكاوى</h1>
                
                <label style="margin-bottom: 15px; color: red; float: right" dir="rtl">اختيار نوع الشكوى :- </label><br><br>
                <div class="form-group">
                    <label style="margin-left: 20px; float: right" dir="rtl"> سوء خدمة
                        <input type="radio" name="type" value="bad_service">
                    </label>

                    <label dir="rtl" style="float: right"> تعطل فى الخدمة
                        <input type="radio" name="type" value="service_failure">
                    </label><br>
                </div>
                    
                <label style="margin: 15px 0; color: red; float:right" dir="rtl">أكتب الشكوى :- </label>
                <textarea class="form-control" rows="10" style="margin-bottom: 20px" name="complaint"></textarea>
                
                <input type="hidden" value="<?php echo $_GET['service'] ?>" name="service">
                
                <input type="submit" value="إرسال" class="form-control center-block">
                
            </form>
            
        </div>
    </div>
</div>

<?php

    include "$tpl/footer.php";
    ob_end_flush();

?>