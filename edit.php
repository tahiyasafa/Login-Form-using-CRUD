
<!DOCTYPE html>
<html>
<head>
<title>Safa's Profile Edit</title>
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
<script type="text/javascript">
    $(document).ready(function() {
      $('.form_error').hide();
      $('#submit').click(function(){
           var email = $('#email').val();
            if(IsEmail(email)==false){
                $('#invalid_email').show();
                return false;
            }

           
            
            
          });
      });
      function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }
</script>
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
           // echo " success ";
        }
        while($result = $query->fetch(PDO::FETCH_ASSOC))
        {
            //echo " while ";
            $id = $result['profile_id'];
            $first_name = $result['first_name'];
            $last_name = $result['last_name'];
            $headline = $result['headline'];
            $email = $result['email'];
            $summary = $result['summary'];
            
        }
        if( isset( $_POST['save'] ) )
        {

            echo $_POST[' email'];
            $sql = "UPDATE profiles set  first_name='" . $_POST['first_name'] . "', last_name='" . $_POST['last_name'] . "', email='" . $_POST['email'] . "',headline='" . $_POST['headline'] . "' ,summary='" . $_POST['summary'] . "' WHERE profile_id='" . $_POST['profile_id'] . "'";
            $query = $connect->prepare( $sql);
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
?>
<div class="container">
<h1>Editing Profile for UMSI</h1>
<form method="post" action="edit.php">
<p>First Name:
<input type="text" name="first_name" size="60"
value="<?php echo $first_name; ?>">
<br>
</p>
<p>Last Name:
<input type="text" name="last_name" size="60"
value="<?php echo $last_name; ?>"
/></p>
<p>Email:
/></p>
<input name="email" class="email" id="email" type="text" class="contact-input" value="<?php echo $email; ?>"/><span class="form_error"></span>
<span class="form_error" id="invalid_email">This email is not valid</span></td>
<p>Headline:<br/>
<input type="text" name="headline" size="80"
value="<?php echo $headline; ?>"
/></p>
<p>Summary:<br/>
<textarea name="summary" rows="8" cols="80">
<?php echo $summary; ?>
</textarea>
<p>
<input type="hidden" name="profile_id"
value="<?php echo $id; ?>"
/>
<input type="submit" name="save" value="Save">
<input type="submit" id="submit" name="cancel" value="Cancel">
</p>
</form>
</div>
</body>
</html>
