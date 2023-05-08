<?php
class StudentDAO {
    private $students;
    public function __construct() {
      $this->students = array();
    }
  
    // Create
    public function addStudent($student) {
      $this->students[] = $student;
    }
  
    // Read
    public function getStudentById($id) {
      foreach ($this->students as $student) {
        if ($student->getId() == $id) {
          return $student;
        }
      }
      return null;
    }
    // Update
    public function updateStudent($id, $name, $age) {
      foreach ($this->students as &$student) {
        if ($student->getId() == $id) {
          $student->setName($name);
          $student->setAge($age);
          return true;
        }
      }
      return false;
    }
  
    // Delete
    public function deleteStudentById($id) {
      foreach ($this->students as $index => $student) {
        if ($student->getId() == $id) {
          unset($this->students[$index]);
          return true;
        }
      }
      return false;
    }
    //getALL
    public function getAllStudents() {
        return $this->students;
      }
  }
  
?>