<?php
    //creates session for each user
    session_start();
    //when user submits the form on clicking the Register button ,below code is executed in order to validate and create new user in the database.
    if(isset($_POST['register'])) 
    { 
        //To validate if any of the fields are empty.  
        if (empty($_POST['user_name']) || empty($_POST['password']) || empty($_POST['first_name']) || empty($_POST['last_name'])){
            echo "<font color='red'><h4><center>Please enter all details to register!</center></h4></font>";
            
            
        }
        //if not extract all info submitted and store in variables.
        else {
            $user_name = $_POST['user_name'];
            $password = $_POST['password'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $conn=connectDB();
            // to check if user with same username already exists.
            $query="select * from user where user_name='{$user_name}';";
            $result=mysqli_query($conn,$query);            
            if(mysqli_num_rows($result) > 0 ){
                
                echo "<font color='red'><h4><center>User name already used! Please try another username.</center></h4></font>";
            }
            // if the username does not exist create an entry for the new user registered.
            else {
                $query = "INSERT INTO user (user_name, password, first_name, last_name) VALUES ('{$user_name}', '{$password}', '{$first_name}', '{$last_name}')";
               
                if (!mysqli_query($conn, $query))
                {
                    $error = mysqli_error($conn);
                    echo $error;
                }
                echo "<font color='green'><h4><center>Registered Successfully!</center></h4></font>";
                echo "Click here to <a href='LoginPage.php' title='LoginPage'>Login";
                
               return;
            }       
        }
     
    }
    //function to connect to the db with login details and the database selection.
    //Modify the localhost,username,password,database name as per individual credentials.
    function connectDB()
    {
        $conn = mysqli_connect("localhost:3306", "root", "shanthu89", "dbproject");   
        //echo"connected DB"     ;
        if (!$conn) 
        {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        return $conn;
    }
?>


<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="loginStyleSheet.css">
    <head>
        <meta charset="utf-8" />
        <title></title>
        
    </head>
    <body>
    <!--Form contains the registration details and action:SELF to load the same page after the form is submitted on Register button.-->
    <form name="newuser_login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div id="login_container">
    <h2>New User Registration</h2>
    <table >
         <tr><td>Username</td>             
         <tr><td><input type="text" name="user_name" placeholder="Enter your username" class="table"/></td></tr>
         <tr><td>Password</td></tr>
         <tr><td><input type="password" name="password" placeholder="Enter your password" class="table"/></td></tr>        
         <tr><td>First Name</td></tr>
         <tr><td><input type="text" name="first_name" placeholder="Enter your First Name" class="table"/></td></tr>    
         <tr><td>Last Name</td></tr>
         <tr><td><input type="text" name="last_name" placeholder="Enter your Last Name" class="table"></td></tr>
         <tr><td><br/></td></tr>
         <tr><td><input type="submit" value="Register" name="register" class="table"></td></tr>
         </table>
         </div>
     </form>
     </body>
</html>
