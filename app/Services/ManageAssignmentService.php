<?php

namespace App\Services;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Asset;
use App\Models\Assignment;
use Carbon\Carbon;
use App\Repositories\ManageAssignmentRepository;
use App\Services\BaseService;
use App\Repositories\ManageUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageAssignmentService extends BaseService
{
    protected $manageAssignmentRepository;
    protected $userModel;
    protected $assetModel;
    protected $assignmentModel;
    public function __construct(
        ManageAssignmentRepository $ManageAssignmentRepository,
        Asset $assetModel,
        User $userModel,
        Assignment $assignmentModel
    ) {
        $this->assetModel = $assetModel;
        $this->userModel = $userModel;
        $this->assignmentModel = $assignmentModel;
        $this->manageAssignmentRepository = $ManageAssignmentRepository;
    }

    public function getAll()
    {
        //
    }
    public function store($data)
    {
        $sanctumUser = auth('sanctum')->user();
        if (!$sanctumUser || !$sanctumUser->admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            $assignment = $this->assignmentModel->create(
                [
                    "staff_id" => $data["staff_id"],
                    "asset_id" => $data["asset_id"],
                    "note" => $data["note"],
                    "assigned_date" => $data["assigned_date"],
                    "state" => 0
                ]
            );
            $assignment = $this->assignmentModel->find($assignment->id);
            $assignment->assigned_by = $sanctumUser->id;
            $assignment->save();
            $asset = $this->assetModel->find($data['asset_id']);
            $asset->state = 2;
            $asset->save();
            return response()->json([
                "assignment" => $assignment
            ], 201);
        }
    }
    public function update($request, $id)
    {
        //
    }
    public function edit($request, $id)
    {
        //
    }
    public function show($id)
    {
        //
    }
}
