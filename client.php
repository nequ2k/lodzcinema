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



?>
<!DOCTYPE html>
<html lang="pl">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      tat</title>   

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
    #content
    {
        text-align: center; 
        height: 900px;
        width:100%; 
        border:1px solid black; 
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

function updateName()
{
    echo ' <table style="width:50%; border:1px solid black;"> 
    <tr>
      <td> Nowie imie: </td>
      <form method="post">
      <td> <input type="text" name="newName"> </td>
      <td> <input type="submit" value="zapisz"> </td>
      </form> 
    </tr>
    
      </table>
    ';



}

function updateSurname()
{
    echo ' <table style="width:50%; border:1px solid black;"> 
    <tr>
      <td> Nowe nazwisko: </td>
      <form method="post">
      <td> <input type="text" name="newSurname"> </td>
      <td> <input type="submit" value="zapisz"> </td>
      </form> 
    </tr>
    
      </table>
    ';
}

function updateEmail()
{
    echo ' <table style="width:50%; border:1px solid black;"> 
    <tr>
      <td> Nowy email: </td>
      <form method="post">
      <td> <input type="text" name="newEmail"> </td>
      <td> <input type="submit" value="zapisz"> </td>
      </form> 
    </tr>
    
      </table>
    ';
//EDIT 
    // if(($email != $emailB) || (filter_var($emailB, FILTER_VALIDATE_EMAIL)==false))
    // {
    //     $flag = false;
    //     $_SESSION['e_email'] = "Niepoprawny adres email!";  

    // }


}

function updateTel()
{
    echo ' <table style="width:50%; border:1px solid black;"> 
    <tr>
      <td> Nowy telefon: </td>
      <form method="post">
      <td> <input type="text" name="newTel"> </td>
      <td> <input type="submit" value="zapisz"> </td>
      </form> 
    </tr>
    
      </table>
    ';
}

echo $_SESSION['name']." ".$_SESSION['surname']."   ".'<button><a href="logout.php"> Wyloguj si??</a></button>';

?>

</div>


</div>

<div id = "content">






<table style="width:50%; border:1px solid black;">
  <tr>
    <td>Imie: </td>
    <td><?php echo $_SESSION['name'] ?></td>
    <td> <form method="post"> <input type="submit" name="editName" value="aktualizuj"/> </form></td>
  </tr> 
  <tr>
    <td>Nazwisko: </td>
    <td><?php echo $_SESSION['surname'] ?></td>
    <td> <form method="post"> <input type="submit" name="editSurname" value="aktualizuj"/> </form> </td>
  </tr>
  <tr>
    <td>Email: </td>
    <td><?php echo $_SESSION['email'] ?></td>
    <td> <form method="post"> <input type="submit" name="editEmail" value="aktualizuj"/> </form></td>
  </tr>
  <tr>
    <td>telefon: </td>
    <td><?php echo $_SESSION['tel'] ?></td>
    <td> <form method="post">  <input type="submit" name="editTel" value="aktualizuj"/> </form></td>
  </tr>
</table>

<?php

  if(array_key_exists('editName', $_POST))
  {
    updateName(); 
  }
  if(array_key_exists('editSurname', $_POST))
  {
    updateSurname(); 
  }
  if(array_key_exists('editEmail', $_POST))
  {
    updateEmail(); 
  }
  if(array_key_exists('editTel', $_POST))
  {
    updateTel(); 
  }
 // if(array_key_exists('newName', $_POST))
 // {
  //  echo $_POST['newName']; 
 // }

 if(array_key_exists('newName', $_POST))
 {
   if((strlen($_POST['newName'])<3 || strlen($_POST['newName'])>24))
     {
       echo "Imie musi posiada?? 3-24 znaki!";  
     }
     else 
     {
      $sql = "UPDATE client SET name = '".$_POST['newName']."' WHERE idclient = '".$_SESSION['id_klienta']."'";
      $connection->query($sql);
      $sql = "SELECT name from client where idclient = '".$_SESSION['id_klienta']."'";
  //    $rezultat = $connection->query($sql);
     // $_SESSION['id_klienta'] = $rezultat->fetch_object()->name; 

     }
   //echo $_POST['newName']; 
 }

 if(array_key_exists('newSurname', $_POST))
 {
   if((strlen($_POST['newSurname'])<3 || strlen($_POST['newSurname'])>24))
     {
       echo "Nazwisko musi posiada?? 3-24 znaki!";  
     }
     else 
     {
      $sql = "UPDATE client SET surname = '".$_POST['newSurname']."' WHERE idclient = '".$_SESSION['id_klienta']."'";
      $connection->query($sql);
     }
   //echo $_POST['newName']; 
 }


 if(array_key_exists('newEmail', $_POST))
 {
   if((strlen($_POST['newEmail'])<3 || strlen($_POST['newEmail'])>24))
     {
       echo "Email musi posiada?? 3-24 znaki!";  
     }
     else 
     {
      $sql = "UPDATE client SET email = '".$_POST['newEmail']."' WHERE idclient = '".$_SESSION['id_klienta']."'";
      $connection->query($sql);
      


      
     }
   //echo $_POST['newName']; 
 }

 if(array_key_exists('newTel', $_POST))
 {
   if((strlen($_POST['newTel'])<3 || strlen($_POST['newTel'])>24))
     {
       echo "telefon musi posiada?? 9-15 znakow!";  
     }
     else 
     {
      $sql = "UPDATE client SET tel = '".$_POST['newTel']."' WHERE idclient = '".$_SESSION['id_klienta']."'";
      $connection->query($sql);
     }
   //echo $_POST['newName']; 
 }




?>






</div>

</body>

</html>