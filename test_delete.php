<!DOCTYPE html>
<html>
<head>
<title>Dr. Chuck's Profile View</title>
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

$link = new PDO("mysql:host=$host; dbname=$database",$username,$password);

// delete record
if( isset( $_POST['delete'] ) ) {

    echo $did = $_POST['id'];
    $query = $link->prepare( "DELETE FROM profiles WHERE profile_id=$did" );
    //$query->bind_param( "s", $did );
    $query->execute();
}

// get all records
$sql = "SELECT * FROM profiles";
$query = $link->prepare($sql);
if($query->execute())
{
    echo "success ";
}

?>

<table border="1">

    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Delete</th>
    </tr>

    <?php

                

        while($result = $query->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr>";
                echo "<td>" . $result["first_name"] . "</td>";
                echo "<td>" . $result["last_name"] . "</td>";
                echo "<td>" . $result["email"] . "</td>";
            $id = $result['profile_id'];
            $first_name = $result['first_name'];
            $last_name = $result['last_name'];
            echo "<td><form method='POST'>
                <input type=hidden name=id value=".$result["profile_id"]." >
                <input type=submit value=Delete name=delete >
                </form>
                </td>";
                echo "</tr>";
            
        } 
    ?>

</table>
</body>
</html>