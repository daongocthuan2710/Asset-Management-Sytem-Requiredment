<?php

namespace App\Services;

use App\Repositories\ManageAssetRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ManageAssetService extends BaseService
{
    protected $_manageAssetRepository;
    public function __construct(ManageAssetRepository $ManageAssetRepository)
    {
        $this->_manageAssetRepository = $ManageAssetRepository;
    }

    public function getAll($request)
    {
        //check admin
        $sanctumUser = auth('sanctum')->user();
        if (!$sanctumUser || !$sanctumUser->admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->_manageAssetRepository->getAll($request, $sanctumUser);
    }

    public function getById($id)
    {
        return $this->_manageAssetRepository->getById($id);
    }

    public function update($request, $id): \Illuminate\Http\JsonResponse
    {
        if ($this->checkPermission($request, $id) !== null) {
            return $this->checkPermission($request, $id);
        }
        //update asset
        return $this->_manageAssetRepository->update($request, $id);
    }
    public function edit($request, $id): \Illuminate\Http\JsonResponse
    {
        if ($this->checkPermission($request, $id) !== null) {
            return $this->checkPermission($request, $id);
        }
        //return asset
        return $this->_manageAssetRepository->edit($request, $id);
    }
    public function checkPermission($request, $id): ?\Illuminate\Http\JsonResponse
    {
        $sanctumUser = auth('sanctum')->user();
        if (!$sanctumUser || !$sanctumUser->admin) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        //check asset
        $asset = DB::table('asset')->where('id', $id)->first();
        if (!$asset) {
            return response()->json(['message' => 'Asset not found'], 404);
        }
        //check admin location
        if ($sanctumUser->location != $asset->location) {
            return response()->json(['message' => 'You do not have permission to access this asset'], 401);
        }
        //check asset state
        if ($asset->state === 2) {
            return response()->json(['message' => 'Asset is assigned'], 422);
        }
        return null;
    }
}
