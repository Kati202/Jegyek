<?php
include 'db_connect.php';

if (isset($_POST['student_name']) && isset($_POST['grades'])) {
    $student_name = $_POST['student_name'];
    $grades_input = $_POST['grades'];
    
    $grades_array = explode(",", $grades_input);
    $grades_array = array_map('trim', $grades_array);
    $grades_array = array_map('floatval', $grades_array);
    
    $count = count($grades_array);

    if ($count > 0) {
        $sum = array_sum($grades_array);
        $average = $sum / $count;

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
        
        // Kétszer ugyanazt a nevet ne lehessen beszúrni
        $check_sql = "SELECT * FROM grades WHERE student_name='$student_name'";
        $check_result = $conn->query($check_sql);
        
        if ($check_result->num_rows > 0) {
            // Már létezik a tanuló, frissítjük az adatokat
            $sql = "UPDATE grades SET grades='$grades_string', average='$average', performance_rating='$rating' WHERE student_name='$student_name'";
            $message = "Adatok sikeresen frissítve!";
        } else {
            // Új tanuló beszúrása
            $sql = "INSERT INTO grades(student_name, grades, average, performance_rating) VALUES ('$student_name', '$grades_string', '$average', '$rating')";
            $message = "Adatok sikeresen beszúrva!";
        }

        if ($conn->query($sql) === TRUE) {
            echo $message;
        } else {
            echo "Hiba történt: " . $conn->error;
        }
    } else {
        echo "Kérjük, érvényes jegyeket adjon meg!";
    }
}

$conn->close();
?>



