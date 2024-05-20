<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $id = $_POST["delete"];

    $stmt = $conn->prepare("DELETE FROM `user list` WHERE ID = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Error deleting user: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
    $id = $_POST["edit"];
    $email = $_POST["email"];
    $uname = $_POST["uname"];

    $stmt = $conn->prepare("UPDATE `user list` SET `Username` = ?, `Email` = ? WHERE ID = ?");
    $stmt->bind_param("ssi", $uname, $email, $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Error editing user: " . $conn->error;
    }
}

?>

    
</head>
<body>
    <div class="container" style="text-align: center;">
        <h2>List of Users</h2>
        <form action="logout.php" method="post" style="text-align: right; margin-bottom: 20px;">
            <button type="submit" class="btn btn-warning">Logout</button>
        </form>
        <br>
        <table class="table table-dark table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM `user list`");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ID"] . "</td>";
                        echo "<td>" . $row["Username"] . "</td>";
                        echo "<td>" . $row["Email"] . "</td>";
                        echo "<td>
                                <form method='post' class='user-form'>
                                    <input type='hidden' name='edit' value='" . $row["ID"] . "'>
                                    <input type='text' name='uname' value='" . $row["Username"] . "'>
                                    <input type='text' name='email' value='" . $row["Email"] . "'>
                                    <button type='submit' name='save' class='btn btn-primary'>Save</button>
                                    <button type='submit' name='delete' value='" . $row["ID"] . "' class='btn btn-danger'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>



</body>
</html>
