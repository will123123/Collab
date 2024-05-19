<?php
session_start();
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login_as"]) && $_POST["login_as"] == "carer") {
        if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["phonenumb"])) {
            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars(trim($_POST["password"]));
            $phone = htmlspecialchars(trim($_POST["phonenumb"]));

            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_message = "Invalid email format";
            } elseif (strlen($phone) > 11) {
                $error_message = "Phone number is too long";
            } else {
                $mysqli = new mysqli("localhost", "2110047", "Will@7419156123", "db2110047");

                if ($mysqli->connect_errno) {
                    $error_message = "Failed to connect to MySQL: " . $mysqli->connect_error;
                } else {
                    
                    $check_query = "SELECT * FROM Carerlog WHERE email = ? OR phonenumb = ?";
                    $check_stmt = $mysqli->prepare($check_query);
                    $check_stmt->bind_param("ss", $email, $phone);
                    $check_stmt->execute();
                    $check_stmt->store_result();

                    if ($check_stmt->num_rows > 0) {
                        $error_message = "Email or phone number already registered.";
                    } else {
                        $insert_query = "INSERT INTO Carerlog (email, password, phonenumb) VALUES (?, ?, ?)";
                        $insert_stmt = $mysqli->prepare($insert_query);
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $insert_stmt->bind_param("sss", $email, $hashed_password, $phone);
                        $result = $insert_stmt->execute();

                        if (!$result) {
                            $error_message = "Registration failed";
                        } else {
                            header("Location: carer_login.php");
                            exit();
                        }

                        $insert_stmt->close();
                    }

                    $check_stmt->close();
                    $mysqli->close();
                }
            }
        } else {
            $error_message = "Please enter email, password, and phone number";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carer Registration</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button {
            padding: 10px 20px;
            margin: 0 10px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
        }

        .button:focus {
            outline: none;
        }

        .button:last-child {
            margin-right: 0;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 22px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
        }

        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Carer Registration</h1>

        <?php
        if (!empty($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="email">Email:</label>
            <input type="text" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <br>
            <label for="phonenumb">Phone Number:</label>
            <input type="text" name="phonenumb" required>
            <br>
            <button type="submit" name="login_as" value="carer">Register</button>
        </form>

        <div class="button-container">
            <button onclick="window.location.href='carer_login.php'" class="button">Back to Login</button>
        </div>
    </div>
</body>
</html>
