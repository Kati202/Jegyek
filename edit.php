<?php
include 'db_connect.php';

if (isset($_POST['student_name']) && isset($_POST['grades'])) {
    $student_name = $_POST['student_name'];
    $grades_input = $_POST['grades'];
    
    $grades_array = explode(",", $grades_input);
    $grades_array = array_map('trim', $grades_array);
    $grades_array = array_map('floatval', $grades_array);
    
    $sum = array_sum($grades_array);
    $average = $sum / count($grades_array);

    function performanceRating($average) {
        if ($average >= 4.5) {
            return "Kiváló";
        } elseif ($average >= 3.5) {
            return "Jó";
        } elseif ($average >= 2.5) {
            return "Közepes";
        } elseif ($average >= 1.5) {
            return "Elégséges";
        } else {
            return "Elégtelen";
        }
    }

    $rating = performanceRating($average);
    $grades_string = implode(",", $grades_array);
    
    $sql = "UPDATE grades SET grades='$grades_string', average='$average', performance_rating='$rating' WHERE student_name='$student_name'";

    if ($conn->query($sql) === TRUE) {
        echo "Adatok sikeresen frissítve!";
    } else {
        echo "Hiba történt az adatok frissítése során: " . $conn->error;
    }
}

$conn->close();
?>

