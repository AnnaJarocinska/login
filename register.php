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

$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

if((strlen($password1)<8) || (strlen($password2)>20)){
    $correct=false;
    $_SESSION['error_password']="Hasło musi mieć od 3 do 20 znaków";  
}
    
if($password1!=$password2){
    $correct=false;
    $_SESSION['error_password']="Hasła muszą być identyczne";
}


$password_hash = password_hash($password1, PASSWORD_DEFAULT);


if(!isset($_POST['accept'])){
    $correct=false;
    $_SESSION['error_accept']="Musisz zaakceptować regulamin";   
}


// zapamiętywanie danych
$_SESSION['fr_name']=$name;
$_SESSION['fr_email']=$email;
$_SESSION['fr_password1']=$password1;
$_SESSION['fr_password2']=$password2;
if(isset($_POST['accept'])) $_SESSION['fr_accept'] = true;


    // połączenie z bazą danych
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try{

        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if($connection->connect_errno!=0){
            throw new Exception(mysqli_connect_errno());
        }
        else{

    $result = $connection->query("SELECT id FROM uzytkownicy WHERE email='$email'");

    if(!$result) throw new Exception($connection->error);

    $howManyMails = $result->num_rows;
    if($howManyMails>0){
    $correct=false;
    $_SESSION['error_email']="Podany email został już zarejestrowany";
}



$result = $connection->query("SELECT id FROM uzytkownicy WHERE user='$name'");

if(!$result) throw new Exception($connection->error);

$howManyLogins = $result->num_rows;
if($howManyLogins>0){
    $correct=false;
    $_SESSION['error_name']="Podany login został już zarejestrowany";
}

if($correct==true){
    // testy ok
    if($connection->query("INSERT INTO uzytkownicy VALUES(NULL,'$name', '$password_hash', '$email', 0)")){

        $_SESSION['registercomplete']=true;
        header('Location: welcome.php');
    }
    else{
        throw new Exception($connection->error);
    }
}


            $connection->close();
        }

    }catch(Exception $errorr){
        echo 'Błąd serwera'.$errorr;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
   
</head>
<body>

<form method="post">
<label>Name <input type="text"
value="
<?php
if(isset($_SESSION['fr_name'])){
    echo $_SESSION['fr_name'];
    unset($_SESSION['fr_name']);
}

?>" name ="name"></label>

<?php
if(isset($_SESSION['error_name'])){
    echo '<p>'.$_SESSION['error_name'].'</p>';
    unset($_SESSION['error_name']);
}

?>

<label>Email <input type="text" 
value="
<?php
if(isset($_SESSION['fr_email'])){
    echo $_SESSION['fr_email'];
    unset($_SESSION['fr_email']);
}

?>"
name ="email"></label>
<?php
if(isset($_SESSION['error_email'])){
    echo '<p>'.$_SESSION['error_email'].'</p>';
    unset($_SESSION['error_email']);
}

?>

<label>Password <input type="password" 
value="
<?php
if(isset($_SESSION['fr_password1'])){
    echo $_SESSION['fr_password1'];
    unset($_SESSION['fr_password1']);
}

?>"
name ="password1"></label>

<?php
if(isset($_SESSION['error_password'])){
    echo '<p>'.$_SESSION['error_password'].'</p>';
    unset($_SESSION['error_password']);
}

?>

<label>Repeat password <input type="password"
value="
<?php
if(isset($_SESSION['fr_password2'])){
    echo $_SESSION['fr_password2'];
    unset($_SESSION['fr_password2']);
}

?>"
 name ="password2"></label>

<label> 
<input type="checkbox" name="accept"
<?php
if(isset($_SESSION['fr_accept'])){
    echo "checked";
    unset($_SESSION['fr_accept']);
}
?>/> I accept

</label>
<?php
if(isset($_SESSION['error_accept'])){
    echo '<p>'.$_SESSION['error_accept'].'</p>';
    unset($_SESSION['error_accept']);
}
?>

<input type="submit" value="Register">
</form>
</body>
</html>