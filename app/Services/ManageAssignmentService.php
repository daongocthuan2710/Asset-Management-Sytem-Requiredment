<?php

namespace App\Services;

use App\Http\Requests\UpdateUserRequest;
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
        //
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
        if (!$sanctumUser || !$sanctumUser->admin) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $assignment = Assignment::query()->findOrFail($id);
        if (!$assignment) {
            return response()->json(['message' => 'Assignment not found'], 404);
        }
        $userId = $assignment->staff_id;
        $user = User::query()->findOrFail($userId);
        $location = $user->location;
//        return [
//            'ulocation' => $location,
//            'alocation' => $sanctumUser->location,
//        ];
//        if ($location != $sanctumUser->location) {
//            return response()->json(['message' => 'You cannot edit assignment in other location!'], 401);
//        }
        if ($assignment->state != 0) {
            return response()->json(['message' => 'You cannot edit accepted or declined assignment!'], 422);
        }
        return null;
    }
    public function show($id)
    {
        //
    }
}
