<html>
    <head>
        <!--<meta http-equiv="refresh" content="60" />!-->
    </head>
<body>
<?php
$page = $_SERVER['PHP_SELF'];
$sec = "60";
date_default_timezone_set('Asia/Colombo');
$time = array("8:15", "9:15", "10:15","11:15","12:15","13:15","14:15","15:15","16:15","17:15");
    $now_time = date("H:i");
    echo $now_time;
    if(in_array($now_time,$time)){
        $now_day = date(l);
        require 'connect.php';
        $query = "SELECT `id` FROM `schedule` WHERE TIME_FORMAT(start_time, '%H:%i') = '$now_time' AND `day` = '$now_day' AND `booked` = 1";
        if($query_run = mysql_query($query)){
                        if(mysql_num_rows($query_run)!=NULL){
                            header("Location: http://192.168.1.100/?on");
                        }else{
                            header("Location: http://192.168.1.100/?off");
                        }
        }
    }
header("Refresh: $sec; url=$page");

    ?>
    </body>
</html>
