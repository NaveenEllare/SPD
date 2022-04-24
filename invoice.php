<?php
    require('dbconnection/connection.inc.php');
    require('functions.inc.php');

    if(isset($_GET['id']) && $_GET['id'] !=''){ 
        $od_id = get_safe_value($con,$_GET['id']);
        $client_id = get_safe_value($con,$_GET['client']);
    }
    $total =0;

    $order = mysqli_query($con, "SELECT order_details.*,product.name ,users.address,users.email FROM `order_details` 
                                INNER JOIN product on order_details.prod_id = product.id inner JOIN users on users.id = order_details.client_id WHERE order_id='$od_id'");
    while($row= mysqli_fetch_assoc($order)){
        $address = $row['address'];
        $email = $row['email'];
        $total += $row['qty'] * $row['price'];
    }

    $order = mysqli_query($con, "SELECT order_details.*,product.name ,users.address,users.email FROM `order_details` 
                                INNER JOIN product on order_details.prod_id = product.id inner JOIN users on users.id = order_details.client_id WHERE order_id='$od_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/invoice_style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <title>Invoice</title>
</head>
<body>
    <div class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent header-elements-inline">
                    <h6 class="card-title">Sale invoice</h6>
                    <div class="header-elements"> <button type="button" class="btn btn-light btn-sm"><i class="fa fa-file mr-2"></i> Save</button> <button type="button" class="btn btn-light btn-sm ml-3"><i class="fa fa-print mr-2"></i> Print</button> </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-4 pull-left">
                                <h6>Simple Pharama Distributors</h6>
                                <ul class="list list-unstyled mb-0 text-left">
                                    <li>kunjibettu</li>
                                    <li>udupi city</li>
                                    <li>+91 8197766717 </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-4 ">
                                <div class="text-sm-right">
                                    <h4 class="invoice-color mb-2 mt-md-2">Invoice Of <?php echo $od_id?></h4>
                                    <ul class="list list-unstyled mb-0">
                                        <li>Date: <span class="font-weight-semibold"><?php echo date("Y-m-d");?></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex flex-md-wrap">
                        <div class="mb-4 mb-md-2 text-left"> <span class="text-muted">Invoice To:</span>
                            <ul class="list list-unstyled mb-0">
                                <li>
                                    <h5 class="my-2"><?php echo $address?></h5>
                                </li>
                               
                                <li><a href="#" data-abc="true"><?php echo $email?></a></li>
                            </ul>
                        </div>
                        <div class="mb-2 ml-auto"> <span class="text-muted">Payment Details:</span>
                            <div class="d-flex flex-wrap wmin-md-400">
                                <ul class="list list-unstyled mb-0 text-left">
                                    <li>
                                        <h5 class="my-2">Total Due:</h5>
                                    </li>
                                    <li>Bank name:</li>
                                    <li>Country:</li>
                                    <li>City:</li>
                                    <li>Address:</li>
                                    <li>Gpay</li>
                                </ul>
                                <ul class="list list-unstyled text-right mb-0 ml-auto">
                                    <li>
                                        <h5 class="font-weight-semibold my-2">₹<?php echo $total;?></h5>
                                    </li>
                                    <li><span class="font-weight-semibold">Canara Bank</span></li>
                                    <li>India</li>
                                    <li>udupi</li>
                                    <li>Beside,MGM college</li>
                                    <li><span class="font-weight-semibold">7022499723</span></li>
                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-lg">
                        <thead>
                            <tr>
                                <th>product name</th>
                                <th>price</th>
                                <th>QTY</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row= mysqli_fetch_assoc($order)){?>
                            <tr>
                                <td>
                                    <h6 class="mb-0"></h6> <span class="text-muted"><?php echo $row['prod_name'];?></span>
                                </td>
                                <td><?php echo $row['price']?></td>
                                <td><?php echo $row['qty']?></td>
                                <td><span class="font-weight-semibold"><?php echo $row['price']*$row['qty'];?></span></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <div class="d-md-flex flex-md-wrap">
                        <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                            <h6 class="mb-3 text-left">Total due</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                            <th class="text-left">Total:</th>
                                            <td class="text-right text-primary">
                                                <h5 class="font-weight-semibold">₹<?php echo $total;?></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right mt-3"> <button type="button" class="btn btn-primary"><b><i class="fa fa-paper-plane-o mr-1"></i></b> Send invoice</button> </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer"> <span class="text-muted">Thank you</span> </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>