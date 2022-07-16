<?php 
    require('header.php');
    
    $total=0;
    $addr='';
// to remove the cart item
    if(isset($_GET['type']) && $_GET['type'] !='') 
    {
			$id =get_safe_value($con,$_GET['id']);
			if($_GET['type'] == 'delete') 
			{
				$delete = "delete from cart where product_id='$id'";
        		mysqli_query($con,$delete);
			}
	}

    $uid=$_SESSION['id'];
    $cart= mysqli_query($con,"SELECT * FROM CART INNER JOIN product on cart.product_id = product.id where client_id='$uid'");
	$check = mysqli_num_rows($cart);

    //to get user address
    $user = mysqli_query($con,"select address from users where id='$uid'");
    $row = mysqli_fetch_assoc($user);
    $addr = $row['address'];

//adding details in oder table
    if(isset($_GET['operation']) && $_GET['operation'] !='') 
    {
        if($_GET['operation'] == 'confirm') {
            
            $cart= mysqli_query($con,"SELECT * FROM CART INNER JOIN product on cart.product_id = product.id where client_id='$uid'");
            while($row = mysqli_fetch_assoc($cart)) {
                $total += $row['quantity'] * $row['price'];
                $pid = $row['product_id'];
                $quantity = mysqli_query($con,"SELECT id,qty FROM product INNER JOIN cart on product.id=cart.product_id where client_id='$uid' and id='$pid'");
                while($list = mysqli_fetch_assoc($quantity)) {
                    if($list['qty']>0) {
                        $q = $list['qty'];
                        $q -=$row['quantity'];
                        if($q>0){
                        $up = mysqli_query($con,"update product set qty='$q' where id='$pid'");
                        } else {
                            echo '<script>
                            alert("Sorry there is not enough quantity in stock");
                                window.location.href="cart.php";
                            </script>';
                        die(); 
                        }
                    }else {
                        echo '<script>
                            alert("Sorry there is not enough quantity in stock");
                            window.location.href="cart.php";
                        </script>';
                        die();
                    }
                }
                $q= 0;
            }

            $total_price = $total;

            $order_stat = 'pending';
            date_default_timezone_set('Asia/Kolkata');
            $added_on = date('Y-m-d H:i:s');
            
            $order = mysqli_query($con,"insert into oder (client_id,address,total,order_status,added_on) 
                                    values ('$uid','$addr','$total_price','$order_stat','$added_on')"); 

            // adding products into order detail

            $order_id = mysqli_insert_id($con);

            $cart= mysqli_query($con,"SELECT * FROM CART INNER JOIN product on cart.product_id = product.id where client_id='$uid'");
            while($row = mysqli_fetch_assoc($cart)) {
                $pid = $row['product_id'];
                $prod_name = $row['prod_name'];
                $price =$row['price'];
                $qty = $row['quantity'];

                $order_detail = mysqli_query($con,"insert into order_details (order_id,client_id,prod_id,prod_name,qty,price) values('$order_id','$uid','$pid','$prod_name','$qty','$price')");

            }
           
        }
        $del = mysqli_query($con,"delete from cart where client_id='$uid'");
        header('location:thank_you.php');
        die();
    }		
?>
<?php if($check >0) {?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/order.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <title>why us footer</title>
</head>
<body>
<div class="order">
    <div class="address">
    <div class="addr">
        <h3>Deliver to : <br></h3>
            <?php if($addr != '') {?>
                 <pre><?php echo $addr?></pre>
            <?php } ?>

    </div>
    <div class="date">
        <h3><?php echo date("Y-m-d");?></h3>
        <h3>Place:Udupi</h3>
    </div>
</div>

<div class="table">
<table>
    <tr>
        <th colspan="6"><h2>Order Details</h2></th>
    </tr>
    <tr>
        <th>Name</th>
        <th>Image</tyh>
        <th>Quantity</th>
        <th>Price</th>
        <th>total Price</th>
        <th></th>
    </tr>
    <?php 
		while($row = mysqli_fetch_assoc($cart)){
	?>
    <tr>
        <td><?php echo $row['name'];?></td>
        <td><img style="height: 80px; width:100px;" src="../image/<?php echo $row['image']?>"></td>
		<td><?php echo $row['quantity'];?></td>
		<td><?php echo $row['price'];?></td>
		<td><?php echo $row['quantity'] * $row['price'];?></td>
		<td><center><?php echo "<button class='btn-delete'><a href='?type=delete&id=".$row['id']."'>Remove</a></button>&nbsp;";?></center></td>
    </tr>
    <?php
	$total +=$row['quantity'] * $row['price'];
	} ?>
    <tr class="total">
        <td colspan="3">Total</td>
        <td colspan="2" class="val"><?php echo $total?></td>
    </tr>
    <tr class="btn-order">
    <td colspan="6"><center><a href="?operation=confirm" class="btn">confirm Order</a></center></td>
        
    </tr>
</table>
</div>
</div>
</body>
</html>

<?php } else {
	echo '<script>alert("No products in the cart!")</script>';
} ?>