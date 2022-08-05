<?php

namespace App\Repositories;

use App\Http\Resources\AssignmentResource;
use App\Models\Assignment;
use App\Repositories\BaseRepository;
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
use Illuminate\Http\Request;
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
        $sanctumUser = auth('sanctum')->user();
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
            ->sortByAssignedState($request)
            ->sortByEditAssignment($request)
            ->sortByCreateAssignment($request)
            ->location($sanctumUser->location);

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
        //update old asset state = 1
        $asset = Asset::query()->findOrFail($assignment->asset_id);
        $asset->update(['state' => 1]);
        //update assigned_by
        $sanctumUser = auth('sanctum')->user();
        //update query
        $assignment->update($request->all());
        $assignment->update(['assigned_by' => $sanctumUser->id]);
        //update new asset state = 2
        $newAsset = Asset::query()->findOrFail($request->asset_id);
        $newAsset->update(['state' => 2]);
        return response()->json([
            'message' => 'Assignment updated successfully'
        ], 200);
    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        $assignment = Assignment::query()->findOrFail($id);
        $asset = Asset::query()->findOrFail($assignment->asset_id);
        $asset->update(['state' => 1]);
        $assignment->delete();
        return response()->json([
            'message' => 'Assignment deleted successfully'
        ], 200);
    }
    public function getById($id)
    {
        $data = $this->query->findOrFail($id);
        return new AssignmentResource($data);
    }
}
