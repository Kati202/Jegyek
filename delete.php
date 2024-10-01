<?php
include 'db_connect.php';

if (isset($_POST['student_name'])) {
    $student_name = $_POST['student_name'];
    $sql = "DELETE FROM grades WHERE student_name='$student_name'";

    if ($conn->query($sql) === TRUE) {
        echo "Adatok sikeresen törölve!";
    } else {
        echo "Hiba történt az adatok törlése során: " . $conn->error;
    }
}

$conn->close();
?>
