<?php

session_start();

if((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin']==true)){
    header('Location: myAccount.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post">
    <label>Login <input type="text" name="login"/></label>
    <label>Password <input type="password" name="password"></label>
    <input type="submit" value="confirm">
    </form>
<a href="register.php">Register</a>
<?php

if(isset($_SESSION['error']))
echo $_SESSION['error']; 

?>

</body>
</html>