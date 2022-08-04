<?php

namespace App\Services;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Asset;
use App\Models\Assignment;
use App\Models\User;
use App\Repositories\ManageAssignmentRepository;
use App\Services\BaseService;
use App\Repositories\ManageUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class ManageAssignmentService extends BaseService
{
    protected $manageAssignmentRepository;
    public function __construct(ManageAssignmentRepository $ManageAssignmentRepository)
    {
        $this->manageAssignmentRepository = $ManageAssignmentRepository;
    }

    public function getAll()
    {
        //
    }
    public function store($data)
    {
        //
    }
    public function update($request, $id)
    {
        if ($this->checkPermission($request, $id) !== null) {
            return $this->checkPermission($request, $id);
        } else {
            //check request data
            $sanctumUser = auth('sanctum')->user();
            $user = User::find($request->staff_id);
            $asset = Asset::find($request->asset_id);
            //if user is not existed
            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], 404);
            }
            //if asset is not existed
            if (!$asset) {
                return response()->json([
                    'message' => 'Asset not found'
                ], 404);
            }
            //if user is not in the same location
            if ($user->location != $sanctumUser->location) {
                return response()->json(
                    [
                        "message" => "You can't assign asset to user in other location",
                    ],
                    400
                );
            }
            //if asset is not in the same location
            if ($asset->location != $sanctumUser->location) {
                return response()->json(
                    [
                        "message" => "You can't assign asset in other location",
                    ],
                    400
                );
            }
            //if asset is not available
            if ($asset->state !== 1) {
                return response()->json(
                    [
                        "message" => "Asset is not available",
                    ],
                    400
                );
            }
            //if user is disable
            if ($user->state === -1) {
                return response()->json(
                    [
                        "message" => "User is disabled",
                    ],
                    400
                );
            }
            return $this->manageAssignmentRepository->update($request, $id);
        }
    }
    public function edit($request, $id)
    {
        if ($this->checkPermission($request, $id) !== null) {
            return $this->checkPermission($request, $id);
        } else {
            return $this->manageAssignmentRepository->edit($request, $id);
        }
    }
    public function checkPermission($request, $id)
    {
        $sanctumUser = auth('sanctum')->user();
        //not an admin
        if (!$sanctumUser || !$sanctumUser->admin) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $assignment = Assignment::query()->findOrFail($id);
        $asset = Asset::query()->findOrFail($assignment->asset_id);
        $admin = User::query()->findOrFail($assignment->assigned_by);
        $user = User::query()->findOrFail($assignment->staff_id);
        //check location
        if (
            ($sanctumUser->location !== $user->location)
            || ($sanctumUser->location !== $admin->location)
            || ($sanctumUser->location !== $asset->location)
        ) {
            return response()->json(['message' => 'You cannot edit assignment in other location!'], 401);
        }
        //check state of assignment
        if ($assignment->state !== 0) {
            return response()->json(['message' => 'You cannot edit accepted or declined assignment!'], 422);
        }
        return null;
    }
    public function show($id)
    {
        //
    }
}
