<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <title>Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="All Files/CSS/account.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <!-- Account Page -->
    <div class="account-page">
        <div class="form-container">
            <div class="form-btn">
                <span onclick="login()">Login</span>
                <span onclick="register()">Register</span>
                <hr id="indicator">
            </div>
            <form id="registerationForm" action="" method="POST">
                <input type="text" name="name" autocomplete="OFF" placeholder="Username" required>
                <input type="email" name="email" autocomplete="OFF"  placeholder="Enter your email" required>
                <input type="password" name="password" autocomplete="OFF" placeholder="Password" required>
                <button type="submit" name="submit1" class="btn">Register</button>
            </form>
            <form id="loginForm" action="" method="POST">
                <input type="text" name="name" id="UserName" autocomplete="OFF" placeholder="Username" required>
                <input type="password" name="password" autocomplete="OFF" placeholder="Password" id="password" required>
                <div class="loginformcheckbox"><input type="checkbox" checked>Remember Me</input></div>
                <a href="All Files/Forgetpswrd.php" class="forget" target="_blank">Forget Password</a>
                <button type="submit" name="submit" class="btn">Login</button>
            </form>
        </div>
    </div>

    <!-- JS of Account page -->
    <script>
        const loginForm = document.getElementById("loginForm");
        const registerationForm = document.getElementById("registerationForm");
        const indicator = document.getElementById("indicator");   
        function register() {
            registerationForm.style.transform = "translateX(0px)";
            loginForm.style.transform = "translateX(0px)";
            indicator.style.transform = "translateX(100px)";
        }
        function login() {
            registerationForm.style.transform = "translateX(35rem)";
            loginForm.style.transform = "translateX(35rem)";
            indicator.style.transform = "translateX(0px)";
        }
    </script>
</body>
</html>


<!-- Registeration page php -->
<?php
    $con=mysqli_connect('localhost','root','');
    mysqli_select_db($con,'myownproject') or die('Please check database');
    if(isset($_POST['submit1']))
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];

        $namequery="select * from registration where name='$name'";
        $int=mysqli_query($con,$namequery);
        $namecount=mysqli_num_rows($int);
        if($namecount>0)
        {
            echo'<script type="text/javascript" >alert("Username already exist")</script>';
        }
        else
        {
            $emailquery="select * from registration where email='$email'";
            $int=mysqli_query($con,$emailquery);
            $emailcount=mysqli_num_rows($int);
            if($emailcount>0)
            {
                echo'<script type="text/javascript" >alert("Email already exist")</script>';
            }
            else
            {
                $query="insert into registration(name,email,password)values('$name','$email','$password')";
                $ins=mysqli_query($con,$query);
                if($ins==1)
                {
                    echo'Registered Successfully';
                    header('location: All Files/Home.php');             
                    // echo'<script type="text/javascript" >alert("Registered Successfully")</script>';
                }
                else
                {
                    echo"Try again";
                }
            }
        }
    }
?>

<!-- Login page php -->
<?php
    $con=mysqli_connect('localhost','root','');
    mysqli_select_db($con,'myownproject') or die('Please check Database');
    if(isset($_POST['submit']))
    {
        $name=$_POST['name'];
        $password=$_POST['password'];

        $name_count1="select * from registration where name='$name' ";
        $query1= mysqli_query($con,$name_count1);
        $name_sun1=mysqli_num_rows($query1);
        if($name_sun1==1)
        {
            $namepass= mysqli_fetch_assoc($query1);
            $_SESSION['name']= $namepass['name'];

            $name_count="select * from registration where password='$password' ";
            $query= mysqli_query($con,$name_count);
            $name_sun=mysqli_num_rows($query);
            if($name_sun==1)
            {
                echo'Login sucessfully';
                header('location:All Files/Home.php');
            }
            else
            {
                echo'<script type="text/javascript" >alert("Incorrect password")</script>';
            }
        }
        else
        {
            echo'<script type="text/javascript" >alert("Invalid Username")</script>';
        }
    }
?>