<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="../assets/favicon.png"/>
    <link rel="stylesheet" href="./styles/new_entry_form.css">
    <link rel="stylesheet" href="../common/styles/index.css">
    <title>New Entry Form</title>
</head>
<body>
<div class="main_contents_wrapper new_entry_content_wrapper">
    <div class="round_button_container">
        <a class="round_button_dark" onClick="goBack();" >
            <img class="icon" src="../assets/back.png">


        </a>          <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </div>
    <?php
    include '../connect.php';
    session_start();
    $username=$_SESSION['username'];

    if(!$username){
        session_destroy();
        header('location:../auth');
    }
    ?>

    <div class="card new_entry_card">
        <form method="get" action="x-ray_input.php" >
        <div>
            <!--header-->
            <div class="header_actions">
                <img src="../assets/personal_info.png" class="icon header_icon">
                <h2 class="secondary_text_color primary_text_size">Personal Information</h2>
            </div>

            <!--input forms-->
            <div class="input_field_container">

                <div class="input_collection">
                    <div class="input_contents large_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title">First Name</h6>
                        <input type="text" name="fname" autofocus class="input_field large_input_field" required>
                    </div>
                    <div class="input_contents large_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title">Middle Name</h6>
                        <input type="text" name="mname" class="input_field large_input_field">
                    </div>
                    <div class="input_contents large_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title" >Last Name</h6>
                        <input type="text" name="lname" class="input_field large_input_field" required>
                    </div>
                </div>


                <div class="input_collection">
                    <div class="input_contents small_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title">Age</h6>
                        <input type="text" name="age" class="input_field large_input_field" required>
                    </div>
                    <div class="input_contents medium_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title">Date of Notice</h6>
                        <input type="text" name="date_of_notice" placeholder = "Y-m-d" class="input_field large_input_field" required>
                    </div>
                </div>
            </div>


        </div>
        <div>
            <!--header-->
            <div class="header_actions">
                <img src="../assets/contact.png" class="icon header_icon">
                <h2 class="secondary_text_color primary_text_size">Contact</h2>
            </div>

            <!--input forms-->
            <div class="input_field_container">

                <div class="input_collection">
                    <div class="input_contents large_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title">Mobile Number</h6>
                        <input type="text" name="mobile" class="input_field large_input_field" required>
                    </div>
                    <div class="input_contents large_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title">Email</h6>
                        <input type="text" name="email"class="input_field large_input_field" >
                    </div>
                </div>


                <div class="input_collection">
                    <div class="input_contents large_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title">Temporary Address</h6>
                        <input type="text" name="temporary_address" class="input_field large_input_field" required>
                    </div>
                </div>
                <div class="input_collection">
                    <div class="input_contents large_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title">Permanent Address</h6>
                        <input type="text" name="permanent_address" class="input_field large_input_field" required>
                    </div>
                </div>
            </div>


        </div>

        <div class="button_container">
            <input type="submit" class="button rectangle_button blue_button button_small" name ="next-page" value="Next">
        </div>
    </form>
    </div>

</div>
</body>
</html>