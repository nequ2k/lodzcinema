<?php 
    
    session_start(); 
    if(!isset($_SESSION['loggedin']))
    {
        header('Location:index.php');
        exit(); 
    }

    require_once "db_connect.php"; 

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
    
   $result = @$connection->query(
    sprintf("SELECT idshowing, title, date, hour, name_hall, seats  FROM film, showing, hall WHERE showing.film_idfilm = film.idfilm  AND showing.hall_idhall = hall.idhall AND showing.idshowing='".$_POST['valueofID']."'",
    mysqli_real_escape_string($connection, $login)));
    $id = @$connection->query(
        sprintf("SELECT idclient FROM client WHERE client.email = '".$_SESSION['email']."'",
        mysqli_real_escape_string($connection, $login)));

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
    a 
    {
    display: block;

    }


    

    </style>

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
$i =1; 
if(!isset($_GET['isBooked']))
{
echo "<table style='width:80%; border:1px solid black;'>";
$row = $result->fetch_assoc();
            
               
                echo "<tr>"; 
                echo "<td>".$row['idshowing']."</td>";
                echo "<td>".$row['title']."</td>";
                echo "<td>".$row['date']."</td>";
                echo "<td>".$row['hour']."</td>";
                echo "<td>".$row['name_hall']."</td>";
                echo "<td>".$row['seats']."</td>";
                echo "</tr>";
                
                $_SESSION['savailable'] = $row['seats'];        
echo "</table> <br>";
}


echo "Ile miejsc chcesz zarezerwowac na tej sali? (max.10) <br>"; 
echo '<form action="" method="get"> 
<select name ="num">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>
<option>10</option>
</select>
<input type="hidden"  name = "isBooked" value="1"> 
<input type="submit" value="book">  
</form>'; 


// if (isset($_GET['num']))
// {
//     echo 'Bookujesz '.$_GET['num'].' bilety(ow) <br>'; 
//     echo "Cena: ", $_GET['num']*20, " zł"; 

//     echo "id seansu: ".$id_seansu."<br>"; 
//     $idv = $id->fetch_assoc(); 
//     echo "id klienta: ".$idv['idclient']; 


// }


if(isset($_POST['valueofID']))
{
    $_SESSION['id_seansu'] = $_POST['valueofID'];
    $idv = $id->fetch_assoc();
    $_SESSION['id_klienta'] = $idv['idclient'];
echo "ID klienta: ".$_SESSION['id_klienta']."<br>";
echo "ID seansu: ".$_SESSION['id_seansu']."<br>";
}

if(isset($_GET['isBooked']))
{
//     echo "zabookowales <br>";
//     echo "id klienta: ".$_SESSION['id_klienta']."<br>";
//     echo "id seansu: ".$_SESSION['id_seansu'];
//$stm = $connection->prepare("INSERT INTO bookings VALUES (?, ?, ?)");
//$stm->bind_param("sss", $_SESSIO)
$sql = "INSERT INTO bookings (showing_idshowing, client_idclient) VALUES (?, ?)";
$stm= $connection->prepare($sql);
$stm->bind_param("ss", $_SESSION['id_seansu'], $_SESSION['id_klienta']);
$stm->execute();
// *UPDATE BAZY DANYCH, PIERWSZA MYSL: DODANIE DO TABELI SHOWING kolumny seats_available!!! 
//$sql = "UPDATE showing SET lastname='Doe' WHERE id=2""
//$connection->query(sprintf("INSERT INTO bookings (showing_idshowing, client_idclient) VALUES ('$_SESSION['idklienta']', '$_SESSION['regsurname']')",
//mysqli_real_escape_string($connection, $login)))



 }

?>


</div>


</body>

</html>