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
            $studentDormitory = $this->updateStudentDormitory($studentDormitoryRequest);
        } else {
            //create student
            $student = $this->createStudent($studentDormitoryRequest);

            //asigning student id to dormitory request
            $studentDormitoryRequest['student_id'] = $student->id;

            //create student dormitory
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
        //unset student dormitory id
        unset($studentDormitoryRequest['id']);

        //updating student data
        $this->updateStudent($studentDormitoryRequest, $studentDormitory->student_id);

        //update student dormitory data
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
    public function updateStudent(array $requestData, string $studentId): object
    {
        $student = Student::where('id', $studentId)->first();
        $student->update($requestData);
        return $student;
    }
}
