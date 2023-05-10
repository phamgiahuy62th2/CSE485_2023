<?php
class StudentDAO {
    private $students = [];

    public function __construct() {
        $this->loadData();
    }

    private function loadData() {
        if (($handle = fopen("students.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $id = $data[0];
                $name = $data[1];
                $age = $data[2];

                $student = new Student($id, $name, $age);
                array_push($this->students, $student);
            }
            fclose($handle);
        }
    }

    public function getAll() {
        return $this->students;
    }

    public function getById($id) {
        foreach ($this->students as $student) {
            if ($student->getId() == $id) {
                return $student;
            }
        }
        return null;
    }

    public function add($student) {
        if ($this->getById($student->getId()) == null) {
            array_push($this->students, $student);
            $this->saveData();
            return true;
        }
        return false;
    }

    public function update($id, $student) {
        foreach ($this->students as $key => $obj) {
            if ($obj->getId() == $id) {
                $this->students[$key] = $student;
                $this->saveData();
                return true;
            }
        }
        return false;
    }

    public function delete($id) {
        foreach ($this->students as $key => $obj) {
            if ($obj->getId() == $id) {
                unset($this->students[$key]);
                $this->students = array_values($this->students);
                $this->saveData();
                return true;
            }
        }
        return false;
    }

    private function saveData() {
        $handle = fopen("students.csv", "w");
        foreach ($this->students as $student) {
            fputcsv($handle, [$student->getId(), $student->getName(), $student->getAge()]);
        }
        fclose($handle);
    }
}

?>
