<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentAttendRequest;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Resources\StudentResource;
use App\Http\Services\StudentService;
use App\Models\Lecture;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(protected StudentService $service)
    {
    }

    public function index()
    {
        return StudentResource::collection(Student::all());
    }

    public function store(StudentStoreRequest $request)
    {
        return $this->service->store($request);
    }

    public function show(Student $student)
    {
        return StudentResource::make($student);
    }

    public function update(StudentUpdateRequest $request, Student $student)
    {
       return $this->service->update($request, $student);
    }

    public function destroy(Student $student)
    {
        $student->delete();
    }

    public function attendLecture(StudentAttendRequest $request)
    {
        $data = $this->service->attendLecture($request);

        return response()->json([
           'message' => 'success',
           'data' => $data
        ]);
    }
}
