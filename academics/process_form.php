<?php

include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST["student_id"];
    $office = $_POST["office"];
    $transaction = $_POST["transaction"];
    $remarks = $_POST["remarks"];
    $timenow = $_POST["form-queue-timestamp"];
    $queuenumbercolumn = $_POST["form-queue-number"];
    $endorsedFrom = "Academics"; // You mentioned this value should be "ACADEMICS"

    if ($office === "select" || $transaction === "select") {
        echo "Please select both 'Endorsed To' and 'Transaction' options.";
    } else {
        $table = strtolower($office); // Convert office name to lowercase for the table name

        // Prepare the SQL statement to insert the data into the appropriate table
        $sql = "INSERT INTO $table (queue_number, student_id, timestamp, remarks, transaction,endorsed_from, status)
                VALUES ('$queuenumbercolumn', '$studentId', NOW(), '$remarks','$transaction', '$endorsedFrom', '0')";

        $sql2 = "INSERT INTO academics_logs (queue_number, student_id, endorsed_from, timestamp, timeout,transaction)
        VALUES ('$queuenumbercolumn', '$studentId', '$endorsedFrom', '$timenow' , NOW(),'$transaction')";

        if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
            echo "Data inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
