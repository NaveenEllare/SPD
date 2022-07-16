
<?php 
require('header.php');

$userId = $_SESSION['id'];
$query = "SELECT * FROM users where id=$userId";
$result = mysqli_query($con, $query);
$res=mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/myaccount.css">
    <title>my account</title>
</head>
<body>
  <div class="main-content">
    <div class="container mt-7">
      <!-- Table -->
      <h2 class="mb-5">My Account Card</h2>
      <div class="row">
        <div class="col-xl-8 m-auto order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label">Client name:<?php echo $res['name']?></label>
                       
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" >Email address : <?php echo $res['email'] ?> </label>
                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label">user id:<?php echo $res['id'] ?> </label> 
                       
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label">phone no:<?php echo $res['mobile'] ?> </label>
                        
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="form-control-label" >Address:<?php echo $res['address'] ?></label>
                        <p id="addr"></p>
                        
                      </div>
                    </div>
                  </div>
                <hr class="my-4">
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">MY ORDERS</h6>
                <?php 
                $order = mysqli_query($con, "select * from oder where client_id = '$userId'");
                $check = mysqli_num_rows($order);

                if($check> 0) {
                 ?>

                <div class="table">
                    <table>
                        <tr>
                              <th>Order ID</th>
                              <th>&nbsp;&nbsp;&nbsp;&nbsp;Order Date&nbsp;&nbsp;&nbsp;&nbsp;</th>
                              <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total amount&nbsp;&nbsp;&nbsp;&nbsp;</th>
                              <th>&nbsp;&nbsp;&nbsp;&nbsp;Order Status&nbsp;&nbsp;&nbsp;&nbsp;</th>
                              <th>View Detail</th>
                        </tr>
              <?php
                  while($row= mysqli_fetch_assoc($order)){
              ?>
                  <tr>
                      <td><?php echo $row['o_id'];?></td>
                      <td><?php echo $row['added_on'];?></td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['total'] ?></td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['order_status'];?></td>
                      <td><a href="myorder_details.php?id=<?php echo $row['o_id'];?>">View Detail</a></td>
                  </tr>
                <?php
                  }
                ?>
                    </table>
                </div>
              <?php
                } else {
                  echo '<h3>No order made by you</h3>';
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>