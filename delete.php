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
    echo $profile_id;
    $connect = new PDO("mysql:host=$host; dbname=$database",$username,$password);
    if(isset($_SESSION["email"]))
    {
        echo "in sesson ";
        //echo $profile_id;
        //$results is now an associative array with the result
        $sql = "SELECT * FROM profiles where profile_id = $profile_id";
        $query = $connect->prepare($sql);
        //$query->bindParam(':profile_id', $_SESSION['profile_id']);
        if($query->execute())
        {
            echo "success ";
        }
        while($result = $query->fetch(PDO::FETCH_ASSOC))
        {
            echo "while";
            $id = $result['profile_id'];
            $first_name = $result['first_name'];
            $last_name = $result['last_name'];
            
            
        }
        if( isset( $_GET['delete'] ) ) {
            //echo $did = $_POST['profile_id'];
            $id = $_GET['delete'];
            $query = $connect->prepare( "DELETE FROM `profiles` WHERE `profiles`.`profile_id` = $profile_id" );
            //$query->bind_param( "s", $did );
            $query->execute();
            header("location:index.php");
        }
        if( isset( $_GET['cancel'] ) ) {

            header("location:index.php");
        }
    } 
    else
    {
 	    header("location:index.php");
    }
?>


<div class="container">
<h1>Deleteing Profile</h1>
<form method="get" action="delete.php">
<p>First Name:
<?php echo $first_name ?></p>
<p>Last Name:
<?php echo $last_name ?></p>
<input type="hidden" name="profile_id"
value="3503"
/>
<input type="submit" name="delete" value="Delete">
<input type="submit" name="cancel" value="Cancel">
</p>
</form>
</div>
</body>




<div class="container">
<h1>Profile information</h1>
<p>First Name:
<?php echo $first_name ?></p>
<p>Last Name:
<?php echo $last_name ?></p>

</p>
<a href="index.php">Done</a>
</div>
</body>
</html>
