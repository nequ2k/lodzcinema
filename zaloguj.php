<?php 

session_start(); 

if(!isset($_POST['login'])||!isset($_POST['haslo']))
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
    $login = $_POST['login']; 
    $haslo = $_POST['haslo']; 

   // $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    // usunieto html entities dla hasla
    //$sql = "SELECT * FROM client WHERE email='$login' AND password='$haslo'";

   if($rezultat = @$connection->query(
    sprintf("SELECT * FROM client WHERE email='%s'",
    mysqli_real_escape_string($connection, $login))))
   {
    $ile_userow = $rezultat->num_rows; 
   // echo $ile_userow."<br>"; 
    if($ile_userow>0)
    {
        $wiersz = $rezultat->fetch_assoc(); 
      //  echo $haslo."<br>"; 
      //  echo password_hash("Wiktor;p123", PASSWORD_DEFAULT);
      //  echo var_dump(password_verify($haslo, $wiersz['password']));
        if(password_verify($haslo, $wiersz['password']))
        {
            $_SESSION['surname'] = $wiersz['surname']; 
            $_SESSION['name'] = $wiersz['name']; 
            $_SESSION['email'] = $wiersz['email']; 
            $_SESSION['tel'] = $wiersz['tel']; 
            $_SESSION['loggedin'] = true; 
            echo "EEEEEEEEEEEEE"; 
            $_SESSSION['id'] = $wiersz['id']; 
    
           unset($_SESSION['blad']); 
    
            $rezultat->free_result(); 
    
            header('Location:menu.php'); 
        }
        else
        {
        $_SESSION['blad'] = '<span style="color:red"> Nieprawidlowy login lub haslo! </span>'; 
        header('Location:index.php');
      //  echo "E1"; 
        }


    }
    else
    {
        $_SESSION['blad'] = '<span style="color:red"> Nieprawidlowy login lub haslo! </span>'; 
        header('Location:index.php');
      //  echo "E2"; 
    }
   }
    //$_SESSION['info'] =  password_verify($haslo, $wiersz['password']);
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