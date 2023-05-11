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
</body>
</html>