<!DOCTYPE html>
<html>
<head>
<title>Safa's Profile View</title>
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
<?php
    session_start();
    $host = "localhost";
    $username ="fred";
    $password = "zap";
    $database = "misc";
    $message  = "";
    $profile_id=$_GET['profile_id'];
    //echo $profile_id;
    $connect = new PDO("mysql:host=$host; dbname=$database",$username,$password);
    if(isset($_SESSION["email"]))
    {
        //echo $profile_id;
        //$results is now an associative array with the result
        $sql = "SELECT * FROM profiles where profile_id = $profile_id";
        $query = $connect->prepare($sql);
        //$query->bindParam(':profile_id', $_SESSION['profile_id']);
        if($query->execute())
        {
            //echo "success";
        }
        while($result = $query->fetch(PDO::FETCH_ASSOC))
        {
            //echo "whhle";
            $id = $result['profile_id'];
            $first_name = $result['first_name'];
            $last_name = $result['last_name'];
            $headline = $result['headline'];
            $email = $result['email'];
            $summary = $result['summary'];
            
        }
    } 
    else
    {
 	    header("location:index.php");
    }
?>

<div class="container">
<h1>Profile information</h1>
<p>First Name:
<?php echo $first_name ?></p>
<p>Last Name:
<?php echo $last_name ?></p>
<p>Email:
<?php echo $email ?></p>
<p>Headline:<br/>
<?php echo $headline ?></p>
<p>Summary:<br/>
<?php echo $summary ?><p>
</p>
<a href="index.php">Done</a>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>
