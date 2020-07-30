<html>
<head>
<title>Safa's Resume Registry</title>

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
<h1>Safa's Resume Registry</h1>
<?php
if (array_key_exists("logout", $_GET)) {
        
    unset($_SESSION);
    setcookie("id", "", time() - 60*60*60);
    $_COOKIE["id"] = "";
    echo "logged out";
    
    
    
} 
if(!(array_key_exists("id", $_COOKIE) AND $_COOKIE['id']))
{
    echo "<p>Please<a href='login.php'> LOG IN</a></p>";
}
else if ( (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
    if (array_key_exists("id", $_COOKIE)) {
    
        session_start();
        $_SESSION['id'] = $_COOKIE['id'];
        
    }
    if (array_key_exists("id", $_SESSION)) {
    
        echo '<h3>Login success, welcome - ' .$_SESSION["email"].'</h3>';
        echo "<p>Logged In! <a href='index.php?logout=1'>Log out</a></p>";
        
    }
    
    
}
$host = "localhost";
$username ="fred";
$password = "zap";
$database = "misc";
$message  = "";
$pdo = new PDO("mysql:host=$host; dbname=$database",$username,$password);


$query = $pdo->prepare("SELECT * FROM profiles");
$query->execute();


?>


<table border="1">
<tr><th>Name</th><th>Headline</th>
<?php
if (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])
{
    echo "<th>Action</th>";
}
?>
<tr>


<tr>
<?php
while($row = $query->fetch(PDO::FETCH_ASSOC)){
    $id = $row['profile_id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $headline = $row['headline'];
    echo "<td>
    <a href='view.php?profile_id=$id'>$first_name $last_name</a></td><td>
    $headline</td>";
    if (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])
    {
        echo "<td>
        <a href='edit.php?profile_id=$id'>Edit</a> <a href='delete_t.php?profile_id=$id'>Delete</a></td>";  
    }
    echo "</tr>";
}
?>
<?php

?>
</table>
<?php
if (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])
{
    echo "<p><a href='add.php'>Add New Entry</a></p>";
}
?>

</div>
</body>