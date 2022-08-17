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
    sprintf("SELECT title, date, hour, name_hall, seats  FROM film, showing, hall WHERE showing.film_idfilm = film.idfilm  AND showing.hall_idhall = hall.idhall",
    mysqli_real_escape_string($connection, $login))))
   {
    $ile_seansow = $rezultat->num_rows; 

   //echo $ile_seansow."<br>"; 
    if($ile_seansow>0)
    {
        $wiersz = $rezultat->fetch_assoc(); 
      //  echo $haslo."<br>"; 
      //  echo password_hash("Wiktor;p123", PASSWORD_DEFAULT);
      //  echo var_dump(password_verify($haslo, $wiersz['password']));
            
       
            $_SESSION['title'] = $wiersz['title']; 
            $_SESSION['date'] = $wiersz['date']; 
            $_SESSION['hour'] = $wiersz['hour']; 
            $_SESSION['name_hall'] = $wiersz['name_hall']; 
            $_SESSSION['seats'] = $wiersz['seats']; 
    
            
            $rezultat->free_result(); 
    
       
    }

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


</div>

<div>

<?php

echo $_SESSION['title']; 

echo "<table style='width:80%; border:1px solid black;'>"; 
            for ($i=0; $i<$ile_seansow;$i++)
            {
                echo "<tr>"; 
                echo "<td>".$_SESSION['title']."</td>";
                echo "<td>".$_SESSION['date']."</td>";
                echo "<td>".$_SESSION['hour']."</td>";
                echo "<td>".$_SESSION['name_hall']."</td>";
                echo "<td>".$_SESSION['seats']."</td>";
                echo "</tr>"; 
            }
            echo "</table>"; 


?>

</div>

</body>

</html>