<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            width: 300px;
        }

        .login-form h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .login-form label {
            display: block;
            margin-bottom: 10px;
            text-align: left;
            color: #333;
            font-weight: bold;
        }

        .login-form input[type="text"] {
            width: 100%;
            padding: 10px 0px 10px 2px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 5%;
        }

        .login-form input[type="password"] {
            width: 100%;
            padding: 10px 0px 10px 2px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .register-btn {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 5%;
            background-color: #4CAF50;
            color: white;
        }

        .login-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .login-form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .login-form .error-message {
            color: red;
            margin-top: 10px;
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
    <div class="container">
        <div class="login-form">
            <h2>Login please</h2>
            <form method="POST" action="login.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
            </form>

            <?php
                $servername = "localhost";
                $database = "waproject";
                $username = "root";
                $password = "test";

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Connection failed " . $conn->connect_error);
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
                    $result = $conn->query($sql);

                    if ($result->num_rows == 1) {
                        echo '<script>
                                localStorage.setItem("username", "' . $username . '");
                                localStorage.setItem("password", "' . $password . '");
                                window.location.href = "../html/homePage.html";
                            </script>';
                        exit();
                    } else {
                        echo "<p class='error-message'>Invalid credentials</p>";
                    }
                }

                $conn->close();
            ?>
            <button class="register-btn" onclick="location.href='register.php'">Register</button>

            <div class="button-container">
                <button onclick="location.href='../html/homePage.html'">Back</button>
            </div>
        </div>
    </div>

    <script>
        // Retrieve login credentials from local storage
        var username = localStorage.getItem("username");
        var password = localStorage.getItem("password");

        // Check if login credentials exist
        if (username && password) {
            // Auto-fill the login form
            document.getElementById("username").value = username;
            document.getElementById("password").value = password;
        }
    </script>
</body>
</html>
