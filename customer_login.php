<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer login</title>
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

        /* Additional styles for login form */
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
        <h1>Customer Login</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["login_as"]) && $_POST["login_as"] == "customer") {

                if (isset($_POST["email"]) && isset($_POST["password"])) {
                    $email = $_POST["email"];
                    $password = $_POST["password"];

                    if ($email == "customer_email@example.com" && $password == "customer_password") {
                        header("Location: customer_page.php");
                        exit();
                    } else {
                        $error_message = "Invalid email or password";
                    }
                } else {
                    $error_message = "Please enter both email and password";
                }
            }
        }
        ?>

        <?php
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>

         <form action="customer_login.php" method="post">
            <label for="email">Email:</label>
            <input type="text" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <br>
            <button type="submit" name="login_as" value="customer">Login</button>
        </form>

        <div class="button-container">
        <button onclick="window.location.href='customer_register.php'" class="button">Register</button>
    </div>
</div>
</body>
</html>