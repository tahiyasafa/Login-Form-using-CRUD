<?php



 	
 session_start();



 	
 if(isset($_SESSION["username"]))



 	
 {



 	
 	echo '<h3>Login success, welcome - ' .$_SESSION["username"].'</h3>';



 	
 	echo '<br><br><a href="index.php">Logout</a>';



 	



 	
 }else{



 	
 	header("location:index.php");



 	
 }


	

 	
?>
