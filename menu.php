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
        
    </style>

    <script>


    </script>

</head>

<body style="background-color:blue; text-align:center; font-size:200%;">


<?php 
echo "<p> Witaj ".$_SESSION['name']."!"; 
echo '<button><a href="logout.php"> Wyloguj się</a></button>';

?>


</body>

</html>