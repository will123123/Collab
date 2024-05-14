<?php

include 'header.php'; 


if (!isset($_SESSION["user_id"]) || !check_role("customer")) {
    header("Location: customer_login.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    if (!empty($_POST["post_content"]) && !empty($_POST["post_date"])) {
        $post_content = $_POST["post_content"];
        $post_date = $_POST["post_date"];
        

        $mysqli = mysqli_connect("localhost", "2110047", "Will@7419156123", "db2110047");


        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {

            $query = "INSERT INTO CusPosts (post_content, post_date) VALUES (?, ?)";
            $stmt = mysqli_prepare($mysqli, $query);
            mysqli_stmt_bind_param($stmt, "ss", $post_content, $post_date);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                echo "Post added successfully.";
            } else {
                echo "Failed to add post.";
            }


            mysqli_stmt_close($stmt);
            mysqli_close($mysqli);
        }
    } else {
        echo " ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Posts</title>
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

        /* Additional styles for form elements */
        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        textarea {
            width: 100%;
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

        button[type="submit"]:focus {
            outline: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Customer Posts</h1>

    <div class="button-container">
      <form method="post" action="homepage.php">
                <button type="submit" class="button" name="home" value="customer">Home</button>
            </form>
    </div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<p>Post content and date cannot be empty.</p>
        <label for="post_content">Post Content: Maximum 255 characters. Make sure to include contact information for the carers!</label><br>
        <textarea name="post_content" rows="4" cols="50" required></textarea><br>
        
        <label for="post_date">Post Date: Make sure to Include hyphens '-' when entering the date!</label><br>
        <input type="text" name="post_date" placeholder="YYYY-MM-DD" required><br>
        
        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>
