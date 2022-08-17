<?php 

    session_start(); 
    if(!isset($_SESSION['loggedin']))
    {
        header('Location:index.php');
        exit(); 
    }



?>
<!DOCTYPE html>
<html lang="pl">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warsztat</title>   

    <style>

    #belka
    {
        float:left; 
        text-align:right ; 
        width:100%; 
        height:50px; 
        border:1px solid black; 

    }
    .belkain
    {
        float:left; 
        text-align: center; 
        height:48px; 
        width:24.8%; 

    }

    </style>

</head>

<body style="background-color:blue; text-align:center; font-size:200%;">

<div id = "belka"> 

<div class = "belkain">

<a href="client.php">

Moj profil

</a>

</div>

<div class = "belkain">
<a href="bookings.php">

Moje bookings

</a>


</div>

<div class = "belkain">
<a href="showings.php">

Seanse

</a>

</div>


<div class = "belkain">

<?php

echo $_SESSION['name']." ".$_SESSION['surname']." ".'<button><a href="logout.php"> Wyloguj się</a></button>';

?>

</div>


</div>

</body>

</html>