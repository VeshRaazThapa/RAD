<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="../assets/favicon.png"/>
    <link rel="stylesheet" href="./styles/new_entry_form.css">
    <link rel="stylesheet" href="../common/styles/index.css">
    <script src="../common/scripts/drop_down.js"></script>
    <title>Input X-ray</title>
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
<script>
    function showImageViewer() {
        document.getElementById("image_viewer").style.display = 'flex';
    }

    function closeImageViewer() {
        document.getElementById("image_viewer").style.display = 'none';
    }

    function chooseFile() {
        document.getElementById('my_file').click();
    }
</script>


<div class="image_viewer" id="image_viewer">
    <div class="round_button_container" style="position:absolute; top:40px; left:5%">
        <div class="round_button" onclick="closeImageViewer();">
            <img class="icon" src="../assets/back.png">
        </div>
    </div>
    <div class="output_input_image_container">
        <img class="input_image_full" id = "inputs" >
        <img class="output_image_full" id = "output_full" >

    </div>
</div>

<div class="main_contents_wrapper new_entry_content_wrapper">
    <div class="round_button_container">
        <a class="round_button_dark" href="index.php">
            <img class="icon" src="../assets/back.png">
        </a>

    </div>
    <form method="post" action="" enctype="multipart/form-data">
    <div class="card new_entry_card">
        <div>
            <!--header-->
            <div class="header_actions">
                <img src="../assets/personal_info.png" class="icon header_icon">
                <h2 class="secondary_text_color primary_text_size">X-ray analysis</h2>
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
                    <select name="parts" >
                    <option value ="elbow">Elbow</option>
                    <option value ="finger">Finger</option>
//                     <option value="leg">Leg</option>
                    <option value="wrist">Wrist</option>
                    </select>
        <select name="trauma">
            <option value="1">Traumatic</option>
            <option value="0">Non-Traumatic</option>
        </select>
<!--                </div>-->

<!--            </div>-->
<!--        </div>-->

        <div class="image_input_container">
            <div id="get_file" class="get_file" onclick="chooseFile()">
                <input type="file" id="my_file"  name = "image" onchange="loadFile(event)" required>
                <img src="../assets/add_image.png">
                <h2 class="primary_text_size secondary_text_color bold">Add x-ray image</h2>
                <h4 class="secondary_text_size secondary_text_color regular"
                    style="margin:0;width:70%; text-align: center;">Choose files from your computer to start
                    diagnosis.</h4>
            </div>
        </div>

        <script>
            var loadFile = function(event) {
                var reader = new FileReader();
                reader.onload = function(){

                    var input = document.getElementById('input');
                    input.src = reader.result;
                    var input_full = document.getElementById('inputs');
                    input_full.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };
        </script>

        <div class="output">
            <div class="output_image_container">
                <div class="output_input_image_container" onclick="showImageViewer()">
                    <img id = "input" class="input_image" >
                    <img id = "output" class="output_image" >
                </div>

                <div class="output_info">
                    <div>
                        <!--<h3 class = "secondary_text_size secondary_text_color bold">Label</h3>-->
                        <?php
                        if (isset($_POST['diagnose'])) {
                            $target_dir = "./";
                            $target_file = $target_dir .  date('d_m_Y_H_i_s') ."_".$_GET['fname']."_".$_GET['age']."_".basename($_FILES['image']['name']).".jpg";
?>
                        <script>
                            var input = document.getElementById('input');
                            input.src = "<?php echo $target_file; ?>";
                            var input_full = document.getElementById('inputs');
                            input_full.src = "<?php echo $target_file; ?>";
                        </script>
                        <?php
                            move_uploaded_file($_FILES['image']['tmp_name'],$target_file);


                            $fp = realpath($target_file);

                                $type = $_POST['parts'];
                                $id =  date('d_m_Y_H_i_s') ."_".$_GET['fname']."_".$_GET['age']."_".basename($_FILES['image']['name']);
                                $type_json = array('id' => $id, 'type' => $type);
                                $file_open = fopen("types.json", "w");
                                fwrite($file_open, json_encode($type_json));
                                $command = 'python send_to_api.py '. $fp .'///'. $type;
                                $result = shell_exec($command);
                                $get_process_json = file_get_contents("process.json");
                                $decode_json = json_decode($get_process_json,True);
                                $label =  $decode_json['prediction']['label'];
                                $highlighted_image = $decode_json['highlighted_imagename'];
                                $fname = $_GET['fname'];
                                $mname = $_GET['mname'];
                                $lname = $_GET['lname'];
                                $age = $_GET['age'];
                                $date_of_notice = $_GET['date_of_notice'];
                                $mobile = $_GET['mobile'];
                                $email = $_GET['email'];
                                $temporary_address = $_GET['temporary_address'];
                                $permanent_address = $_GET['permanent_address'];
                                $traumatic_check =  $_POST['trauma'];
                                if($traumatic_check === "1"){
                                    $traumatic = 1;
                                }else{
                                    $traumatic = 0;
                                }
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




                                $sql = mysqli_query ($conn,"INSERT INTO patients (hospital_id,patient_fname,patient_mname,patient_lname,patient_age,xray_type,report_label,traumatic,date_of_notice,contact_no,email,temporary_address,permanent_address,highlighted_image) VALUES('$username', '$fname', '$mname', '$lname', '$age', '$type', '$label', '$traumatic', '$date_of_notice', '$mobile', '$email', '$temporary_address', '$permanent_address', '$highlighted_image' )");
                                if($sql){
                                    ?>
                        <script>alert("Data added successfully"); </script>
                        <?php
                                }else{
                                    ?>
                            <script>alert("Data adding unsuccessfull"); </script>
                            <?php
                        }
                        }
                        ?>


                </div>

                </div>
            </div>

        </div>



        <div class="button_container">

            <input type="submit" class="button rectangle_button blue_button button_small" name="diagnose" value="Diagnose">
        </div>
        </form>
    </div>
</div>
</body>
</html>