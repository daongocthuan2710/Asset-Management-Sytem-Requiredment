<?php

namespace App\Services;

use App\Models\Assignment;
use App\Models\Returning;
use App\Repositories\ManageReturningRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class ManageReturningService extends BaseService
{
    protected $manageReturningRepository;
    protected $returning;
    protected $assignment;
    public function __construct(
        ManageReturningRepository $manageReturningRepository,
        Returning $returning,
        Assignment $assignment
    ) {
        $this->manageReturningRepository = $manageReturningRepository;
        $this->returning = $returning;
        $this->assignment = $assignment;
    }

    public function getAll($request)
    {
        return $this->manageReturningRepository->getAll($request);
    }
    public function store(Assignment $assignment)
    {
        $user = request()->user();
        if (!$user->is_admin && $assignment->staff_id != $user->id) {
            return response()->json([
                'error' => "You don't have permission to create returning request for this assignment"
            ], 400);
        }
        if ($user->admin && $user->id == $assignment->staff_id) {
            if ($assignment->state == 1) {
                $return = $this->returning->create([
                'assignment_id' => $assignment->id,
                'requested_by' => $user->id,
                'state' => 0
                ]);
                $assignment->update([
                    'state' => 2 //waiting for returning
                ]);
                return response()->json([
                'data' => $return,
                ], 201);
            }
        }
    }
}
