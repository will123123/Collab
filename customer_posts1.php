<?php
include 'header.php'; 


if (!isset($_SESSION["user_id"]) || !check_role("carer")) {
    header("Location: carer_login.php");
    exit();
}


$posts = [];
$mysqli = mysqli_connect("localhost", "2110047", "Will@7419156123", "db2110047");
if (!$mysqli) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
    $query = "SELECT post_content, post_date FROM CusPosts";
    $result = mysqli_query($mysqli, $query);
    if ($result) {
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Failed to fetch posts.";
    }
    mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carer View</title>
    <style>
        /* Add your CSS styles here */
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
    </style>
</head>
<body>

<div class="container">
    <h1>Carer View</h1>

    <div class="button-container">
        <?php if(isset($_SESSION["user_id"]) && check_role("carer")): ?>
            <form action="carer_posts.php" method="post">
                <button type="submit" class="button">Another Page</button>
            </form>
        <?php endif; ?>

        <?php if(isset($_SESSION["user_id"])): ?>
            <form action="logout.php" method="post">
                <button type="submit" class="button" name="logout">Logout</button>
            </form>
        <?php endif; ?>
    </div>

    <div class="info">
        <h2>Customer Posts:</h2>
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <p>Date: <?= $post['post_date'] ?><br>Content: <?= $post['post_content'] ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
