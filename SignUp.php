<?php 

define('DB_NAME', 'testpage');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$link) {
		die("Unable to connect: " . mysql_error());
}

$db_selected = mysql_select_db(DB_NAME, $link);
if(!$db_selected) {
	die('Can\'t use database. ' . mysql_error());
}

$username = $_POST['user'];
$password = $_POST['pass'];
$email = $_POST['email'];
$sql = "INSERT INTO demo (user, pass, email) VALUES ('$username', '$password', '$email')";
if (!mysql_query($sql)) {
	die('Error: ' . mysql_error());
}

?>


<?php
require_once 'swiftmailer-5.x/lib/swift_required.php';
$body = <<<EOD
<html>
    <head></head>
    <body>
        Hello, <br><br> 
  
		Welcome to Connect! We are building a network to connect people with similar interests together.<br>
		We're excited to have you join us! Click <a href="google.com">here</a> to verify your email with us.<br><br>
		  
		Happy Chatting!<br>
		Connect Team
    </body>
</html>
EOD;

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
  ->setUsername('theofficialconnectteam@gmail.com')
  ->setPassword('childpornographyisawesome');

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance('Test Subject')
  ->setFrom(array('f.tso11200@gmail.com' => 'Sender Name'))
  ->setTo(array($_POST['email'] => 'Receiver Name'))
  ->setSubject('Welcome to Connect')
  ->setBody(
  $body,
  'text/html'
	);

$result = $mailer->send($message);
?>

<html>
<head>
</head>
<body>
Welcome <?php echo htmlspecialchars($_POST['user']); ?>
, we have sent you a confirmation email to <?php echo htmlspecialchars($_POST['email']); ?>

</body>
</html>