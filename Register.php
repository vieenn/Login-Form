<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
    <link rel="stylesheet" href="Style2.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php
session_start();

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "login database"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $uname = $_POST["uname"];
    $psw = $_POST["psw"];

 
    $hashed_password = password_hash($psw, PASSWORD_DEFAULT);

    
    $stmt = $conn->prepare("INSERT INTO `user list` (`Username`, `Email`, `Password`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $uname, $email, $hashed_password);

    if ($stmt->execute()) {
        header("Location: Amodente.php"); 
        exit();
    } else {
        $error = "Error registering user: " . $conn->error;
    }
}
?>

<div class="wrapper">
    <h1>Register</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="input-box">
            <label for="email"><b></b></label>
            <input type="text" placeholder="Email" name="email" required>
            <i class='bx bx-envelope' ></i>
        </div>

        <div class="input-box">
            <label for="uname"><b></b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>
            <i class='bx bx-user'></i>
        </div>

        <div class="input-box">
            <label for="psw"><b></b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <i class='bx bxs-lock-alt'></i>
        </div>

        <button type="submit" class="btn">REGISTER</button>

        <?php if(isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>

        <div class="login-text">
            Already have an account? <a href="Amodente.php">Login</a>
        </div>
    </form>
</div>

</body>
</html>
