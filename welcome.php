<?php

	session_start();
	
	if (!isset($_SESSION['registercomplete'])){
		header('Location: index.php');
		exit();
	}else{
		unset($_SESSION['registercomplete']);
	}
	
	if (isset($_SESSION['fr_name'])) unset($_SESSION['fr_name']);
	if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
	if (isset($_SESSION['fr_password1'])) unset($_SESSION['fr_password1']);
	if (isset($_SESSION['fr_password2'])) unset($_SESSION['fr_password2']);
    if (isset($_SESSION['fr_accept'])) unset($_SESSION['fr_accept']);
    
	if (isset($_SESSION['error_name'])) unset($_SESSION['error_name']);
	if (isset($_SESSION['error_email'])) unset($_SESSION['error_email']);
	if (isset($_SESSION['error_password'])) unset($_SESSION['error_password']);
	if (isset($_SESSION['error_accept'])) unset($_SESSION['error_accept']);
	if (isset($_SESSION['error_bot'])) unset($_SESSION['error_bot']);
	
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Dokument</title>
</head>

<body>
	
	Dziękujemy za rejestrację w serwisie! 
	<a href="index.php">Zaloguj się </a>
	<br /><br />

</body>
</html>