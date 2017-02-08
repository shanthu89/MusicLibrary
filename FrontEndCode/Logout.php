//clears the session user ID and redirects to login page
<?php
session_start();
unset($_SESSION["userID"]);

header("Location:LoginPage.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        
    </body>
</html>
