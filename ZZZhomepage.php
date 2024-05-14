<?php
include 'header.php'; 

$user_info = [];
if ($is_logged_in) {
    if (check_role("customer")) {
        $mysqli = mysqli_connect("localhost", "2110047", "Will@7419156123", "db2110047");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {
            $query = "SELECT email, phonenumb FROM Carerlog";
            $result = mysqli_query($mysqli, $query);

            if (mysqli_num_rows($result) > 0) {
                $user_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
            } else {
                echo "No records found";
            }

            mysqli_close($mysqli);
        }
    } elseif (check_role("carer")) {
        $mysqli = mysqli_connect("localhost", "2110047", "Will@7419156123", "db2110047");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {
            $query = "SELECT email, phonenumb FROM Cuslog";
            $result = mysqli_query($mysqli, $query);

            if (mysqli_num_rows($result) > 0) {
                $user_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
            } else {
                echo "No records found";
            }

            mysqli_close($mysqli);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home Page</title>
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
</style>
</head>
<body>

<div class="container">
    <h1>Dial-A-Carer</h1>

    <div class="button-container">
        <form method="post" action="customer_login.php">
            <button type="submit" class="button" name="login_as" value="customer">Sign In as Customer</button>
        </form>

        <form method="post" action="carer_login.php">
            <button type="submit" class="button" name="login_as" value="carer">Sign In as Carer</button>
        </form>
		
		<?php if(isset($_SESSION["user_id"]) && check_role("customer")): ?>
			<form action="customer_posts.php" method="post">
				<button type="submit" class="button">Make a Post!</button>
			</form>
		<?php endif; ?>
		
		<?php if(isset($_SESSION["user_id"]) && check_role("carer")): ?>
			<form action="customer_posts1.php" method="post">
				<button type="submit" class="button">View Post</button>
			</form>
		<?php endif; ?>
				

        <?php if(isset($_SESSION["user_id"])): ?>
            <form action="logout.php" method="post">
                <button type="submit" class="button" name="logout">Logout</button>
            </form>
        <?php endif; ?>
    </div>
	


    <div class="info">
        <h2>Our Services:</h2>
        <p>We match people who need care with experienced carers.</p>
        <p>Our carers offer a range of services, including companionship, personal care, and medical assistance.</p>
        <p>Join our service and find the right care for your loved ones.</p>
    </div>
	
	
	    <?php if (!empty($user_info)): ?>
    <div class="info">
        <h2>User Information:</h2>
		<p>If you are logged in, to view the other tabs, please log out and sign as the other tab you wish to view</p>
		<p>For example, if you wish to view carers, please sign in as a customer and vice versa. Customers can only view Carers and Carers can only view Customers</p>
        <?php foreach ($user_info as $user): ?>
            <p>Email: <?= $user['email'] ?><br>Phone Number: <?= $user['phonenumb'] ?></p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

</body>
</html>
