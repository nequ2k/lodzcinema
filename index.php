<?php  session_start();  ?>
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

<h1> Logowanie </h1>


<form action="zaloguj.php" method="post">
login: <input type="text" name="login" ><br><br>
haslo: <input type="password" name="haslo"><br><br>
<input type="submit" value="zaloguj">
</form>

<?php 
   if(isset($_SESSION['blad'])) echo $_SESSION['blad']; 
?>


</body>

</html>