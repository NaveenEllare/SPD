<?php
    require("header.php");
    echo "<h1 class='noprod'>THANK YOU FOR ORDERING WITH US<br> <a href='home_page.php' class='link'>Click here to go to Home page</a></h1>";
    echo "<p>&nbsp&nbsp&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thank you for purchasing with us....<br> we Tean SPD will deliver your product within 24 hurs    </p>";
?>

<style>
    body{

        width: 100%;
  height: 100vh;
  background-image:linear-gradient(rgba(0, 0, 0, 0.685),rgba(0, 0, 0, 0.521)),url(../image/thankyou_bg.jpg) ;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
    }
.noprod 
{
    color: whitesmoke;
    text-align: center;
    margin: 100px;
}

.noprod .link 
{
    color: #f89602;
}
p
{
    font-size: 25px;
    color: whitesmoke;
    position: absolute;
    bottom: 10%;
    left: 32%;

}
</style>