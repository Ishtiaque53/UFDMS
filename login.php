<?php
    session_start();

    if(!isset($_SESSION['error']))
    {
        $_SESSION['error'] = false;
    }
    
    include("dbcon.php");
    if(isset($_POST["submit"])) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = crypt($password, 'rl');

        $quary = "Select * from `user` WHERE username = '".$username."' AND password = '".$password."'";
        $result = mysqli_query($con, $quary) or die(mysqli_error($con));


        if (mysqli_num_rows($result) > 0) {
            unset($_SESSION['error']);
            // output data of each row
            while ($row = mysqli_fetch_assoc($result))
            {
                if(is_null($row["todate"])){
                    $prev = $row;
                    break;
                }
                $prev = $row;
            }
            $row = $prev;
            $appt = $row["appt"];
            $toDate = $row["todate"];
            $_SESSION['username'] = $username;
            $_SESSION['appt'] = $appt;
            $_SESSION['toDate'] = $toDate;
            switch ($appt) {
                case "QM":
                    header("location:qm_home.php");
                    break;
                case "MT":
                    header("location:mt_home.php");
                    break;
                case "POL":
                    header("location:pol_home.php");
                    break;
                default:
                    header("location:unauthorized.php");
              }
            die;
        } 
        else {
            $_SESSION['error'] = true;
            header("location:login.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UFDMS Login</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    
    <div class="navbar">
        <div class="container">
            <a class="logo" href="#"><span>UNIT FUEL DISPENSING AND<br>MANAGEMENT SYSTEM</span></a>
            
            <img id="mobile-cta" class="mobile-menu" src="Images/menu_icon.svg" alt="Open Navigation">

            <nav>
                <img id="mobile-exit" class="mobile-menu-exit" src="Images/exit.svg" alt="Exit">
                <ul class="primary-nav">
                    <li class="current"><a href="aboutus.php">About Us</a></li>
                    <li class="contact-cta"><a href="contact.php">Contact Us</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <section class="hero">
        <div class="container">
            <div class="left-col">
                <p class="subhead">Welcome</p>
                <img src="Images/User.svg" class="hero-image" alt="User Icon">
                <h1>Please Login</h1>

                <form action="login.php" method="post">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username">

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    <input type="submit" class="login-submit" name="submit" value="Login">
                </form>
                <?php 
                    if($_SESSION['error']) {
                        echo "Sorry, Username or password is incorrect";
                    }
                ?>
                
            </div>
        </div>

    </section>


    <script>

        const mobileBtn = document.getElementById('mobile-cta');
            nav = document.querySelector('nav')
            mobileBtnExit = document.getElementById('mobile-exit');

        mobileBtn.addEventListener('click', () => {
            nav.classList.add('menu-btn');
        })

        mobileBtnExit.addEventListener('click', () => {
            nav.classList.remove('menu-btn');
        })
    </script>



</body>
</html>