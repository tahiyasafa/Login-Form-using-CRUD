<?php
    
    session_start();
    $host = "localhost";
    $username ="fred";
    $password = "zap";
    $database = "misc";
    $message  = "";
    try
    {
        $connect = new PDO("mysql:host=$host; dbname=$database",$username,$password);

        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_POST["login"]))
        {
            if(empty($_POST["email"])  || empty($_POST["password"]))
            {
                $message = '<label>All field is required</lable>';
            }
            else
            {
                $salt = "XyZzy12*_";

                 $password = md5($salt.$_POST['password']);
                 echo $password;
                $query = "SELECT * FROM users WHERE email = :email AND password = :password";
                $statement = $connect->prepare($query);
                $statement->execute(
                                array
                                (
                                 'email'   =>   $_POST["email"],
                                 'password'   =>    $password
                                )
                                  );
                $count = $statement->rowCount();
                $query_search = "SELECT user_id FROM users WHERE email = '".$_POST['email']."'";
                $search = $connect->prepare($query_search);
                $search->execute();
                $result=$search->fetchAll(\PDO::FETCH_ASSOC);
                print_r($result);
                if($count > 0)
                {
                    $_SESSION["email"] = $_POST["email"];
                    $_SESSION["id"] = $result[0]["user_id"];
                    echo  $_SESSION["id"];
                    //$_SESSION['user_id'] = mysqli_insert_id($connect);
                    //$id = $connect->lastInsertId () ;
                    //echo $id;
                    //echo "success";
                    setcookie("id", $_SESSION["id"],time()+360000);
                    header("location:Login_success.php");
                }
                else
                {
                    $message = '<label>email OR Password is wrong</label>';
                }
                
            }
        }
    }
    catch(PDOException $error)
    {
      $message =$error->getMessage();
    }
?>
 
<!DOCTYPE html>
 <html>
      <head>
           <title>Safa's Login Page</title>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
           <link rel="stylesheet" 
                href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
                integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
                crossorigin="anonymous">
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
           <link rel="stylesheet" 
                href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
                integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
                crossorigin="anonymous">
      </head>
      <body>
           
                 <?php
                     if(isset($message))
                     {
                      echo '<label class="text-danger">'.$message.'</label>';
                     }
                 ?>
                <div class="container">
                <h1>Please Log In</h1>
                <form method="POST" action="login.php">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email"><br/>
                    <label for="id_1723">Password</label>
                    <input type="password" name="password" id="id_1723"><br/>
                    <input type="submit" name= "login" onclick="return doValidate();" value="Log In">
                    <input type="submit" name="cancel" value="Cancel">
                </form>
                <script>
                    function doValidate()
                    {
                        console.log('Validating...');
                        try
                        {
                            addr = document.getElementById('email').value;
                            pw = document.getElementById('id_1723').value;
                            console.log("Validating addr="+addr+" pw="+pw);
                            if (addr == null || addr == "" || pw == null || pw == "")
                            {
                                alert("Both fields must be filled out");
                                return false;
                            }
                            if ( addr.indexOf('@') == -1 )
                            {
                                alert("Invalid email address");
                                return false;
                            }
                        return true;
                        }
                        catch(e)
                        {
                            return false;
                        }
                    return false;
                    }
                </script>
           </div>
           <br />
      </body>
 </html>


