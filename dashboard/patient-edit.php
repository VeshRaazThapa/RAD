<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="../assets/favicon.png"/>
    <link rel="stylesheet" href="./styles/new_entry_form.css">
    <link rel="stylesheet" href="../common/styles/index.css">
    <title>Edit Patient</title>
</head>
<body>
<div class="main_contents_wrapper new_entry_content_wrapper">
    <div class="round_button_container">
        <a class="round_button_dark" href="index.php" >
            <img class="icon" src="../assets/back.png">


        </a>
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
        <?php
        include '../connect.php';
        $id = $_GET['id'];
        $get = mysqli_query($conn,"SELECT * FROM patients WHERE id='$id'");
        $row = mysqli_fetch_assoc($get);
        $fname = $row['patient_fname'];
        $mname = $row['patient_mname'];
        $lname = $row['patient_lname'];
        $age = $row['patient_age'];
        $date_of_notice = $row['date_of_notice'];
        $contact = $row['contact_no'];
        $email = $row['email'];
        $temporary_address = $row['temporary_address'];
        $permanent_address = $row['permanent_address'];
        ?>
        <form method="post" action="" >
            <?php

            if(isset($_POST['save'])){
                $fname = $_POST['fname'];
                $mname = $_POST['mname'];
                $lname = $_POST['lname'];
                $age = $_POST['age'];
                $date_of_notice = $_POST['date_of_notice'];
                $mobile = $_POST['mobile'];
                $email = $_POST['email'];
                $temporary_address = $_POST['temporary_address'];
                $permanent_address = $_POST['permanent_address'];
                $query = mysqli_query ($conn,"UPDATE patients SET patient_fname ='$fname', patient_mname='$mname', patient_lname='$lname', patient_age='$age',date_of_notice='$date_of_notice',email='$email',contact_no='$mobile',temporary_address='$temporary_address',permanent_address='$permanent_address' WHERE id='$id'");
                if($query){
                    ?>
                    <script>alert("Edited Successfully");</script>
            <?php
                }else{
                    ?>
                    <script>alert("Edit Unsuccessful");</script>
        <?php
                }
            }

            ?>
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
                        <input type="text" name="fname" value="<?php echo $fname; ?>" autofocus class="input_field large_input_field" required>
                    </div>
                    <div class="input_contents large_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title">Middle Name</h6>
                        <input type="text" name="mname"  value="<?php echo $mname; ?>" class="input_field large_input_field">
                    </div>
                    <div class="input_contents large_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title" >Last Name</h6>
                        <input type="text" name="lname" value="<?php echo $lname; ?>" class="input_field large_input_field" required>
                    </div>
                </div>


                <div class="input_collection">
                    <div class="input_contents small_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title">Age</h6>
                        <input type="text" name="age" value="<?php echo $age; ?>" class="input_field large_input_field" required>
                    </div>
                    <div class="input_contents medium_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title">Date of Notice</h6>
                        <input type="text" name="date_of_notice" value="<?php echo $date_of_notice; ?>" placeholder = "Y-m-d" class="input_field large_input_field" required>
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
                        <input type="text" name="mobile" value="<?php echo $contact; ?>" class="input_field large_input_field" required>
                    </div>
                    <div class="input_contents large_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title">Email</h6>
                        <input type="text" name="email" value="<?php echo $email; ?>" class="input_field large_input_field" >
                    </div>
                </div>


                <div class="input_collection">
                    <div class="input_contents large_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title">Temporary Address</h6>
                        <input type="text" name="temporary_address" value="<?php echo $temporary_address; ?>" class="input_field large_input_field" required>
                    </div>
                </div>
                <div class="input_collection">
                    <div class="input_contents large_input_field">
                        <h6 class="secondary_text_color tertiary_text_size input_field_title">Permanent Address</h6>
                        <input type="text" name="permanent_address" value="<?php echo $permanent_address; ?>" class="input_field large_input_field" required>
                    </div>
                </div>
            </div>


        </div>

        <div class="button_container">
            <input type="submit" class="button rectangle_button blue_button button_small" name ="save" value="Save">
        </div>
    </form>
    </div>

</div>
</body>
</html>