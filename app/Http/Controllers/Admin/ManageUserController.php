<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rules\JoinedDateWeekend;
use App\Rules\LatinName;
use App\Rules\Over18;
use App\Services\ManageUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    /**
     * Edit the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->ManageUserService->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        return $this->ManageUserService->update($request, $id);
    }

    public function store(Request $request)
    {
        $message = [
            'joined_date.after' => 'Joined date is not later than Date of Birth. Please select a different date',
            'first_name.required' => 'Please input first name',
            'last_name.required' => 'Please input last name',
        ];
        $validate = Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:64', new LatinName()],
                'last_name' => ['required', 'string', 'max:64', new LatinName()],
                'date_of_birth' => ['required', 'date', new Over18()],
                'joined_date' => ['required', 'date', 'after:date_of_birth', new JoinedDateWeekend()],
                'admin' => ['required', 'bool', Rule::in([0, 1])],
                'gender' => ['required', 'integer', Rule::in([0, 1])],
                ], $message);
        if ($validate->fails()) {
            return response()->json(['message' => $validate->errors()], 400);
        }
//        $validate = $request->validated();
        $user = $this->ManageUserService->store($request);
        return response([
            'message' => 'Created user status',
            'user' => $user
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
    public function manageUser(Request $request)
    {
        return $this->ManageUserService->manageUser($request);
    }
}
