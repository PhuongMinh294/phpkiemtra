<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "ql_nhansu";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        
        if ($_SESSION['role'] == 'admin') {
            header("location: admin_panel.php");
        } else {
            echo "You do not have permission to access this page.";
        }
    } else {
        echo "Invalid username or password.";
    }
}

mysqli_close($conn);
?>
