<?php
session_start();

$server="localhost";
$user="root";
$pass="Toor@123";
$dbname="Sharma";

$conn=new mysqli($server,$user,$pass,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>
