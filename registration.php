<?php  

    session_start(); 
    require_once "db_connect.php";
    if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']==true))
    {
        header('Location:menu.php');
        exit();
    }

    if(isset($_POST['reglogin']))
    {
        $flag = true; 

        //Sprawdzenie @
        $email = $_POST['reglogin']; 
        $regpassword = $_POST['regpass']; 
        $regpassword2= $_POST['regpass2']; 
        $regname = $_POST['regname']; 
        $regsurname = $_POST['regsurname'];
        $regtel = $_POST['regtel']; 

        $emailB=filter_var($email, FILTER_SANITIZE_EMAIL); 
// sprawdz maila
        if(($email != $emailB) || (filter_var($emailB, FILTER_VALIDATE_EMAIL)==false))
        {
            $flag = false;
            $_SESSION['e_email'] = "Niepoprawny adres email!";  

        }
// sprawdz haslo1 

        if((strlen($regpassword)<8 || strlen($regpassword)>24))
        {
            $flag = false;
            $_SESSION['e_regpass'] = "Haslo musi posiadać 8-24 znaki!";  
        }

// sprawdz czy haslo1 i 2 sie zgadza

        if($regpassword!=$regpassword2)
        {
            $flag = false;
            $_SESSION['e_regpass2'] = "Hasla nie są identyczne!";  
        }

        $repass_hash = password_hash($regpassword, PASSWORD_DEFAULT);

        if(!isset($_POST['policy']))
        {
            $flag = false;
            $_SESSION['e_policy'] = "Musisz zaakceptowac regulamin!";  
        }
        mysqli_report(MYSQLI_REPORT_STRICT); 
        try
        {
            $connection = @new mysqli($host,$dbuser,$dbpassword,$dbname);
            if($connection->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno()); 
            }
            else
            {
                // czy mail istnieje w bazie? 
                $rezultat = $connection->query("SELECT idclient FROM client WHERE email = '$email'");

                if(!$rezultat) throw new Exception($connection->error); 
                $users_matching = $rezultat->num_rows; 

                if($users_matching>0)
                {
                    $flag = false;
                    $_SESSION['e_email'] = "Istnieje juz konto przypisane do tego adresu!"; 

                }
             

            }

            if($flag==true)
            {
                if($connection->query("INSERT INTO client (name,surname,email,tel,password) VALUES ('$regname', '$regsurname', '$email', '$regtel', '$repass_hash')"))
                {
                    $_SESSION['regsucc'] = true; 
                    header('Location:welcome.php');
                }
                else 
                {
                    throw new Exception($connection->error); 

                }
    
                $_SESSION['regok'] = "Udało sie zarejestrować!";
                echo "000000000000000";
            }

            $connection->close(); 
        }
        catch(Exception $e)
        {
            echo "Blad bazy. Prosze o rejestracje w innym terminie. ";
           // echo "Programmer_message:".$e;
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


<script src="https://www.google.com/recaptcha/enterprise.js?render=6LfL-GEhAAAAAF2h4iwJ_MUu7WlIFXjqZfGW8yP8"></script>
        <script>
        grecaptcha.enterprise.ready(function() {
        grecaptcha.enterprise.execute('6LfL-GEhAAAAAF2h4iwJ_MUu7WlIFXjqZfGW8yP8', {action: 'login'}).then(function(token) {
       ...
        });
        });
</script>
</head>

<body style="background-color:blue; text-align:center; font-size:150%;">
<br>
    <form method = "post" action="">
        
    
        Login(email): <input type="text" name = "reglogin"/> <br>
        <?php 
        if (isset($_SESSION['e_email'])) 
        {
            echo '<div style="color:red; font-size:80%">'.$_SESSION['e_email']."</div>"; 
            unset($_SESSION['e_email']); 
        }
        ?>
        Haslo: <input type="password" name = "regpass"/> <br>
        <?php 
        if (isset($_SESSION['e_regpass'])) 
        {
            echo '<div style="color:red; font-size:80%">'.$_SESSION['e_regpass']."</div>"; 
            unset($_SESSION['e_regpass']); 
        }
        ?>
        Haslo(powtórz): <input type="password" name = "regpass2"/> <br>
        <?php 
        if (isset($_SESSION['e_regpass2'])) 
        {
            echo '<div style="color:red; font-size:80%">'.$_SESSION['e_regpass2']."</div>"; 
            unset($_SESSION['e_regpass2']); 
        }
        ?>
        Imie: <input type="text" name = "regname"/> <br>
        <?php  
        
        ?>
        Nazwisko: <input type="text" name = "regsurname"/> <br>
        <?php   
        
        ?>
        telefon: <input type="text" name = "regtel"/> <br>
        <?php  
        
        ?>

        <label><input type="checkbox" name="policy"> I accept policy</label>
        <?php
        if (isset($_SESSION['e_policy'])) 
        {
            echo '<div style="color:red; font-size:80%">'.$_SESSION['e_policy']."</div>"; 
            unset($_SESSION['e_policy']); 
        }
        ?>
        <br>
        <input type="submit" value="register now"/> <br>

        <?php
        if (isset($_SESSION['regok']))
        {
        echo $_SESSION['regok']; 
            unset($_SESSION['regok']);
        }
        ?>
     
    </form>

    <input type="button" onclick="window.location.href='index.php';" value="mam juz konto"/>
    
</body>

</html>