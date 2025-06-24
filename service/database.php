<?php

$hostname="localhost";
$username="root";
$password="";
$database_name="auth_crud";


$db = mysqli_connect($hostname, $username, $password, $database_name);

if($db->connect_error){
    echo "Koneksi gagal";
    die("error!");
}

// echo "Koneksi berhasil"
?>