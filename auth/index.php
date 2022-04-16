<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="../assets/favicon.png"/>
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="../common/styles/index.css">
    <title>Log in</title>
</head>
<body>
<div class="main_container">
    <div class="login_card card">
        <!--header-->
        <div>
            <div class="title_image_container">
                <img src="../assets/header_logo.png" class="title_image">
            </div>
            <div class="label_container">
                <p class="primary_text_size primary_text_color title regular">
                    Login
                </p>
                <p class="subtitle secondary_text_size primary_text_color semi_bold">
                    to continue using the service.
                </p>
            </div>
        </div>
        <form method="post" action="">
        <!--input areas-->
        <div class="input_container">
            <script>

            </script>

            <?php

            if(isset($_POST['login'])){
                //session
                if(isset($_SESSION['username'])!==''){
                    header('location:');
                    session_start();
                    session_destroy();
                }
                session_start();

                //include connection file

                include '../connect.php';
                //get username and password
                $username = mysqli_real_escape_string($conn,$_POST['username']);
                $password = mysqli_real_escape_string($conn,$_POST['password']);
                $password_hash = hash('sha256',$password);
                $check_credentials_correct = mysqli_query($conn,"SELECT * FROM hospitals_login WHERE username = '$username' AND password = '$password_hash'");
                if (mysqli_num_rows($check_credentials_correct) === 0 ){
                    echo "<font color='red'><b>Username or Password Incorrect</b></font>";
                }else if (mysqli_num_rows($check_credentials_correct) >= 1){
                    date_default_timezone_set('Asia/Kathmandu');
                    $set_logged_in_time = mysqli_query($conn,"UPDATE hospitals_login SET 'last_login' = date('Y-m-d h:i:s') WHERE username ='$username' AND password = '$password_hash'");
                    $_SESSION['username']= $username;

                    header('Location: ../dashboard');
                }

            }
            ?>
            <input class="input_box primary_text_color semi_bold" autofocus placeholder="Username" type="text" name="username" required><br>
            <input class="input_box primary_text_color semi_bold" placeholder="Password" type="password" name="password" required><br>
        </div>


        <p class="additional_label secondary_text regular">
            Log in with the username and password provided by the service provider.
        </p>

        <!--login button-->
        <div class="login_button_container">
            <input type="submit" class="button rectangle_button blue_button button_small" name="login" value="Log in">

        </div>
        </form>
    </div>

</div>
</body>
</html>