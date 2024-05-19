<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carer Page</title>
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

        .button-container {
            margin-top: 10px;
            text-align: center; /* Center the button horizontally */
        }

        .button-container form {
            border: none;
            background: none;
        }

        .user-container {
            background-color: #fff;
            border: 1px solid #ccc; /* Add border */
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
            text-align: left;
        }

        .user-container h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .user-container p {
            color: #666;
            line-height: 1.6;
        }

        /* Style for the login status */
        .login-status {
            float: right;
        }
    </style>
</head>
<body>
<?php
include 'header.php';


if (!$is_logged_in) {
    header("Location: carer_login.php"); 
    exit();
}


if (!check_role("carer")) {
    header("Location: customer_page.php"); 
    exit();
}


?>


<div class="container">
    <h1>Carer Page</h1>
	
	<div class="button-container">
    <button class="button" onclick="window.location.href='homepage.php';">Home</button>
    <div class="button-container1">
        
    </div>

    <div class="login-status">
        <?php display_login_status(); ?>
    </div>

    <div class="user-container">
        <h2>Customers</h2>
        <?php
        $mysqli = mysqli_connect("localhost", "2110047", "Will@7419156123", "db2110047");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {
            $query = "SELECT * FROM Cuslog";
            $result = mysqli_query($mysqli, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<p>Email: " . $row['email'] . "<br>Phone Number: " . $row['phonenumb'] . "</p>";
                }
            } else {
                echo "No customers found";
            }

            mysqli_close($mysqli);
        }
        ?>
    </div>
</div>



</body>
</html>
