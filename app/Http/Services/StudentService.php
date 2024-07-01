<?php

namespace App\Http\Services;

use App\Http\Requests\StudentAttendRequest;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Resources\StudentResource;
use App\Models\Grade;
use App\Models\Lecture;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentService
{
    public function store(StudentStoreRequest $request)
    {
        $data = $request->validated();

        $student = Student::query()->create($data);

        return StudentResource::make($student);
    }

    public function update(StudentUpdateRequest $request, Student $student)
    {
        $data = $request->validated();

        if (isset($data['grade_id'])) {
            $student->grade()->associate(Grade::query()->find($data['grade_id']));
        }

        $student->update($data);
        $student->save();

        return StudentResource::make($student);
    }

    public function attendLecture(StudentAttendRequest $request): string
    {
        $data = $request->validated();

        $student = Student::query()->find($data['student_id']);
        $lecture = Lecture::query()->find($data['lecture_id']);

        if (isset($student['grade_id'])) {
            $grade = Grade::query()->find($student['grade_id']);
            $grade->lectures()->attach($lecture);
        }

        $student->lectures()->attach($lecture);
        $student->save();

        return 'Student' . ' ' . $student->name . ' ' . 'has attended' . ' ' . $lecture->topic;
    }
}
