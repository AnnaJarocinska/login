<?php

session_start();
if(isset($_POST['email'])){
    $correct=true;

    $name = $_POST['name'];
    if ((strlen($name)<3) || (strlen($name)>20)){
        $correct=false;
        $_SESSION['error_name']="Imię musi posiadać od 3 do 20 znaków";
    }

    if(ctype_alnum($name)==false){
        $correct=false;
        $_SESSION['error_name']="Imię może składać się tylko z liter i cyfr";
    }

    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)){
    $correct=false;
    $_SESSION['error_email']="Podaj poprawny adres email";
}
    exit();


    if($correct==true){
        // testy ok
        echo "Poprawna walidacja";
        exit();
    }
}

?>


<!--6LcFor8UAAAAAPgUhNY8AJlYUMhbzpqHL7geSC8r

6LcFor8UAAAAAO52DaFz9s3iV3gXmFWAijPmVbEX  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <script src="https://www.google.com/recaptcha/api.js?render=6LcFor8UAAAAAPgUhNY8AJlYUMhbzpqHL7geSC8r"></script>

</head>
<body>

<form method="post">
<label>Name <input type="text" name ="name"></label>
<?php
if(isset($_SESSION['error_name'])){
    echo '<p>'.$_SESSION['error_name'].'</p>';
    unset($_SESSION['error_name']);
}

?>

<label>Email <input type="text" name ="email"></label>
<?php
if(isset($_SESSION['error_email'])){
    echo '<p>'.$_SESSION['error_email'].'</p>';
    unset($_SESSION['error_email']);
}

?>

<label>Password <input type="password" name ="password1"></label>
<label>Repeat password <input type="password" name ="password2"></label>
<label> I accept the terms and conditions<input type="checkbox" name="accept">
<input type="submit" value="Register">

</form>
<script>
grecaptcha.ready(function() {
    grecaptcha.execute('6LcFor8UAAAAAPgUhNY8AJlYUMhbzpqHL7geSC8r', {action: 'homepage'}).then(function(token) {
       ...
    });
});
</script>



</body>
</html>