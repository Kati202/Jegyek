<?php
include 'db_connect.php';

$sql = "SELECT * FROM grades ORDER BY student_name";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>Tanuló neve</th><th>Jegyek</th><th>Átlag</th><th>Teljesítmény</th><th>Műveletek</th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['student_name'] . "</td>";
        echo "<td>" . $row['grades'] . "</td>";
        echo "<td>" . round($row['average'], 2) . "</td>";
        echo "<td>" . $row['performance_rating'] . "</td>";
        echo "<td>";
        echo "<button class='btn btn-warning' onclick=\"editStudent('" . $row['student_name'] . "', '" . $row['grades'] . "')\">Szerkesztés</button>";
        echo "<button class='btn btn-danger' onclick=\"deleteStudent('" . $row['student_name'] . "')\">Törlés</button>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "Nincsenek adatok!";
}

$conn->close();
?>














