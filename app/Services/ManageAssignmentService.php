<?php

namespace App\Services;

use App\Http\Requests\UpdateUserRequest;
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
        //
    }
    public function show($id)
    {
        //
    }
}
