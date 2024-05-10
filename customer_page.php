<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page</title>
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

        .user-container {
            background-color: #fff;
            border: 1px solid #ccc;
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
    </style>
</head>
<body>

<div class="container">
    <h1>Customer Page</h1>

    <div class="user-container">
        <h2>Carers</h2>
        <?php
        $mysqli = mysqli_connect("localhost", "2110047", "Will@7419156123", "db2110047");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {
            $query = "SELECT * FROM Carerlog";
            $result = mysqli_query($mysqli, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<p>Email: " . $row['email'] . "<br>Phone Number: " . $row['phonenumb'] . "</p>";
                }
            } else {
                echo "No carers found";
            }

            mysqli_close($mysqli);
        }
        ?>
    </div>
</div>

</body>
</html>