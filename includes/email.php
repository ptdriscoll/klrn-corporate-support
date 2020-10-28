<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'].'/includes/PHPMailer/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'].'/includes/PHPMailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/includes/PHPMailer/src/SMTP.php';

//include configs for setFrom, addAddress, username, password, etc.
//or ignore if setting directly in this file (below)  
if (file_exists(dirname(__DIR__).'/config/email.php')) {
  $configs = include dirname(__DIR__).'/config/email.php';
}

$mail = new PHPMailer(); //add true parameter to enable exceptions
$mail->SMTPDebug = 2; //options are 0 for off, and 1,2,3,4

//custom settings
$message_posted_at = 'Message posted at Corporate Support Website';

$response_success = '<div id="email_response"><h2>Thank You!</h2><p class="lead">We will be in touch soon.</p></div>';

$response_error = '<div id="email_response"><h2>Sorry, there was an error.</h2><p class="lead">Please try again, or call us at (210)&nbsp;270&#8209;9000.</p></div>';

//set from config/email.php, but can be set or overridden here
$mail->setFrom($configs['setFromEmail'], $configs['setFromName']);
$mail->addAddress($configs['addAddress']);
$mail->addBCC($configs['addBCC1']);
$mail->addBCC($configs['addBCC2']);
$mail->Host = $configs['host'];
$mail->Port = $configs['port'];
$mail->SMTPSecure = $configs['smtpSecure'];
$mail->Username = $configs['username'];
$mail->Password = $configs['password'];

//more server settings
$mail->Subject = $message_posted_at;
$mail->isSMTP();
$mail->SMTPAuth = true;

//placeholders to ignore from form input
$name_placeholder = 'Name';
$email_placeholder = 'Email';
$email_verify_placeholder = 'Verify email';
$message_placeholder = 'Message';

//variables
$name = $last_name = $email = $email_verify = $message = '';
$errors = '';
$error_message = '';
$loading = '<img id="submit_loader" class="loader" src="assets/img/loader.svg">';
$sent = false; 

//for cleaning inputs
function clean_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

//set response
if (isset($_GET['result'])) {
	$sent = true;
	if ($_GET['result'] == 'success') {
		$response = $response_success;
	}
	if ($_GET['result'] == 'error') {
		$response = $response_error;
	}
}

//get post variables and clean
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = clean_input($_POST['first_name']);
	$last_name = clean_input($_POST['last_name']);
	$email = clean_input($_POST['email']);
	$email_verify = clean_input($_POST['email_verification']);
	$message = clean_input($_POST['message']);
	
  //validate input
	if (empty($name) || $name === $name_placeholder) {
    $errors .= '<li>Please enter your name</li>';
  }
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $email === $email_placeholder) {
    $errors .= '<li>Please enter valid email address</li>';
  }
	if (!filter_var($email_verify, FILTER_VALIDATE_EMAIL) 
      || $email !== $email_verify 
      || $email_verify === $email_verify_placeholder) {
		$errors .= '<li>Please verify email address</li>';
	}
	if (empty($message) || $message === $message_placeholder) {
    $errors .= '<li>Please enter a message</li>';
  }
	
  //set error response if there are errors
	if (!empty($errors)) {
		$error_message .= '<ul id="error_message">'.$errors.'</ul>';
	}
	
  //send if no form input errors
	if (empty($errors) && empty($last_name) && $sent == false) {   
 
		$mail->Body = "From: $name\nEmail: $email\n\n$message_posted_at:\n\n$message";
    
    if ($mail->send()) {
      $result = 'success';
    } else {
      $result = 'error';
      echo '<p>Mailer Error: '.$mail->ErrorInfo.'</p>';       
    }
    
    //post back
    header('Location:'.dirname($_SERVER['PHP_SELF']).'?result='.$result.'#email_response');
    die;    
	}
}
?>