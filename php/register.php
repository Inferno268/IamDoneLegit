<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            width: 300px;
            margin: 0 auto;
        }

        form label {
            display: block;
            margin-bottom: 10px;
            text-align: left;
            color: #333;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 5px;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container button {
            background-color: #ccc;
            border: none;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h2>Registration</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Username</label>
        <input type="text" name="username" required><br><br>
        <label>Email</label>
        <input type="email" name="email" required><br><br>
        <label>Password</label>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Register">
    </form>

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "test";
        $dbname = "waproject";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Database conn failed: " . $conn->connect_error);
        }

        // Zpracování formuláře po odeslání
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')"; 

            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("Registration completed."); window.location.href = "../html/homePage.html";</script>';
            } else {
                echo "Smth went wrong: " . $conn->error;
            }

            $conn->close();
        }
    ?>

    <div class="button-container">
        <button onclick="location.href='../html/homePage.html'">Back</button>
    </div>
</body>
</html>
