<?php
    require('header.php');

    $uid = $_SESSION['id'];
    $order_id = get_safe_value($con,$_GET['id']);
    $total =0;

    $order = mysqli_query($con, "SELECT order_details.*, product.image from order_details INNER JOIN product on order_details.prod_id=product.id where client_id =$uid");
?>

    <a href="myaccount.php"><button class="back-btn"> < </button></a>
    <div class="order">
    <table>
        <tr>
            <th colspan="5" class="center-heading">My orders</th>
        </tr>
        <tr>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total Price</th>
        </tr>
        <?php
        while($row= mysqli_fetch_assoc($order)){
        ?>
        <tr>
            <td><img style="height: 80px; width:100px;" src="../image/<?php echo $row['image']?>"></td>
            <td><?php echo $row['prod_name'];?></td>
            <td><?php echo $row['qty'];?></td>
            <td>₹<?php echo $row['price'];?></td>
            <td>₹<?php echo $row['price']*$row['qty'];; ?></td>
        </tr>
    <?php
            $total += $row['price'] * $row['qty'];
        }
    ?>
        <tr>
            <td colspan="4" style="font-weight: bold; text-align: right;">Total Price</td>
            <td style="font-weight: bold;">₹<?php echo $total;?></td>
        </tr>
    </table>
</div>
<style>
body {
        padding: 0;
        margin: 0;
        font-family: 'Quicksand', sans-serif;
    }
    .order
    {
        display: flexbox;

    }
    table 
    {
        background-color: rgba(255, 255, 255, 0.568);
        position:absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-collapse: collapse;
        width: 1000px;
        height: 200px;
        border: 1px solid cadetblue;
        box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.659), -1px -1px 8px rgba(0, 0, 0, 0.2);
    }
    
    tr {
        transition: all .2s ease-in;
        cursor: pointer;
    }
    
    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    #header {
        background-color: #16a085;
        color: #fff;
    }
    
    h1 {
        font-weight: 600;
        text-align: center;
        background-color: #40c9a2;
        color: #fff;
        padding: 10px 0px;
    }
    
    tr:hover {
        background-color: #f5f5f5;
        transform: scale(1.02);
        box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2), -1px -1px 8px rgba(0, 0, 0, 0.2);
    }

.button
{
    
	margin: 25px 0 24px 0;
	height: 45px;
	width: 202px;
	font-size: 20px;
	color: white;
	outline: none;
	cursor: pointer;
	font-weight: bold;
	background:cadetblue;
	border-radius: 3px;
	border: 1px solid #ff0000;
	transition: .5s;

}
 .button:hover
{
	background: #2eceff;
}
.center-heading
{
    font-size: 50px;
    color: tomato;
    text-align: center;
}
.btn-delete
{
    margin: 25px 0 24px 0;
	height: 35px;
	width: 150px;
	font-size: 20px;
	color: white;
	outline: none;
	cursor: pointer;
	font-weight: bold;
	background:cadetblue;
	border-radius: 3px;
	border: 1px solid #000000;
	transition: .5s;
}
.btn-delete:hover
{
	background: tomato;
}
</style>