<?php

namespace App\Http\Controllers;

use App\Http\Requests\LectureStoreRequest;
use App\Http\Requests\LectureUpdateRequest;
use App\Http\Resources\LectureResource;
use App\Http\Services\LectureService;
use App\Models\Lecture;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function __construct(protected LectureService $service)
    {
    }

    public function index()
    {
        return LectureResource::collection(Lecture::all());
    }

    public function store(LectureStoreRequest $request)
    {
        return $this->service->store($request);
    }

    public function show(Lecture $lecture)
    {
        return LectureResource::make($lecture);
    }

    public function update(LectureUpdateRequest $request, Lecture $lecture)
    {
        return $this->service->update($request, $lecture);
    }

    public function destroy(Lecture $lecture)
    {
        return $lecture->delete();
    }
}
