<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Services\ManageAssetService;
use App\Services\ManageUserService;
use Illuminate\Http\Request;

class ManageAssetController extends Controller
{
    private ManageAssetService $manageAssetService;
    public function __construct(ManageAssetService $manageAssetService)
    {
        $this->manageAssetService = $manageAssetService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->manageAssetService->getAll($request);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAssetRequest $request)
    {
            $input = $request->all();
            return $this->manageAssetService->store($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->manageAssetService->getById($id);
    }

    /**
     * Edit the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, int $id)
    {
        return $this->manageAssetService->edit($request, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAssetRequest $request, int $id)
    {
        return $this->manageAssetService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function destroy($id)
    {
        return $this->manageAssetService->disable($id);
    }
    public function canDestroy($id)
    {
        return $this->manageAssetService->assignmentValid($id);
    }
}
