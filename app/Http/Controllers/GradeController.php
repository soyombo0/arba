<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradeScheduleStoreRequest;
use App\Http\Requests\GradeScheduleUpdateRequest;
use App\Http\Requests\GradeStoreRequest;
use App\Http\Requests\GradeUpdateRequest;
use App\Http\Resources\GradeResource;
use App\Http\Resources\LectureResource;
use App\Http\Services\GradeService;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function __construct(protected GradeService $service)
    {
    }

    public function index()
    {
        return GradeResource::collection(Grade::all());
    }

    public function store(GradeStoreRequest $request)
    {
        return $this->service->store($request);
    }

    public function show(Grade $grade)
    {
        return GradeResource::make($grade);
    }

    public function update(GradeUpdateRequest $request, Grade $grade)
    {
        return $this->service->update($request, $grade);
    }

    public function destroy(Grade $grade)
    {
        $this->service->destroy($grade);

        return response()->json([
            'message' => 'The grade was deleted'
        ]);
    }

    public function schedule(Grade $grade)
    {
        return LectureResource::collection($grade->lectures);
    }

    public function storeSchedule(GradeScheduleStoreRequest $request)
    {
        $data = $this->service->storeSchedule($request);

        return response()->json([
            'message' => 'Schedule was set to the grade',
            'data' => $data
        ]);
    }

    public function updateSchedule(GradeScheduleUpdateRequest $request)
    {
        $data = $this->service->updateSchedule($request);

        return response()->json([
            'message' => 'Schedule was updated to the grade',
            'data' => $data
        ]);
    }
}
