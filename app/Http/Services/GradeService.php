<?php

namespace App\Http\Services;

use App\Http\Requests\GradeScheduleStoreRequest;
use App\Http\Requests\GradeScheduleUpdateRequest;
use App\Http\Requests\GradeStoreRequest;
use App\Http\Requests\GradeUpdateRequest;
use App\Http\Resources\GradeResource;
use App\Models\Grade;
use App\Models\Lecture;
use Illuminate\Http\Request;

class GradeService
{
    public function store(GradeStoreRequest $request)
    {
        $data = $request->validated();

        $grade = Grade::query()->create($data);

        return GradeResource::make($grade);
    }

    public function update(GradeUpdateRequest $request, Grade $grade)
    {
        $data = $request->validated();

        $grade->update($data);

        return GradeResource::make($grade);
    }

    public function destroy(Grade $grade)
    {
        $grade->students()->update(['grade_id' => null]);

        return $grade;
    }

    public function storeSchedule(GradeScheduleStoreRequest $request)
    {
        $data = $request->validate([
            'lectures_id' => ['array'],
            'grade_id' => 'integer'
        ]);
        $grade = Grade::query()->find($data['grade_id']);

        foreach ($data['lectures_id'] as $lectureId) {
            $lecture = Lecture::query()->find($lectureId);
            $grade->lectures()->attach($lecture);
        }

        return $grade;
    }

    public function updateSchedule(GradeScheduleUpdateRequest $request)
    {
        $data = $request->validated();
        $grade = Grade::query()->find($data['grade_id']);

        foreach ($data['lectures_id'] as $lectureId) {
            $lecture = Lecture::query()->find($lectureId);
            $grade->lectures()->attach($lecture);
        }

        return $grade;
    }
}
