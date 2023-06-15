<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form inputs
    $name = $_POST["name"];
    $email = $_POST["email"];
    $description = $_POST["descrip"];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "test";
    $dbname = "waproject";

    // Create a new connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement to retrieve the user_id based on the name
    $retrieveUserIdSql = "SELECT id FROM users WHERE username = '$name'";

    // Execute the SQL statement
    $result = $conn->query($retrieveUserIdSql);

    // Check if the query was successful and if a row was returned
    if ($result && $result->num_rows > 0) {
        // Fetch the row
        $row = $result->fetch_assoc();
        
        // Extract the user_id
        $userId = $row["id"];

        // Prepare the SQL statement to insert into feedbacks table
        $insertFeedbackSql = "INSERT INTO feedbacks (user_id, email, description) VALUES ('$userId', '$email', '$description')";

        // Execute the SQL statement
        if ($conn->query($insertFeedbackSql) === TRUE) {
            // Redirect to a success page
            header("Location: ../html/homePage.html");
            exit;
        } else {
            // Redirect to an error page or display an alert
            echo '<script>alert("Your name must match your username"); window.location.href = "../html/contactPage.html";</script>';
            exit;
        }
    } else {
        // Redirect to an error page or display an alert
        echo '<script>alert("Your name must match your username"); window.location.href = "../html/contactPage.html";</script>';
        exit;
    }

    // Close the database connection
    $conn->close();
}
?>
