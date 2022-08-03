<html>
    <?php
    include("connection.php");
    session_start(); 
    $username = "";
    $firstNameValue = "";
    $middleNameValue = "";
    $lastNameValue = "";
    $emailValue = "";
    $phoneValue = "";
    $addressValue = "";
    $dayValue = "";
    $monthValue = "";
    $yearValue = "";
    $genderValue = "";
    $password1Value = "";
    $password2Value = "";
    $oldPasswordValue = "";
    $errorMassege = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $gender = $_POST['gender'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $oldPassword = $_POST['oldPassword'];
        $username = $_SESSION['username'];
        $sql = "
        SELECT username, password
        FROM members 
        WHERE username = '$username'
        ";
        $no_of_month = array("
            January" => "1","February" => "2", "March" => "3", 
            "April" => "4", "May" => "5", "June" => "6",
            "July" => 7, "August" => 8, "September" => 9,
            "October" => "10", "November" => "11", "December" => "12"
        );
        $dob = $year."-".$no_of_month[$month]."-".$day;
        $result = mysqli_query($db,$sql);
        $user = "";
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc())
            {
                $user = $row;
            }
        }
        
        if($password2 !== $password1)
        {
            $errorMassege = "Both Password not match\n";
            $firstNameValue = $firstName;
            $middleNameValue = $middleName;
            $lastNameValue = $lastName;
            $emailValue = $email;
            $phoneValue = $phone;
            $addressValue = $address;
            $dayValue =  $day;
            $monthValue = $month;
            $yearValue = $year;
            $genderValue = $gender;
            $password1Value = $password1;
            $password2Value = $password2;
            $oldPasswordValue = $oldPassword;
        }
        elseif($user['password'] !== $oldPassword)
        {
            $errorMassege = "Wrong Password\n";
            $firstNameValue = $firstName;
            $middleNameValue = $middleName;
            $lastNameValue = $lastName;
            $emailValue = $email;
            $phoneValue = $phone;
            $addressValue = $address;
            $dayValue =  $day;
            $monthValue = $month;
            $yearValue = $year;
            $genderValue = $gender;
            $password1Value = $password1;
            $password2Value = $password2;
            $oldPasswordValue = $oldPassword;
        }
        else if($day == "" || $month == "" || $year == "" || $gender == "")
        {
            $errorMassege = "Select Date of birth and Gender correctly!\n";
            $firstNameValue = $firstName;
            $middleNameValue = $middleName;
            $lastNameValue = $lastName;
            $emailValue = $email;
            $phoneValue = $phone;
            $addressValue = $address;
            $dayValue =  $day;
            $monthValue = $month;
            $yearValue = $year;
            $genderValue = $gender;
            $oldPasswordValue = $oldPassword;
            $password1Value = $password1;
            $password2Value = $password2;
        }
       else
        {
            if($password1 == "")
            {
                $password1 = $user['password'];
            }

            $sql = "
            UPDATE members 
                SET 
                firstName = '$firstName',
                middleName = '$middleName',
                lastName = '$lastName',
                email = '$email',
                phone = '$phone',
                address = '$address',
                dob = '$dob',
                gender = '$gender',
                password = '$password1'
            WHERE
                username = '$username'";

             if(mysqli_query($db,$sql))
             {
                 header("location: user_profile.php");
             }
             else
             {
                $errorMassege = "Something went Wrong";
             }
        }

    }
    elseif(isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
        $sql = "SELECT username, firstName, middleName, lastName, email, phone, address, dob, gender, password  FROM members WHERE username = '${username}'";
        $result = mysqli_query($db,$sql);
        $user = "";
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc())
            {
                $user = $row;
            }
        }
        $firstNameValue = $user['firstName'];
        $middleNameValue  = $user['middleName'];
        $lastNameValue  = $user['lastName'];
        $emailValue  = $user['email'];
        $phoneValue  = $user['phone'];
        $addressValue  = $user['address'];
        $genderValue = $user['gender'];
        $password1Value = $user['password'];
        $password2Value = $user['password'];
        $temp = $user['dob'];
        
        $yearValue = $temp[0].$temp[1].$temp[2].$temp[3];
        $monthN = $temp[5].$temp[6];
        $dayValue = $temp[8].$temp[9];

        $the_month = array(
            "1" => "January","2" => "February", "3" => "March" , 
            "4" => "April", "5" => "May","6" => "June",
            "7" => "July" , "8" => "August", "9"=>"September",
            "10" => "October" , "11" => "November" , "12" => "December"
        );
        $monthValue = $the_month[$monthN];

    }     
    else
    {
         header("location: user_login.php");
    }
    ?>


    <nav>
        <?php include 'navbar.php';?>
    </nav> 
    <head>
         <link href = 'CSS/registration.css' rel='stylesheet'>
    </head>
    <body>
       <div class = 'top'>
           <h1>UPDATE INFORMATION<h1>
       </div>

        <!-- FORM  START-->
         <section class = 'loginPanel'>
            <form action="" method="POST">
                <div class="gap"></div>
            <!-- NAME START-->
            <div class = 'threeElement'>
                <div class = 'eachOFTheree'>
                    <label>First Name</label><br>
                    <input type="text" name = 'firstName' value = '<?=$firstNameValue?>' required>
                </div>
                 <div class = 'eachOFTheree'>
                    <label>Middle Name</label><br>
                    <input type="text" name = 'middleName' value = '<?=$middleNameValue?>' required>
                </div>
                 <div class = 'eachOFTheree'>
                    <label>Last Name</label><br>
                    <input type="text" name = 'lastName' value = '<?=$lastNameValue?>' required>
                </div>
            </div>
             <!-- NAME END -->
             <div class="gap"></div>
             <div class = 'threeElement'>
                <div class = 'eachOFTheree' >
                    <label>Email</label><br>
                    <input type="text" name = 'email' value = '<?=$emailValue?>' required>
                </div>
                <div class = 'eachOFTheree' >
                     <label>Phone No.</label><br>
                    <input type="text" name = 'phone' value = '<?=$phoneValue?>' required>
                </div>
                <!-- ADDRESS -->

                 <div class = 'eachOFTheree'>
                     <label>Address</label><br>
                    <input type="text" name = 'address' value = '<?=$addressValue?>' required>
                </div>
                <!-- ADDRESS -->


                <div class="gap"></div>

            <div class= 'threeElement'>    

                <div class = 'eachOFTheree'>
                     <label for="month">Date of Birth</label><br>
                      <select name="day" id="day">
                        <option value='<?=$dayValue?>'> <?=(string)$dayValue?> </option>
                       <?php
                            for($i = 1; $i<=31; $i++)
                            {
                                echo "<option value=$i>$i</option>";
                            }
                        ?>
                    </select>
                     <select name="month" id="month">
                        <option value='<?=$monthValue?>'><?=$monthValue?></option>
                       <?php
                            $day_of = 31;
                            $months = array("January" => 31, "February" => 28, "March" => 31, "April" =>30, "May" =>31, "June"=>30, "July"=>31, "August"=>31, "September"=>30, "October"=>31, "November"=>30, "December"=>31);
                            foreach ($months as $key => $value) {
                            
                                 echo "<option value='$key'>$key</option>";
                            }
                        ?>
                    </select>
                     <select name="year" id="year">
                        <option value="<?=$yearValue?>"><?=$yearValue?></option>
                       <?php
                            for($i = 2022; $i>=1980; $i--)
                            {
                                echo "<option value=$i>$i</option>";
                            }
                        ?>
                    </select>
                   
                </div>
                <!-- DOB -->
                <div class = 'eachOFTheree'>
                    <label for="gender">Select Gender</label><br>
                    </select>
                     <select name="gender" id="gender">
                        <option value="<?=$genderValue?>"><?=$genderValue?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Hidden">Hidden</option>
                    </select>
                </div>  

                 <!-- <div class = 'eachOFTheree'>
                    <label for="month">Select Gender</label><br>
                    </select>
                     <select name="gender" id="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="hidden">Hidden</option>
                       
                    </select>
                </div>  -->
            </div> 
            <div class="gap"></div>

            <!-- USERNAME PASSWORD -->
            <div class = 'threeElement'>
                <div class = 'eachOFTheree' >
                    <label>Change Password</label><br>
                    <input type="password" name = 'password1' value = '<?=$password1Value?>' minlength="5" maxlength="15" required>
                </div>
                <div class = 'eachOFTheree' >
                     <label>Confirm Password</label><br>
                    <input type="password" name = 'password2' value = '<?=$password2Value?>' minlength="5" maxlength="15" required>
                </div>
                 <div class = 'eachOFTheree'>
                     <label>Enter Old Password</label><br>
                    <input type="password" name = 'oldPassword'minlength="5" value = '<?=$oldPasswordValue?>' maxlength="15"  required>
                </div> 
            </div>     
            <!-- USERNAME PASSWORD -->

            <div class='error'>
                <p><?=$errorMassege?></p>
            </div>
            <input class= 'loginButton' type="submit" name="submit" value="Update">
         </form>
           <!-- FORM  END-->
        </section>
    </body>
    <footer>
     <?php include 'footer.html';?>
 </footer>
</html>