<?php

session_start();

if(!isset($_SESSION['loggedin']))
{
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php

echo "<p>Hello ".$_SESSION['user'].'! [<a href="logout.php">Logout</a>]</p>';
echo "<p>Your score: ".$_SESSION['points']."</p>";
?>
    
</body>
</html>