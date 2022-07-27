<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Services\ManageUserService;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    private ManageUserService $manageUserService;
    public function __construct(ManageUserService $manageUserService)
    {
        $this->ManageUserService = $manageUserService;
    }

    public function index()
    {
        return $this->ManageUserService->getAll();
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function store(Request $request)
    {
        //        $validated_request = $request->validate();

        $user = $this->ManageUserService->store($request);
        return response([
            'message' => 'Created user successfully',
            'user' => $user
            //            'test' => $validated_request
        ], 201);
    }

    public function disable($id)
    {
        return $this->ManageUserService->disable($id);
    }
    public function canDisable($id)
    {
        return $this->ManageUserService->canDisable($id);
    }
}
