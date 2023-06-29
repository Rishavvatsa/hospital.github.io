<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST["name"];
    $number = $_POST["number"];
    $email = $_POST["email"];
    $appointmentDate = $_POST["date"];

    // Validate and sanitize the form data (you can add more validation if needed)
    $name = trim($name);
    $number = trim($number);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $appointmentDate = trim($appointmentDate);

    // Validate the required fields
    if (empty($name) || empty($number) || empty($email) || empty($appointmentDate)) {
        echo "Please fill in all the required fields.";
        exit;
    }

    // Create a connection to the database (modify the credentials as needed)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "appointment_db";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the appointment details into the database
    $sql = "INSERT INTO appointments (name, number, email, appointment_date)
            VALUES ('$name', '$number', '$email', '$appointmentDate')";

    if ($conn->query($sql) === TRUE) {
        header("location:app.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
