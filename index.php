<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Document</title>
</head>
<body>
    
	<h1>Danh sách sinh viên</h1>

	<?php
	require_once 'Student.php';
	require_once 'StudentDAO.php';

	$message = '';
	$studentDAO = new StudentDAO();

	if (isset($_POST['submit'])) {
	    // Lấy thông tin từ form
	    $id = trim($_POST['id']);
	    $name = trim($_POST['name']);
	    $age = trim($_POST['age']);

	    // Kiểm tra sự trùng lặp của id
	    if ($studentDAO->getById($id) != null) {
	        $message = '<p >Mã sinh viên đã tồn tại.</p>';
	    } else {
	        // Tạo đối tượng Student mới
	        $student = new Student($id, $name, $age);

	        // Thêm vào danh sách sinh viên
	        $studentDAO->add($student);

	        // Hiển thị thông báo thành công
	        $message = '<p>Thêm sinh viên thành công.</p>';
	    }
	}
	?>

	<?php echo $message ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
        </tr>
        <?php foreach ($studentDAO->getAll() as $student): ?>
            <tr>
                <td><?php echo $student->getId() ?></td>
                <td><?php echo $student->getName() ?></td>
                <td><?php echo $student->getAge() ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
	<form method="POST">
		<label for="id">ID:</label>
		<input type="text" name="id" id="id" required><br>

		<label for="name">Name:</label>
		<input type="text" name="name" id="name" required><br>

		<label for="age">Age:</label>
		<input type="number" name="age" id="age" required>

		<input type="submit" name="submit" value="Thêm">
	</form>

</body>
</html>
