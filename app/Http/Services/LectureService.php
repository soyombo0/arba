<?php

namespace App\Http\Services;

use App\Http\Requests\LectureStoreRequest;
use App\Http\Requests\LectureUpdateRequest;
use App\Http\Resources\LectureResource;
use App\Models\Lecture;
use Illuminate\Http\Request;

class LectureService
{
    public function store(LectureStoreRequest $request)
    {
        $data = $request->validated();

        $lecture = Lecture::query()->create($data);

        return LectureResource::make($lecture);
    }

    public function update(LectureUpdateRequest $request, Lecture $lecture)
    {
        $data = $request->validated();

        $lecture->update($data);
        $lecture->save();

        return LectureResource::make($lecture);
    }
}
