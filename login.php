<?php

session_start();

if((!isset($_POST['login'])) || (!isset($_POST['password']))){
    header('Location:index.php');
    exit();
}

require_once "connect.php";

$connection = @new mysqli($host, $db_user, $db_password, $db_name);

if($connection->connect_errno!=0){
    echo"Error:".$connection->connect__errno;
}
else{
$login = $_POST['login'];
$password = $_POST['password'];

$login = htmlentities($login, ENT_QUOTES, "UTF-8");

if ($result = @$connection->query(
sprintf("SELECT * FROM uzytkownicy WHERE user = '%s'",
mysqli_real_escape_string($connection, $login)))){
$amount = $result->num_rows;
if($amount>0){

    $row = $result->fetch_assoc();

    if(password_verify($password, $row['pass'])){

    $_SESSION['loggedin'] = true; 
    $_SESSION['id'] = $row['id'];
    $_SESSION['user'] = $row['user'];
    $_SESSION['points'] = $row['points'];

    unset($_SESSION['error']);
    $result->free_result();
    header('Location: myAccount.php');
    
}else{

    $_SESSION['error'] = '<p> Nieprawidłowy login lub hasło</p>';
    header('Location:index.php');
}
}else{

    $_SESSION['error'] = '<p> Nieprawidłowy login lub hasło</p>';
    header('Location: index.php');
}

}
$connection ->close();
}

?>