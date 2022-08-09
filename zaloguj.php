<?php 

session_start(); 
require_once "db_connect.php"; 
 
mysqli_report(MYSQLI_REPORT_OFF);

try 
{
    $connection = @new mysqli($host,$dbuser,$dbpassword,$dbname);
}
catch (Exception $e)
{
    echo "Error: ".$e->getCode()."."; 
}


if($connection->connect_errno==0)
{
    $login = $_POST['login']; 
    $haslo = $_POST['haslo']; 


    
    $sql = "SELECT * FROM client WHERE email='$login' AND password='$haslo'";

   if($rezultat = @$connection->query($sql))
   {
    $ile_userow = $rezultat->num_rows; 
    if($ile_userow>0)
    {
        $wiersz = $rezultat->fetch_assoc(); 
        $_SESSION['name'] = $wiersz['name']; 

       unset($_SESSION['blad']); 

        $rezultat->free_result(); 

        header('Location:menu.php'); 

    }
    else
    {
        $_SESSION['blad'] = '<span style="color:red"> NIeprawidlowy login lub haslo! </span>'; 
        header('Location:index.php');
    }
   }




    $connection->close(); 
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





</body>

</html>