<?php
   include("connection.php");
    session_start(); 
    $welcomeText = "";
    if(isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
        $sql = "SELECT firstName, middleName, lastName  FROM members WHERE username = '${username}'";
        $result = mysqli_query($db,$sql);
        $user = "";
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc())
            {
                $user = $row;
            }
        }
        $welcomeText = "Welcome " . $user['firstName']." " . $user['middleName'] . " " . $user['lastName'];
    }
    // if(isset($_SERVER["REQUEST_METHOD"]) == "POST")
    // {
 
    //     session_unset();
    //     session_destroy();
    // } 
?>

<!DOCTYPE html>
<html>
    <head>
        <link href = "style.css" rel = "stylesheet">
    </head>

    <nav>
        <?php include 'navbar.html';?>
    </nav>  
    <body>
    <h2>homepage</h2>
    <form action="" method="POST">
    	<input style="
    margin-left: 45%;
    text-align: center;
    
    " type="submit" name="logout" value="LOGOUT">
    </form>
    <h1 style="
    margin: 15% auto;
    text-align: center;
    
    "><?=$welcomeText?></h1>
    
    </body>
    
    <footer>
        <?php include 'footer.html';?>
    </footer>
</html>