<?php
include 'header.php'; 

if(isset($_SESSION["user_id"])) {
    header("Location: carer_page.php");
    exit();
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login_as"]) && $_POST["login_as"] == "carer") {
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $mysqli = mysqli_connect("localhost", "2110047", "Will@7419156123", "db2110047");

            if (mysqli_connect_errno()) {
                $error_message = "Failed to connect to MySQL: " . mysqli_connect_error();
            } else {
                $query = "SELECT * FROM Carerlog WHERE email = ? LIMIT 1";
                $stmt = mysqli_prepare($mysqli, $query);
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    if (password_verify($password, $row['password'])) {

                        $_SESSION["user_id"] = $row['user_id'];
                        $_SESSION["role"] = "carer";
                        header("Location: carer_page.php");
                        exit();
                    } else {
                        $error_message = "Invalid email or password";
                    }
                } else {
                    $error_message = "Invalid email or password";
                }

                mysqli_stmt_close($stmt);
                mysqli_close($mysqli);
            }
        } else {
            $error_message = "Please enter both email and password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carer Login</title>
    <style>
{
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

        .info {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            margin-top: 40px;
            text-align: left;
        }

        .info h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .info p {
            color: #666;
            line-height: 1.6;
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
		
        .button-container1 {
    margin-top: 10px;
    display: inline-block;
	
}
.button-container1 form {
    border: none;
    background: none;
}
    </style>
</head>
<body>

<div class="container">
    <h1>Carer Login</h1>

    <?php
    if (isset($error_message)) {
        echo "<p class='error-message'>$error_message</p>";
    }
    ?>

    <form action="" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit" name="login_as" value="carer">Login</button>
    </form>

    <div class="button-container">
        <button class="button" onclick="window.location.href='carer_register.php';">Register</button>
        <div class="button-container1">
            <form method="post" action="homepage.php">
                <button type="submit" class="button" name="home" value="customer">Home</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>

