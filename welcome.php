<?php  

    session_start(); 

    if(!isset($_SESSION['regsucc']))
    {
        header('Location:index.php');
        exit();
    }
    else 
    {
        unset($_SESSION['regsucc']); 
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warsztat</title>

</head>

<body style="background-color:blue; text-align:center; font-size:200%;">

<h2> Dziękujemy za rejestrację! </h2>

<a href="index.php" style="color:black;"><button> Zaloguj się! </button></a>

<br>

</body>

</html>