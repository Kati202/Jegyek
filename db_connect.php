<?php
$servername = "localhost";
$username = "root";
$password = "mysql"; 
$dbname = "students";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}
?>
