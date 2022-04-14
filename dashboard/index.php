<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="../assets/favicon.png"/>
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="../common/styles/index.css">
    <?php
    include'../bootstrap.php';
    ?>
    <title>Dashboard</title>
</head>
<body>

<!--header-->

<?php
include '../connect.php';
session_start();
$username=$_SESSION['username'];

if(!$username){
    session_destroy();
    header('location:../auth');
}
$query_hospital_name = mysqli_query($conn,"SELECT * FROM  hospitals WHERE hospital_id ='$username'");
$details = mysqli_fetch_assoc($query_hospital_name);
$hospital_name = $details['hospital_name'];

?>
<header class="dashboard_header sticky_header" id="header">
    <script type="text/javascript" src="../common/scripts/sticky_header.js">
        // stickyHeader();
    </script>
    <div class="header_left">
        <img class="header_image" src="../assets/dashboard/header_icon.png">
        <div class="header_left_text_container">
            <h3 class="primary_text_color_white">
                <?php echo $hospital_name; ?>
            </h3>
            <h5 class="secondary_text_color_white">
                Dashboard
            </h5>
        </div>
    </div>
    <div class="header_right">
        <div class="round_button_container">
            <a class="round_button" href="#">
                <img class="icon" src="../assets/dashboard/search.png">
            </a>
        </div>
    </div>
</header>

<!--body contents-->

<!--absolute blue-background-->
<div class="absolute_background"></div>


<div class="main_contents_wrapper dashboard_main_content_wrapper">
    <!--action buttons and info-->
    <div class="dashboard_top_info_container">


        <div class="dashboard_info_left">
            <a href="new_entry_form.php" class=" button rounded_corner_button white_button button_medium">
                <img src="../assets/dashboard/add.png" style = "height:48px;"> &nbsp; New Entry
            </a>
            <a href="predict_fast.php" class=" button rounded_corner_button white_button button_medium">
                <img src="../assets/dashboard/add.png" style = "height:48px;"> &nbsp; Fast Prediction
            </a>
            <div class="total_entries">

                <h1>
                    <?php


                        $get_no_of_entries = mysqli_query($conn, "SELECT * FROM patients WHERE hospital_id = '$username' ORDER BY id DESC");


                    $count = mysqli_num_rows($get_no_of_entries);

                    echo $count;

                    ?>
                </h1>
                <h4 class="regular">
                    entries
                </h4>
            </div>
        </div>

        <div class="dashboard_info_right">
            <script src="../common/scripts/drop_down.js"></script>

            <div onclick="dropDown()"
                 class="dropDownButton rounded_corner_button button blue_button  button_large ">
                <img src="../assets/dashboard/sort.png" class="icon"> &nbsp;&nbsp;&nbsp; Sort By &nbsp;&nbsp;&nbsp;
                <img src="../assets/dashboard/drop_down.png" style="height:8px; width:auto">
            </div>
            <div id="sort_options" class="dropdown-content secondary_text_size secondary_text_color semi_bold butt">
                <a href="index.php?sort=traumatic">Traumatic</a>
                <a href="index.php?sort=abnormal">Abnormal</a>
                <a href="index.php?sort=auto">Auto</a>
            </div>
        </div>
    </div>
    <table >
        <tr>
            <th>Patient Id</th>
            <th>Name</th>
            <th>Age</th>
            <th>Type</th>
            <th>Label</th>
            <th>Traumatic</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php
        if(isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            if($sort === 'traumatic'){
                $get_patients = mysqli_query($conn, "SELECT * FROM patients WHERE hospital_id = '$username' ORDER BY traumatic DESC ");
            }else if ($sort === 'abnormal'){
                $get_patients = mysqli_query($conn, "SELECT * FROM patients WHERE hospital_id = '$username' ORDER BY report_label ");
            }else if ($sort === 'auto'){
                $get_patients = mysqli_query($conn, "SELECT * FROM patients WHERE hospital_id = '$username' ORDER BY traumatic DESC, report_label DESC , id DESC   ");
            }
        }else{
            $get_patients = mysqli_query($conn, "SELECT * FROM patients WHERE hospital_id = '$username' ORDER BY traumatic DESC, report_label DESC , id DESC   ");
        }
        if(mysqli_num_rows($get_patients) < 1){
            echo "
  <tr>
            <td><font color='red'>No records to show</font></td>
        </tr>
";



        }else{
        while ($patients = mysqli_fetch_assoc($get_patients)){
            $patient_id = $patients['id'];
            $patient_fname = $patients['patient_fname'];
            $patient_mname = $patients['patient_mname'];
            $patient_lname = $patients['patient_lname'];
            $patient_age = $patients['patient_age'];
            $patient_type = $patients['xray_type'];
            $patient_label = $patients['report_label'];
            $status = $patients['status'];
            if((int)$patients['traumatic'] === 1){
                $patient_traumatic = "True";
            }else if((int)$patients['traumatic'] === 0){
                $patient_traumatic = "False";
            }


            echo "
              <tr >
            <td>".$patient_id."</td>
            <td>".$patient_fname." ".$patient_mname." ". $patient_lname."</td>
            <td>".$patient_age."</td>
            <td>".$patient_type."</td>
            <td>".$patient_label."</td>
            <td>".$patient_traumatic."</td>
            <td>".$status."</td>
            <td> <a href='patient-detail.php?id=" . $patient_id . "' class='btn btn-success' role='button'>View</a> | <a href='patient_delete.php?id=" . $patient_id . "' class='btn btn-danger' role='button'>Delete</a>| <a href='patient_complete.php?id=" . $patient_id . "' class='btn btn-warning' role='button'>Completed</a></td>
        </tr>
            ";
        }
        }
        ?>



    </table>
</div>
</body>
</html>