<?php
require('../dbconnection/connection.inc.php');
require('../functions.inc.php');
$userId = $_SESSION['id'];   
$query = "SELECT * FROM users where id=$userId";
$result = mysqli_query($con, $query);
$res=mysqli_fetch_assoc($result);

$cat = mysqli_query($con, "SELECT * FROM `categories` WHERE status=1");
?>
<html>
  <head>
    <title>web page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/home_page.css">
     <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
  </head>
 <body>
  <div class="banner">
    <div class="navbar">
      <img src="../image/logo3.png"class="Logo">
          <ul>
            <li><a href="home_page.php"><i class="fa fa-home"></i>HOME</a></li>
              <div class="dropdown">
                <button class="dropbtn">Category<i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">      
                  <?php while($row=mysqli_fetch_assoc($cat)) {
                    $catid = $row['id'];
                  ?>
                  <a href="<?php echo 'clientside_product.php?cat='.$catid;?>"><?php echo $row['categories'] ?></a>
                  <?php }?>
                </div>
              </div>           
            <li><a href="../client_side/clientside_product.php"><i class="fa fa-product-hunt" aria-hidden="true"></i></i>PRODUCTS</a></li>

            <li><a href="whyus.php"><i class="fa fa-clone"></i>WHY US?</a></li>

            <li><a href="myaccount.php?id=<?php echo $_SESSION['id'] ?> "><i class="fa fa-user"></i>MY ACCOUNT</a></li>

           <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn">welcome <?php echo $res['name']?></button>
                <div id="myDropdown" class="dropdown-content">
                      <a href="client_logout.php">Logout</a>
           </div>
                </div>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

          </ul>
        </div>
        <div class="content">
          <h1>Welcome to SPD</h1>
          <p>We keep the Essentials in Stock</p>
          <p>personalized By Our Experts.</p>
          <p>live simple live free </p>
        </div>
        </div>
       
       <?php include ('footer.php'); ?>
</body>
</html>
