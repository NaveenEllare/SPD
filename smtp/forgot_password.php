<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require('phpmailer/vendor/autoload.php');
require('../dbconnection/connection.inc.php');
require('../functions.inc.php');
$pass = '';
$msg =' ';


if(isset($_POST['submit'])) {
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$email = get_safe_value($con,$_POST['email']);
$user = mysqli_query($con,"select * from users where email='$email'");
while($row=mysqli_fetch_assoc($user)) {
$pass = $row['password'];
$name = $row['name'];
}
$check = mysqli_num_rows($user);
if($check > 0) {
try {
    //Server settings 
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'teamspd101@gmail.com';                     //SMTP username
    $mail->Password   = 'nightfury';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('teamspd101@gmail.com', 'Team SPD');
    $mail->addAddress($email, $name);     //Add a recipient
     //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Request for Password';
    $mail->Body    = 'Dear Client,
                      Access your account using this password'.$pass;

    $mail->send();
    $msg ='<span style="color:green;">Password has been sent to your registered email<span> <a href="../client_login.php">Login</a>';
} catch (Exception $e) {
    $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
} 
}else {
	$msg ="Sorry you are not registered contact TEAM SPD";
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Forgot Password</title>
	<script src="../jsfile.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
<div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can Retrive your old password here.</p>
                  <div class="panel-body">
				<form id="login" class="input-group" method="POST">
                <div class="form-group">
                        <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
					<input type="text" name="email" class="form-control"  placeholder="Enter Email ID" required>
                    </div>
                      </div>
                    <div class="form-group">
					<button type="submit" name="submit" class="btn btn-lg btn-primary btn-block">Request password</button>
                    <div>
                    <div class="field-error">
						<?php echo $msg ?>
                    </div>
				</form>
            </div>
		</div>
</body>
</html>
<style>.form-gap {
    padding-top: 70px;
}
</style>