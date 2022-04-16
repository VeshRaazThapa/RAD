<?php
$file = $_GET['image'];
$fp = realpath($file);
$command = 'python send_to_api.py ' . $fp;
$result = shell_exec($command);
echo $result;

?>