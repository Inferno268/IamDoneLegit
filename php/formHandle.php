<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $description = $_POST["descrip"];


    $servername = "localhost";
    $username = "root";
    $password = "test";
    $dbname = "waproject";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $retrieveUserIdSql = "SELECT id FROM users WHERE username = '$name'";


    $result = $conn->query($retrieveUserIdSql);

    if ($result && $result->num_rows > 0) {
        // Fetch the row
        $row = $result->fetch_assoc();
        

        $userId = $row["id"];


        $insertFeedbackSql = "INSERT INTO feedbacks (user_id, email, description) VALUES ('$userId', '$email', '$description')";


        if ($conn->query($insertFeedbackSql) === TRUE) {

            header("Location: ../html/homePage.html");
            exit;
        } else {

            echo '<script>alert("Your name must match your username"); window.location.href = "../html/contactPage.html";</script>';
            exit;
        }
    } else {

        echo '<script>alert("Your name must match your username"); window.location.href = "../html/contactPage.html";</script>';
        exit;
    }

    $conn->close();
}
?>
