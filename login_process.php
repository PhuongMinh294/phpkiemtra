<?php
session_start(); // Khởi động phiên đăng nhập

$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "ql_nhansu";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['username'];
    $_SESSION['fullname'] = $row['fullname'];
    $_SESSION['role'] = $row['role'];
    header("Location: index.php"); // Chuyển hướng đến trang nếu đăng nhập thành công
} else {
    echo "Tên đăng nhập hoặc mật khẩu không đúng!";
}

mysqli_close($conn);
?>
