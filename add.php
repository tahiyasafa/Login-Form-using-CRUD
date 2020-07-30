<?php
    
    session_start();
    $host = "localhost";
    $username ="fred";
    $password = "zap";
    $database = "misc";
    $message  = "";
    //echo $_SESSION["id"];
try
    {
        $connect = new PDO("mysql:host=$host; dbname=$database",$username,$password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_POST["signup"]))
        {
            if(empty($_POST["email"])  || empty($_POST["summary"]))
            {
                $message = '<label>All field is required</lable>';
            }
            else
            {
                if(isset($_SESSION["email"]))
                {
                    
    
                } 
                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                $email = $_POST["email"];
                $headline = $_POST["headline"];
                $summary = $_POST["summary"];
                $user_id = $_SESSION["id"];
                $query = "insert into profiles(user_id,first_name,last_name,email,headline,summary)values(:user_id,:first_name,:last_name,:email,:headline,:summary)";
                $insert = $connect->prepare($query);

                $insert->bindParam(':user_id',$user_id);
                $insert->bindParam(':first_name',$first_name);
                $insert->bindParam(':last_name',$last_name);
                $insert->bindParam(':email',$email);
                $insert->bindParam(':headline',$headline);
                $insert->bindParam(':summary',$summary);
                $insert->execute();
                header("location:index.php");
                echo "success";
                
            }
        }
        else if(isset($_POST["cancel"]))
        {
            header("location:index.php");
        }
    }
    catch(PDOException $e)
    {
      echo "error".$e->getMessage();
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Safa's Profile Add</title>
<!-- bootstrap.php - this is HTML -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
    crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
    crossorigin="anonymous">

</head>
<body>
<div class="container">
<h1>Adding Profile for UMSI</h1>
<form method="post">
<p>First Name:
<input type="text" name="first_name" size="60"/></p>
<p>Last Name:
<input type="text" name="last_name" size="60"/></p>
<p>Email:
<input type="text" name="email" size="30"/></p>
<p>Headline:<br/>
<input type="text" name="headline" size="80"/></p>
<p>Summary:<br/>
<textarea name="summary" rows="8" cols="80"></textarea>
<p>
<input type="submit" name="signup" value="Add">
<input type="submit" name="cancel" value="Cancel">
</p>
</form>
</div>
</body>
</html>
