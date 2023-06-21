<?php

namespace App\Services;

use App\Models\Student;
use App\Models\StudentDormitory;

class StudentDormitoryService
{
    /**
     * create and update studentDormitory
     * @param array $studentDormitoryRequest
     * @return object
     */
    public function createOrUpdateStudentDormitory(array $studentDormitoryRequest): object
    {
        if (isset($studentDormitoryRequest['id']) && $studentDormitoryRequest['id'] != null) {
        } else {
            $studentDormitory = StudentDormitory::create($studentDormitoryRequest);
        }
        return $studentDormitory;
    }

    /**
     * update Student Dormitory
     */
    public function updateStudentDormitory(array $studentDormitoryRequest): object
    {
        $studentDormitory = StudentDormitory::where('id', $studentDormitoryRequest['id'])->first();
        unset($studentDormitoryRequest['id']);
        $studentDormitory->update($studentDormitoryRequest);
        return $studentDormitory;
    }

    /**
     * create studentData
     * @param array $requestData
     * @return object
     */
    public function createStudent(array $requestData): object
    {
        return Student::create($requestData);
    }
    /**
     * update student
     * @param array $data
     * @param string $studentId
     * @return object
     */
    public function updateStudent(array $data, string $studentId): object
    {
        $student = Student::where('id', $studentId)->first();
        $student->update($data);
        return $student;
    }
}
