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
    </div>

    <div class="info">
        <h2>Our Services:</h2>
        <p>We match people who need care with experienced carers.</p>
        <p>Our carers offer a range of services, including companionship, personal care, and medical assistance.</p>
        <p>Join our service and find the right care for your loved ones.</p>
    </div>
</div>

</body>
</html>