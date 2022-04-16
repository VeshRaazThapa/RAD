
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="../assets/favicon.png"/>
    <link rel="stylesheet" href="./styles/new_entry_form.css">
    <link rel="stylesheet" href="../common/styles/index.css">
    <script src="../common/scripts/drop_down.js"></script>
    <title>Patient Detail</title>
</head>
<body>
<?php

include '../connect.php';
session_start();
$username=$_SESSION['username'];

if(!$username){
    session_destroy();
    header('location:../auth');
}

?>




<div class="main_contents_wrapper new_entry_content_wrapper">
    <div class="round_button_container">
        <a class="round_button_dark" href="index.php">
            <img class="icon" src="../assets/back.png">
        </a>

    </div>

    <div class="card new_entry_card">
        <div>
            <!--header-->
            <div class="header_actions">
                <img src="../assets/personal_info.png" class="icon header_icon">
                <h2 class="secondary_text_color primary_text_size">Patient Details</h2>
            </div>
        </div>


        <!--        <div class="dropdown_container">-->
        <!--            <div>-->
        <!--                <div onclick="dropDown()"-->
        <!--                     class="dropDownButton rounded_corner_button secondary_text_color button blue_button button_large ">-->
        <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="#ffffff">-->
        <!--                        <path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/>-->
        <!--                        <path d="M0 0h24v24H0z" fill="none"/>-->
        <!--                    </svg>&nbsp;&nbsp;&nbsp;-->
        <!--                    <img src="../assets/dashboard/drop_down.png" style="height:8px; width:auto">-->
        <!--                </div>-->
        <!--                <div id="sort_options" class="dropdown-content secondary_text_size secondary_text_color semi_bold butt">-->

        <!--                </div>-->

        <!--            </div>-->
        <!--        </div>-->




        <?php

        $id = $_GET['id'];
        include'../connect.php';
        include '../bootstrap.php';
        $get_detail = mysqli_query ($conn,"SELECT * FROM patients WHERE id='$id'");
        $data = mysqli_fetch_assoc($get_detail);
        $fname = $data['patient_fname'];
        $mname = $data['patient_mname'];
        $lname = $data['patient_lname'];
        $age= $data['patient_age'];
        $mobile = $data['contact_no'];
        $email = $data['email'];
        $temporary_address = $data['temporary_address'];
        $permanent_address= $data['permanent_address'];
        $type = $data['xray_type'];
        $label = $data['report_label'];
        $traumatic_bool = $data['traumatic'];
        $date_of_notice = $data['date_of_notice'];
        $date_added = $data['date_added'];
        $highlighted_image = $data['highlighted_image'];
        if((int)$traumatic_bool === 1){
            $traumatic = "True";
        }else if((int)$traumatic_bool === 0){
            $traumatic = "False";
        }
        echo "<b>Name: </b>".$fname." ".$mname." ".$lname;
        echo "<p>";
        echo "<b>Age: </b>".$age;
        echo "<p>";
        echo "<b>Contact No: </b>".$mobile;
        echo "<p>";
        echo "<b>Email: </b>".$email;
        echo "<p>";
        echo "<b>Temporary Address: </b>".$temporary_address;
        echo "<p>";
        echo "<b>Permanent Address: </b>".$permanent_address;
        echo "<p>";
        echo "<b>X-ray Of: </b>".$type;
        echo "<p>";
        echo "<b>Traumatic: </b>".$traumatic;
        echo "<p>";
        echo "<b>Date Of Notice: </b>".$date_of_notice;
        echo "<p>";
        echo "<b>Record Added On: </b>".$date_added;
        echo "<p>";






        if ($label === "Normal") {
            echo '   <h3 class="secondary_text_size secondary_text_color bold x-ray_label">
                            <font color="green">Normal</font>
                        </h3>';
        }else if($label === "Abnormal"){
            echo '   <h3 class="secondary_text_size secondary_text_color bold x-ray_label">
                            <font color="red">Abnormal</font>
                        </h3>';
            ?>
            <script>
                var output = document.getElementById('output');
                output.src = "<?php echo "http://127.0.0.1:8000/static/".$highlighted_image; ?>";
                var outputs = document.getElementById('output_full');
                outputs.src = "<?php echo "http://127.0.0.1:8000/static/".$highlighted_image; ?>";
            </script>
            <?php
        }




        ?>


        <div class="output">
            <div class="output_image_container">
                <div class="output_input_image_container" onclick="showImageViewer()">
                    <img id = "input" class="input_image" src="<?php echo "http://127.0.0.1:8000/static/".$highlighted_image; ?>" >
                    <img id = "output" class="output_image" >
                </div>

                        <!--<h3 class = "secondary_text_size secondary_text_color bold">Label</h3>-->


                    </div>

                </div>
        <a style="width: 10%;" href="patient-edit.php?id=<?php echo $_GET['id']; ?>" class="btn btn-danger btn-sm" role="button">Edit</a>
            </div>

        </div>




    </div>
</div>
</body>
</html>

