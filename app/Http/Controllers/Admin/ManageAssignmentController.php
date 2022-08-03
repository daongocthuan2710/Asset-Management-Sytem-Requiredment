<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAssignmentRequest;
use App\Services\ManageAssignmentService;
use Illuminate\Http\Request;

class ManageAssignmentController extends Controller
{
    private ManageAssignmentService $manageAssignmentService;
    public function __construct(ManageAssignmentService $ManageAssignmentService)
    {
        $this->manageAssignmentService = $ManageAssignmentService;
    }
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(CreateAssignmentRequest $request)
    {
        $input = $request->all();
        return $this->manageAssignmentService->store($input);
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
