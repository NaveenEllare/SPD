<?php
$startdate = "1-october-2021";
$expire = strtotime($startdate. ' + 15 days');
$today = strtotime("today midnight");

if($today >= $expire){
    echo "expired";
} else {
    echo "active";
}
?>
