<?php
class StudentDAO {
    private $students;
    
    public function __construct() {
        $this->students = array();
    }
    
    public function createStudent($student) {
        $this->students[] = $student;
    }
    
    public function getStudent($id) {
        foreach ($this->students as $student) {
            if ($student->getId() === $id) {
                return $student;
            }
        }
        return null;
    }
    
    public function updateStudent($id, $newStudent) {
        foreach ($this->students as $key => $student) {
            if ($student->getId() === $id) {
                $this->students[$key] = $newStudent;
                return true;
            }
        }
        return false;
    }
    
    public function deleteStudent($id) {
        foreach ($this->students as $key => $student) {
            if ($student->getId() === $id) {
                array_splice($this->students, $key, 1);
                return true;
            }
        }
        return false;
    }
    
    public function getAllStudents() {
        return $this->students;
    }
}?>
