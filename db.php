<?php
$host='localhost'; $user='root'; $pass=''; $dbname='eticketing_system';
$conn=new mysqli($host,$user,$pass,$dbname);
if($conn->connect_error) die('Connection failed: '.$conn->connect_error);
date_default_timezone_set('Asia/Jakarta');
$conn->query("SET time_zone = '+07:00'");

?>