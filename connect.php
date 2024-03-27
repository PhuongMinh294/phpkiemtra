<?php
// Thông tin kết nối
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "ql_nhansu";

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect($servername, $username, $password, $database);

// Kiểm tra kết nối
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// // Thực hiện truy vấn SQL
// $sql = "SELECT * FROM phongban";
// $result = mysqli_query($conn, $sql);

// // Xử lý kết quả
// if (mysqli_num_rows($result) > 0) {
//     while($row = mysqli_fetch_assoc($result)) {
//         echo "Maphong: " . $row["Ma_Phong"]. " - Tenphong: " . $row["Ten_Phong"]. "<br>";
//     }
// } else {
//     echo "0 results";
// }

// // Đóng kết nối
// mysqli_close($conn);
 ?>