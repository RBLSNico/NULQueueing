<?php
include("db_connection.php");

if (isset($_GET['program'])) {
    $selectedProgram = $_GET['program'];

    // Debugging statement
    echo "Selected Program: $selectedProgram";

    $concernQuery = "SELECT DISTINCT concern FROM academics_queue WHERE program = '$selectedProgram'";
    $concernResult = $conn->query($concernQuery);

    echo '<option value="" selected disabled>➕ Program Chair</option>'; // Default option

    while ($concernRow = $concernResult->fetch_assoc()) {
        echo "<option value='" . $concernRow['concern'] . "'>" . $concernRow['concern'] . "</option>";
    }

    $conn->close();
}
?>
