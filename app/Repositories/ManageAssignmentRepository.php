<?php

namespace App\Repositories;

use App\Http\Resources\AssignmentResource;
use App\Models\Assignment;
use App\Repositories\BaseRepository;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\EditAssignmentResource;
use App\Http\Resources\NewUserResource;
use App\Http\Resources\UserResource;
use App\Models\Asset;
use App\Models\User;
use App\Rules\JoinedDateWeekend;
use App\Rules\LatinName;
use App\Rules\Over18;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\NoReturn;
use phpDocumentor\Reflection\Types\Integer;

class ManageAssignmentRepository extends BaseRepository
{
    public function __construct()
    {
        $this->query = Assignment::query();
    }

    public function getAll($request, $sanctumUser)
    {
        $data = $this->query
            ->search($request)
            ->filterByState($request)
            ->filterByDate($request)
            ->sortByNo($request)
            ->sortByAssetCode($request)
            ->sortByAssetName($request)
            ->sortByAssignedTo($request)
            ->sortByAssignedBy($request)
            ->sortByAssignedDate($request)
            ->sortByAssignedState($request);


        return AssignmentResource::collection($data->paginate(config('app.limit')));
    }
    public function edit($request, $id)
    {
        $assignment = Assignment::query()->findOrFail($id);
        return response()->json(new EditAssignmentResource($assignment), 200);
    }

    public function update($request, $id)
    {
        $assignment = Assignment::query()->findOrFail($id);
        $sanctumUser = auth('sanctum')->user();
        $assignment->update($request->all());
        $assignment->update(['assigned_by' => $sanctumUser->id]);
        return response()->json([
            'message' => 'Assignment updated successfully'
        ], 200);
    }

    public function show($id)
    {
        //
    }
}
