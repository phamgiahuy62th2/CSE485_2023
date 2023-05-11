<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sinh viên</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <?php
    // Kiểm tra xem form đã được submit hay chưa
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy dữ liệu từ form
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];

        // Kiểm tra sự trùng lặp
        $isDuplicate = false;
        $file = fopen("students.txt", "r");
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $data = explode("\t", $line);
                if (trim($data[0]) == $id || trim($data[1]) == $name) {
                    $isDuplicate = true;
                    break;
                }
            }
            fclose($file);
        }

        // Nếu không có sự trùng lặp, lưu dữ liệu vào file
        if (!$isDuplicate) {
            $newStudent = "$id\t$name\t$age\n";
            file_put_contents("students.txt", $newStudent, FILE_APPEND);
        }
    }

    // Đọc dữ liệu từ file và lưu vào danh sách sinh viên
    $students = array();
    $file = fopen("students.txt", "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $data = explode("\t", $line);
            $student = array(
                'id' => trim($data[0]),
                'name' => trim($data[1]),
                'age' => trim($data[2])
            );
            $students[] = $student;
        }
        fclose($file);
    }
    ?>

    <h1>Danh sách sinh viên</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Họ và tên</th>
            <th>Tuổi</th>
        </tr>
        <?php foreach ($students as $student) : ?>
            <tr>
                <td><?php echo $student['id']; ?></td>
                <td><?php echo $student['name']; ?></td>
                <td><?php echo $student['age']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Thêm sinh viên mới</h2>
    <form method="POST">
        <label for="id">ID:</label>
        <input type="text" name="id" required>
        <br>
        <label for="name">Họ và tên:</label>
        <input type="text" name="name" required>
        <br>
        <label for="age">Tuổi:</label>
        <input type="number" name="age" required>
        <br>
        <input type="submit" value="Thêm sinh viên">
    </form>
</body
