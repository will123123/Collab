<?php
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login_as"]) && $_POST["login_as"] == "carer") {
        if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["phonenumb"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $phone = $_POST["phonenumb"];

            
            if (strlen($phone) > 11) {
                $error_message = "Phone number is too long";
            } else {
                $mysqli = mysqli_connect("localhost", "2110047", "Will@7419156123", "db2110047");

                if (mysqli_connect_errno()) {
                    $error_message = "Failed to connect to MySQL: " . mysqli_connect_error();
                } else {
                    
                    $check_query = "SELECT * FROM Carerlog WHERE email = ? OR phonenumb = ?";
                    $check_stmt = mysqli_prepare($mysqli, $check_query);
                    mysqli_stmt_bind_param($check_stmt, "ss", $email, $phone);
                    mysqli_stmt_execute($check_stmt);
                    mysqli_stmt_store_result($check_stmt);
                    
                    if (mysqli_stmt_num_rows($check_stmt) > 0) {
                        $error_message = "Email or phone number already registered.";
                    } else {
                   
                        $insert_query = "INSERT INTO Carerlog (email, password, phonenumb) VALUES (?, ?, ?)";
                        $insert_stmt = mysqli_prepare($mysqli, $insert_query);
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($insert_stmt, "sss", $email, $hashed_password, $phone);
                        $result = mysqli_stmt_execute($insert_stmt);  

                        if (!$result) {
                            $error_message = "Registration failed";
                        } else {
                            header("Location: carer_login.php");
                            exit();
                        }
                        
                        mysqli_stmt_close($insert_stmt); 
                    }

                    mysqli_stmt_close($check_stmt); 
                    mysqli_close($mysqli); 
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
