<?php
    
function compl(){
    global $con;
    $stmt=$con->prepare("select count(*) from complaints where status=0");
    $stmt->execute();
    $row=$stmt->fetch();
   return $row[0];
                    
}

?>