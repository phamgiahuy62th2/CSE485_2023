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

// Lấy danh sách sinh viên đã đăng ký khóa học cụ thể
$courseId = 1; // ID của khóa học cần điểm danh
$sql = "SELECT Students.student_id, Students.student_name, Attendance.attendance_status
        FROM Students
        INNER JOIN Attendance ON Students.student_id = Attendance.student_id
        WHERE Attendance.course_id = $courseId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Hiển thị danh sách sinh viên và trạng thái điểm danh
    echo "<table>
            <tr>
                <th>ID sinh viên</th>
                <th>Tên sinh viên</th>
                <th>Trạng thái điểm danh</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["student_id"] . "</td>
                <td>" . $row["student_name"] . "</td>
                <td>" . $row["attendance_status"] . "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "Không có sinh viên đăng ký khóa học này.";
}

// Đóng kết nối
$conn->close();
?>
