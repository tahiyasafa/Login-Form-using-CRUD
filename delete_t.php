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
$link = new PDO("mysql:host=$host; dbname=$database",$username,$password);

if(isset($_SESSION["email"]))
{
    $sql = "SELECT * FROM profiles where profile_id = $profile_id";
    $query = $link->prepare($sql);
    if($query->execute())
    {
    //echo "success ";
    }
    // delete record
    if( isset( $_POST['delete'] ) )
    {

        $did = $_POST['id'];
        $query = $link->prepare( "DELETE FROM profiles WHERE profile_id=$did" );
        //$query->bind_param( "s", $did );
        $query->execute();
        header("location:index.php");
    }
    elseif( isset( $_POST['cancel'] ) )
    {

        header("location:index.php");
    }   
}
else
{
 	    header("location:index.php");
}

// get all records


?>





<div class="container">
<h1>Deleteing Profile</h1>
    <?php

                

        while($result = $query->fetch(PDO::FETCH_ASSOC))
        {
                echo "First Name:<p>" . $result["first_name"] . "<p>";
                echo "Last Name:<p>" . $result["last_name"] . "<p>";
            $id = $result['profile_id'];
            $first_name = $result['first_name'];
            $last_name = $result['last_name'];
            echo "<form method='POST'>
                <input type=hidden name=id value=".$result["profile_id"]." >
                <input type=submit value=Delete name=delete >
                <input type=submit name=cancel value=Cancel>
                </form>";
            
        } 
    ?>
</div>
</body>
</html>