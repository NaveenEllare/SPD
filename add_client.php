<?php 
require('dbconnection/connection.inc.php');
require('functions.inc.php');
$username = "";
$email = "";
$pas = "";
$cpas = "";
$number="";
$address="";

if (isset($_SESSION['username'])) 
{
    header("Location:client.php");
}

if (isset($_POST['submit'])) 
{
	$username = $_POST['username'];
	$email = $_POST['email'];
	$pas = $_POST['password'];
	$cpas = $_POST['cpassword'];
	$number = $_POST['number'];
	$address= $_POST['address'];

	if ($pas == $cpas) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($con, $sql);
		if (!$result->num_rows > 0) {
			$result = mysqli_query($con,"insert into users (name,password,email,mobile,address) values ('$username','$pas','$email','$number','$address')");
			if ($result) {
				echo "<script>alert('Wow! client Registration Completed.')
				window.location.href='client.php';
				</script>";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')
				window.location.href='add_client.php';
				</script>";
			}
			
		} else {
			echo "<script>alert('Woops! Email Already Exists.')
			window.location.href='add_client.php';
			</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')
		window.location.href='add_client.php';
		</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/normalize.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

	<title>ADD CLIENTS</title>
</head>
<body>
	<br>
	<button class="btn-lg" ><a href="client.php">Back</button></a>
	<div class="container">
		<form action="" method="POST">
			<br>
            <p class="login-text" style="font-size: 2.5rem; font-weight: 600; color:black;">CLIENT INFO</p>
			<div class="form-group">
						<label for="categories" class=" form-control-label">Client Name</label>
						<input type="text" name="username" placeholder="Enter Client name" class="form-control" required  pattern="[a-zA-Z\s]{1,25}" title="Enter correct name." >
						</div>
						
						<div class="form-group">
							<label for="categories" class=" form-control-label">Password</label>
							<input type="password" name="password" placeholder="Enter password" class="form-control" required pattern=".{8,}" title="Eight or more characters" >
						</div>
						
						<div class="form-group">
							<label for="categories" class=" form-control-label">Re-Enter password</label>
							<input type="password" name="cpassword" placeholder="Re-Enter password" class="form-control" required pattern=".{8,}" title="Eight or more characters" >
						</div>
						
						<div class="form-group">
							<label for="categories" class=" form-control-label">Email-Id</label>
							<input type="email" name="email" placeholder="Enter Email id" class="form-control" required >
						</div>
						
						<div class="form-group">
							<label for="categories" class=" form-control-label">Phone no</label>
							<input type="text" name="number" placeholder="Enter contact no" class="form-control"  required  pattern="[6-9]{1}[0-9]{9}" title="Enter correct phone number eg.9876543210">
						</div>

						<div class="form-group">
							<label for="categories" class=" form-control-label">Address</label>
							<textarea type="test" name="address" placeholder="Enter client shop address" class="form-control" required></textarea>
						</div>
						
						
						<button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
						<span id="payment-button-amount">Submit</span>
						</button>
					</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>