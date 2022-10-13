<?php 

    session_start(); 
    if(!isset($_SESSION['loggedin']))
    {
        header('Location:index.php');
        exit(); 
    }


    require_once "db_connect.php"; 
 
    //mysqli_report(MYSQLI_REPORT_OFF);
    
    try 
    {
        $connection = @new mysqli($host,$dbuser,$dbpassword,$dbname);
    }
    catch (Exception $e)
    {
        echo "Error: ".$e->getCode()."."; 
        exit();
    }
    
    if($connection->connect_errno==0)
    {
        
       if($rezultat = @$connection->query(
        sprintf("SELECT title, length, date, hour from showing, film, bookings
        WHERE film.idfilm = showing.film_idfilm and showing.idshowing = bookings.showing_idshowing
            AND bookings.client_idclient = '".$_SESSION['id_klienta']."'",
        mysqli_real_escape_string($connection, $login))))
       {
        //$ile_seansow = $rezultat->num_rows; 
    
       //echo $ile_seansow."<br>"; 
        
    
       }
       
    
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
<?php
echo "<table style='width:80%; border:1px solid black;'>";
$i = 1;  
            while ($row = $rezultat->fetch_assoc())
            {
                
                echo "<tr>"; 
                echo "<td>".$row['title']."</td>";
                echo "<td>".$row['length']."</td>";
                echo "<td>".$row['date']."</td>";
                echo "<td>".$row['hour']."</td>";
                echo "</tr>";
                $i+=1; 
            }
echo "</table>";  
?>
</div>

</body>

</html>