
<link rel="stylesheet" type="text/css" href="loginStyleSheet.css">
<html lang="en">
<head>
<meta charset="utf-8" />
    <title>LoginPage</title>
    <script>
        //script to load new user registration page on click of sign up button.
        function NewUserRegistrationPage() {
                window.location.assign("NewUserRegister.php");
        }
    </script>
</head>
<body>
    <!--Form contains the login details and action:SELF to load the same page after the form is submitted on Submit button.-->
    <form name="loginform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div id="login_container">
        <h2>Music Library Login Page</h2>
        <h4>Databse Systems Design - TCSS 545 Project</h4>
            <table>
                 <!--User Input fields to capture user entered info-->
                 <tr><td>Username</td></tr>
                 <tr><td><input type="text" name="username" placeholder="Enter your username" class="table"  /></td></tr>
                 <tr><td>Password</td></tr>
                 <tr><td><input type="password" name="password" placeholder="Enter your password" class="table" /></td></tr>
                 <tr><td><br><input type="submit" id="submit" value="Login" name="submit" class="table" ></td></tr>
                 <tr><td><br/></td></tr>
                 <tr><td style="float: right">New User?<button type="button" onclick ="javasript:NewUserRegistrationPage()">Sign Up</button></td></tr>
            </table>
    </div>
    </form>
</body>
</html>
<?php
    //creates session for each user
    session_start();

    //when user submits the form on clicking the submit button, below code is executed in order to authenticate the user by validating the user data in database.

    if(isset($_POST['submit'])) 
    { 
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $error = "Username or Password is invalid";
            echo $error;
        }
        else {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $conn=connectDB();
            //validates if user with the entered credentials exist in database. if yes proceed to next page.
            $query="select * from user where user_name='{$username}' and password= '{$password}'";
            $result=mysqli_query($conn,$query);
            if(mysqli_num_rows($result) > 0 ){

                echo "Success";
                $row=mysqli_fetch_array($result);
                $_SESSION['userID'] = $row['userID'];
                //$_SESSION["user_name"] = $[user_name];

            }
            else{
                echo "<font color='red'><h4><center>Invalid Username or Password!</center></h4></font>";
            }       
        }

        //Once the user is succcessfully validated if user is admin then redirected to MusicLibrary_admin page else to MusicLibrary_user page.
        if(isset($_SESSION['userID'])) {
            if(($_SESSION['userID']) == 1){
                header("Location:MusicLibrary_admin.php");
            }
            else{
                header("Location:MusicLibrary_user.php");        
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
