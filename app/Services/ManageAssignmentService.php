<?php

namespace App\Services;

use App\Repositories\ManageAssignmentRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ManageAssignmentService extends BaseService
{
    protected $manageAssignmentRepository;
    public function __construct(ManageAssignmentRepository $manageAssignmentRepository)
    {
        $this->manageAssignmentRepository = $manageAssignmentRepository;
    }

    public function getAll($request)
    {
        //check admin
        $sanctumUser = auth('sanctum')->user();
        if (!$sanctumUser || !$sanctumUser->admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->manageAssignmentRepository->getAll($request, $sanctumUser);
    }

    public function getById($id)
    {
        //check admin
        $sanctumUser = auth('sanctum')->user();
        if (!$sanctumUser || !$sanctumUser->admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->manageAssignmentRepository->getById($id);
    }
}
