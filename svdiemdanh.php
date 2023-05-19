<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_management";

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}


// Danh sách sinh viên cần lấy dữ liệu điểm danh
$studentIds = array(1, 2, 3,4); // ID của các sinh viên

// Chuyển danh sách sinh viên thành chuỗi để sử dụng trong câu truy vấn
$studentIdsStr = implode(", ", $studentIds);

// Câu truy vấn SQL để lấy dữ liệu điểm danh của nhiều sinh viên
$sql = "SELECT Attendance.attendance_date, Courses.course_title, Attendance.attendance_status
        FROM Attendance
        INNER JOIN Courses ON Attendance.course_id = Courses.course_id
        WHERE Attendance.student_id IN ($studentIdsStr)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Hiển thị thông tin điểm danh của sinh viên
    echo "<table>
            <tr>
                <th>Ngày điểm danh</th>
                <th>Tên khóa học</th>
                <th>Trạng thái điểm danh</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["attendance_date"] . "</td>
                <td>" . $row["course_title"] . "</td>
                <td>" . $row["attendance_status"] . "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "Không có thông tin điểm danh.";
}

// Đóng kết nối
$conn->close();
?>
