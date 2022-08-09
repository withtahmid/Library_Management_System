<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/admin_nav.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<header>
    <a class="logo" href=""><img src="images/logo.svg" alt="logo"></a>
    <nav>
        <?php
        if(isset($_SESSION['admin_username']))
        {
            $username = $_SESSION['admin_username'];
            echo "<div class = 'dropdown' >
                    <div class='usernameHead'> 
                         <a href = 'admin_portal.php'><div class = 'txt'>
                            <p>$username<p>
                         </div></a>
                         <img src = 'images/avater.png' hight = '55' width = '55'>
                    </div>
                     <div class='dropdown-content'style = ' width:200px; margin-left: 230px'>
                        <a href='admin_portal.php'>Admin Panel</a>
                        <a href='admin_profile.php'>My Account</a>
                        <a href='admin_memberlist.php'>Member List</a>
                        <a href='admin_booklist.php'>Book List</a>
                        <a href='logout.php'>Logout</a>
                      </div>
                </div>
                ";
        }
        else
        {
            echo "
            <ul class='top-nav' style = 'margin-left: 170px'>
                <li class='top-nav' id='button'><a id='registration' href='user_login.php'> Go User Mode</a></li>        
             </ul>
            ";
        }
        ?> 
        <ul class="bottom-nav">
            <li class="menu"><a href="index.php">Search</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Services</a>
                <div class="dropdown-content">
                    <a class="dropdown-item" href="services.php">Using the library</a>
                    <a class="dropdown-item" href="services.php">Membership</a>
                    <a class="dropdown-item" href="services.php">Borrowing and returns</a>
                </div>
            </li>
            <li class="menu"><a href="locations.php">Hours & Locations</a></li>
            <li class="menu"><a href="about.php">About</a></li>
        </ul>
    </nav>
    </header>
</html> 
