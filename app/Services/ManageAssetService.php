<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\Category;
use App\Repositories\ManageAssetRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ManageAssetService extends BaseService
{
    protected $ManageAssetRepository;
    public function __construct(Asset $assetModel, ManageAssetRepository $ManageAssetRepository)
    {
        $this->assetModel = $assetModel;
        $this->manageAssetRepository = $ManageAssetRepository;
    }

    public function manageUser($request)
    {
        return $this->manageAssetRepository->manageUser($request);
    }

    public function store($data)
    {
        $sanctumUser = auth('sanctum')->user();
        if (!$sanctumUser || !$sanctumUser->admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            $asset = $this->assetModel->create($data);
            $location = $sanctumUser->location;
            $asset_code = $this->createNewAssetCode($data['category_id'], $asset->id);
            $asset = $this->assetModel->find($asset->id);
            $asset->asset_code = $asset_code;
            $asset->location = $location;
            $asset->category_id = $data['category_id'];
            $asset->save();
            return response()->json([
                'message' => 'Create Asset Success',
                'data' => $asset
            ], 201);
        }
    }
    private function createNewAssetCode($category_id, $id)
    {
        return sprintf('%s%06d', $category_id, $id);
    }
    public function getAll($request)
    {
        //check admin
        $sanctumUser = auth('sanctum')->user();
        if (!$sanctumUser || !$sanctumUser->admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->manageAssetRepository->getAll($request, $sanctumUser);
    }

    public function getById($id)
    {
        return $this->manageAssetRepository->getById($id);
    }

    public function update($request, $id): \Illuminate\Http\JsonResponse
    {
        if ($this->checkPermission($request, $id) !== null) {
            return $this->checkPermission($request, $id);
        }
        //update asset
        return $this->manageAssetRepository->update($request, $id);
    }
    public function edit($request, $id): \Illuminate\Http\JsonResponse
    {
        if ($this->checkPermission($request, $id) !== null) {
            return $this->checkPermission($request, $id);
        }
        //return asset
        return $this->manageAssetRepository->edit($request, $id);
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
