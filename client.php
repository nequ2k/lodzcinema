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
      <td> <input type="text" name="newName"> </td>
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
      <td> <input type="text" name="newName"> </td>
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
      <td> <input type="text" name="newName"> </td>
      <td> <input type="submit" value="zapisz"> </td>
      </form> 
    </tr>
    
      </table>
    ';
}

echo $_SESSION['name']." ".$_SESSION['surname']."   ".'<button><a href="logout.php"> Wyloguj się</a></button>';

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
   if((strlen($_POST['newName'])<8 || strlen($_POST['newName'])>24))
     {
       echo "Haslo musi posiadać 8-24 znaki!";  
     }
   echo $_POST['newName']; 
 }




?>






</div>

</body>

</html>