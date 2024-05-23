<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
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
    $username = $_POST["username"];
    $psw = $_POST["psw"];

 
    $stmt = $conn->prepare("SELECT * FROM `user list` WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($psw, $row["Password"])) {
            $_SESSION["username"] = $row["Username"];
            header("Location: dashboard.php"); 
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Invalid username or password!";
    }
}
?>



<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="wrapper">
    <form action=""> 
    <h1>Login</h1>

<div class="input-box">
<label for="username"><b></b></label>
    <input type="text" placeholder="Enter Username" name="username" required>
    <i class='bx bx-user'></i>
</div>

<div class="input-box">
<label for="psw"><b></b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <i class='bx bxs-lock-alt'></i>
</div>

    <button type="submit" class="btn" onclick="auth()">LOGIN</button>

    <?php 
    if(isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } 
    ?>

    <div class="registration-text">
      Don't have an account? <a href="Register.php">Register</a>
    </div>

  </div>
</form>
    
</body>
</html>
