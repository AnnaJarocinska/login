<?php

session_start();

if((!isset($_POST['login'])) || (!isset($_POST['password']))){
    header('Location:index.php');
    exit();
}

require_once "connect.php";

$connection = @new mysqli($host, $db_user, $db_password, $db_name);

if($connection->connect_errno!=0)
{
    echo"Error:".$connection->connect__errno;
}
else
{

$login = $_POST['login'];
$password = $_POST['password'];

$login = htmlentities($login, ENT_QUOTES, "UTF-8");
$password = htmlentities($password, ENT_QUOTES, "UTF-8");



if ($result = @$connection->query(
sprintf("SELECT * FROM uzytkownicy WHERE user = '%s' AND pass = '%s'",
mysqli_real_escape_string($connection, $login),
mysqli_real_escape_string($connection, $password)
)

))
{
$amount = $result->num_rows;
if($amount>0)
{
    $_SESSION['login'] = true; 

    $row = $result->fetch_assoc();

    $_SESSION['id'] = $row['id'];

    
    $_SESSION['user'] = $row['user'];
    $_SESSION['points'] = $row['points'];

    unset($_SESSION['Error']);
    $result->free_result();
    header('Location: myAccount.php');
    
}
else{

    $_SESSION['Error'] = '<p> Nieprawidłowy login lub hasło</p>';
    header('Location:index.php');
}
}


$connection ->close();
}

?>