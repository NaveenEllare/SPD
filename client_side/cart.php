<?php
		require('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../css/cartstyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
</head>
<body>
<?php 
		$total =0;

		if(isset($_GET['type']) && $_GET['type'] !='') 
		{
			$id =get_safe_value($con,$_GET['id']);
			if($_GET['type'] == 'delete') 
			{
				$delete = "delete from cart where product_id='$id'";
        		mysqli_query($con,$delete);
			}
		}
		$uid = $_SESSION['id'];
		$cart= mysqli_query($con,"SELECT * FROM CART INNER JOIN product on cart.product_id = product.id where client_id='$uid'");
		$check = mysqli_num_rows($cart);
		
?>
<?php if($check >0) {?>
<div class="main">
  <table>
    <tr>
      <th colspan="5" class="center-heading">Cart</th>
    </tr>
    <tr>
      <th>Name</th>
	  <th>image</th>
      <th>Quantity</th>
      <th>Price</th>
	  <th>Delivery charge</th>
      <th>Total</th>
    </tr>
    <?php 
		while($row = mysqli_fetch_assoc($cart)){
	?>
	<tr>
		<td><?php echo $row['name'];?></td>
		<td><img style="height: 80px; width:100px;" src="../image/<?php echo $row['image']?>"></td>
		<td><?php echo $row['quantity'];?></td>
		<td><?php echo $row['price'];?></td>
		<td>0.0</td>
		<td ><?php echo $row['quantity'] * $row['price'];?></td>
		<td><?php echo "<button class='btn-delete'><a href='?type=delete&id=".$row['id']."'>Remove</a></button>&nbsp;";?></td>
	</tr>
	<?php
	$total +=$row['quantity'] * $row['price'];
	} ?>

	<tr>
		<td colspan="4"style="color:red;"><b>Total Amount</b></td>
		<td style="color:red;"><b><?php echo $total; ?></b></td>
	</tr>
	<tr>
	<td colspan="4">
			<a href="placeorder.php"><button class="button">Place Order</button></a>
	</td>

	</tr>
</table>  
</div>
<?php } else {
	
	echo "<script>
	alert('There are no products in the cart');
	window.location.href='clientside_product.php';
	</script>";
	
	}
?>
