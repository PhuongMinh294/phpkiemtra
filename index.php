<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THÔNG TIN NHÂN VIÊN</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 50px;
            max-height: 50px;
        }
    </style>
</head>
<body>

<h2>THÔNG TIN NHÂN VIÊN</h2>

<table>
    <tr>
        <th>Mã Nhân Viên</th>
        <th>Tên Nhân Viên</th>
        <th>Giới tính</th>
        <th>Nơi Sinh</th>
        <th>Tên Phòng</th>
        <th>Lương</th>
    </tr>

<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "ql_nhansu";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Truy vấn SQL để đếm số lượng bản ghi trong bảng nhân viên
$sql_count = "SELECT COUNT(*) AS total_records FROM nhanvien";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_records = $row_count['total_records'];

// Số nhân viên trên mỗi trang
$records_per_page = 5;

// Xác định trang hiện tại
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Tính toán vị trí bắt đầu của bản ghi cần lấy
$start = ($current_page - 1) * $records_per_page;

// Truy vấn SQL với LIMIT và OFFSET
$sql = "SELECT * FROM nhanvien LIMIT $start, $records_per_page";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["Ma_NV"] . "</td>";
        echo "<td>" . $row["Ten_NV"] . "</td>";
        echo "<td><img src='" . (isset($row["Phai"]) && $row["Phai"] === "NU" ? "woman.jpg" : "man.jpg") . "' alt='" . (isset($row["PHAI"]) ? $row["PHAI"] : "") . "'></td>";
        echo "<td>" . $row["Noi_Sinh"] . "</td>";
        echo "<td>" . $row["Ma_Phong"] . "</td>";
        echo "<td>" . $row["Luong"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

// Tính toán tổng số trang
$total_pages = ceil($total_records / $records_per_page);



// Kiểm tra xem có trang tiếp theo hay không
$next_page = $current_page + 1;
if ($next_page <= $total_pages) {
    // Nếu có trang tiếp theo, hiển thị nút hoặc liên kết
    echo "<button onclick=\"window.location.href='?page=$next_page'\">Next Page</button>";
}

?>
</table>

</body>
</html>
