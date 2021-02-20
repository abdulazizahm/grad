<!--
<?php
if (!isset($_SESSION)) { session_start(); 
                      // $aly="my save you";
                       }
?>
-->
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <style>
        #map-canvas {
            height: 800px;
            width: 1000px;
            background-color: #6495ed;
            display: block;
            margin: auto;
            /*margin-top: 200px;*/
        }
    </style>
    <script type="text/javascript" src="aly/jquery.min.js"></script>
    <script type="text/javascript" src="aly/modernizr.min.js"></script>
    <!--
    <script type="text/javascript" src="aly/js.js"></script>
    <script type="text/javascript" src="aly/new.js"></script>
-->
</head>

<body>
    <?php
include"connect.php";
//echo $_SESSION['username'];
$stmt=$con->prepare("SELECT * from location3,users WHERE service=? and name=(select Center from users where UserName=?) LIMIT 1");
     $stmt->execute(array($_GET['s'],$_SESSION['username']));
     $row=$stmt->fetch();

if ($row>0) {
  
    // output data of each row
         // echo "longt: " . $row["longt"]. "   lat: " . $row["lat"]. "<br>". "   name: " . $row["name"]. "<br>". "   company name: " . $row["company_name"]. "<br>". "   lat: " . $row["lat"]. "<br>";
    echo '<div id="map-canvas" data-geocode="'. $row["longt"].', '. $row["lat"].'"> </div>';
    // echo '<div id="hiden" style="display: none;">'.$row["company_name"].'</div>';//
          $com= $row["company_name"];
 }
    else {
    echo "0 results";
}  
    //mysqli_close($conn);
    ?>
    <!--
    <h1 style="font-weight:50px;color:red;">
        <?php // echo $com ; ?>
    </h1>
-->
    <script>
        var map;

        function initMap() {
            $("#map-canvas").show();
            // var div = document.getElementById("hiden");
            //  var company_name = div.textContent;
            console.log("Type Of Google: " + typeof google);
            console.log("<?php  echo $_SESSION['username']; ?>");
            console.log("<?php  echo $_GET['s']; ?>");
            // console.log("<?php  echo $row["company_name"]; ?>");
            console.log("<?php echo $com ; ?>");
            var geocodeString = $("#map-canvas").data("geocode");
            var geocode = geocodeString.split(',');
            var myLatlng = new google.maps.LatLng(parseFloat(geocode[0]), parseFloat(geocode[1]));
            // console.log(parseFloat(geocode[0]), parseFloat(geocode[1]);
            var myOptions = {
                zoom: 18,
                center: myLatlng,
                mapTypeControl: true,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                },
                navigationControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            }

            var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: "<?php  echo $com; ?> "
            });
            marker.setMap(map);
        }

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDK5PWaQ18mE7IJL4l-0XXfgoNBrz7rGXE&callback=initMap">
    </script>

    <!--    

    <div id="map-canvas" data-geocode="27.549555, 30.813438"> </div>

  -->
</body>

</html>
