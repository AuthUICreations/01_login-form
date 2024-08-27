<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "testdb"; // Make sure to change these variables to your DB credentials

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection to the database failed: " . $conn->connect_error);
    }

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM login WHERE Email = '$email' AND Password = '$password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['Email'];
        header("Location: login.html");
        exit();
    } else {
        echo "Login failed. <a href='index.html'>Back to the login page</a>";
    }

    $conn->close();
}
?>
