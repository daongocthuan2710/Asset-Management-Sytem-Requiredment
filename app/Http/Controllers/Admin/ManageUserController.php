<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
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
