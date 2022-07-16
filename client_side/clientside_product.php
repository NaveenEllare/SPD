<?php 
include('header.php');

$catid='';
if(isset($_GET['cat']) && $_GET['cat']!='') {
	$catid = get_safe_value($con,$_GET['cat']);
}

if(isset($_POST['add_to_cart'])) {
	$qty = get_safe_value($con, $_POST['qty']);
	$pid = get_safe_value($con, $_POST['pid']);
	$cid= $_SESSION['id'];
	$product = mysqli_query($con, "select * from product where id ='$pid'");
	while($row= mysqli_fetch_assoc($product)){
		$name = $row['name'];
		$price = $row['price'];
	}

	$prod =  mysqli_query($con, "select * from cart where product_id ='$pid'");
	$check = mysqli_num_rows($prod);
	if($check >0){
		echo '<script>alert("product already exists in the cart")</script>';
	} else {
		$cart = mysqli_query($con, "insert into cart (client_id,product_id,prod_name,quantity,price) values('$cid','$pid','$name','$qty','$price')");
		header('location:cart.php');
		die();
	}
	
}

?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>

			<link rel="stylesheet" href="../css/client_product.css">
	
		<title> Shopping Cart</title>
</head>
<body>
<?php
	$prod = "SELECT *, product.id as pid FROM `product` INNER JOIN categories on product.categories_id = categories.id where product.status=1 and categories.status=1 ";
	if($catid != '') {
		$prod .= " and product.categories_id='$catid'";
	}
	$result = mysqli_query($con, $prod);
	if(mysqli_num_rows($result) > 0)
	{
?>
						
<div class = "products">
    <div class = "container">
		
	<h1 class = "lg-title">Popular Products</h1>
	<p class = "text-light">“The art of medicine consists of amusing the patient while nature cures the disease.” <n>"One quantity means one Box "</p>
	<div class = "product-items">
	<?php
		while($row = mysqli_fetch_array($result))
		{
	?>
                    <!--product 1-->
                    <div class = "product">
                        <div class = "product-content">
						<form method="post">
                            <div class = "product-img">
							<img src="../image/<?php echo $row["image"]; ?>" alt="product-img">
                            </div>
                            <div class = "product-btns">
							<input type="submit" name="add_to_cart" class = "btn-cart" value="add_to_cart">
                            </div>
                        </div>
                        <div class = "product-info">
                            <div class = "product-info-top">
                                <h2 class = "sm-title"><?php echo $row["name"];?></h2>
                                <div class = "rating">
                                    <span><i class = "fas fa-star"></i></span>
                                    <span><i class = "fas fa-star"></i></span>
                                    <span><i class = "fas fa-star"></i></span>
                                    <span><i class = "fas fa-star"></i></span>
                                    <span><i class = "far fa-star"></i></span>
                                </div>
                            </div>
                            <a href = "#" class = "product-name"> <?php echo $row["short_desc"]; ?></a>
                            <p class = "product-price">₹<?php echo $row["mrp"]; ?></p>
                            <p class = "product-price">₹<?php echo $row["price"]; ?></p>
							<input type="hidden" name="pid" id="pid" value="<?php echo $row["pid"]; ?>" />
							<h2 class = "sm-title">QTY  <input type="number" id="qty" name="qty" min="1" max="10" class="form-control" required/></h2>
                        </div>
                        </form>
                    </div>
					<?php
					}?>
				</div>
			</div>
		</div>

<?php		
}else {
	echo "<h1 style='color:red;'><center>Currently out of stock!</h1></center>";
}
?>	
<div class = "product-collection">
            <div class = "container">
                <div class = "product-collection-wrapper">
                    <!-- product col left -->
                    <div class = "product-col-left flex">
                        <div class = "product-col-content">
                            <h2 class = "sm-title">AYURVEDIC </h2>
                            <h2 class = "md-title"> Homeopathic Products </h2>
                            <p class = "text-light">The most inestimable treasures are: impeccable consciousness and good health. Love to God and sef study provide one; homeopathy provides the other.
                                 – The sole and raised mission of the doctor is to restablish the health of the sick, which is called cure.</p>
								 <a href="clientside_product.php"><button type = "button" class = "btn-dark">Shop now</button></a>
                        </div>
                    </div>

                    <!-- product col right -->
                    <div class = "product-col-right">
                        <div class = "product-col-r-top flex">
                            <div class = "product-col-content">
                                <h2 class = "sm-title">Cosmetics </h2>
                                <h2 class = "md-title">Natural cosmetic products</h2>
                                <p class = "text-light">It is just as important<br> 
                                                        what you put on your skin<br>
                                                        as what you put in your body
                                </p>
                               <a href="clientside_product.php"> <button type = "button" class = "btn-dark">Shop now</button></a>
                            </div>
                        </div>

                        <div class = "product-col-r-bottom">
                            <!-- left -->
                            <div class = "flex">
                                <div class = "product-col-content">
                                    <h2 class = "sm-title">Moonsoon sale </h2>
                                    <h2 class = "md-title">Extra 10% Off </h2>
                                    <p class = "text-light"></p> The SPD Team is pleased to announce an exciting new event: a special lunar-themed LAND Sale event, starting on Thursday, June 4th (a day before the full moon) at 1PM GMT (09:00AM Eastern Standard Time).</p>
									<a href="clientside_product.php"> <button type = "button" class = "btn-dark">Shop now</button></a>
                                </div>
                            </div>
                            <!-- right -->
                            <div class = "flex">
                                <div class = "product-col-content">
                                    <h2 class = "sm-title"> News </h2>
                                    <h2 class = "md-title"> Top client </h2>
                                    <p class = "text-light">The one who purchase more produts are honered as our top priority client</p>
                                    <a href="myaccount.php"><button type = "button" class = "btn-dark">View orders</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
			</body>
</html>

