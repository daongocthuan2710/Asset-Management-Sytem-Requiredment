<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\Category;
use App\Repositories\ManageAssetRepository;
use App\Services\BaseService;
use App\Repositories\ManageUserRepository;
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

    public function getAll()
    {
        return $this->manageAssetRepository->getAll();
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
            return $asset;
        }
    }
    private function createNewAssetCode($category_id, $id)
    {
        return sprintf('%s%06d', $category_id, $id);
    }

    public function update($request, $id): \Illuminate\Http\JsonResponse
    {
        //check admin
        $sanctumUser = auth('sanctum')->user();
        if (!$sanctumUser || !$sanctumUser->admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        //validate request
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'specification' => 'string|required',
            'installed_date' => 'date|required',
            'state' => 'integer|required|max:1|min:-2',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        //check asset
        $asset = DB::table('asset')->where('id', $id)->first();
        if (!$asset) {
            return response()->json(['error' => 'Asset not found'], 404);
        }
        //check admin location
        if ($sanctumUser->location != $asset->location) {
            return response()->json(['error' => 'You do not have permission to access this asset'], 401);
        }
        //check asset state
        if ($asset->state == 2) {
            return response()->json(['error' => 'Asset is assigned'], 422);
        }
        //update asset
        return $this->manageAssetRepository->update($request, $id);
    }
    public function edit($request, $id): \Illuminate\Http\JsonResponse
    {
        //check admin
        $sanctumUser = auth('sanctum')->user();
        if (!$sanctumUser || !$sanctumUser->admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        //check asset
        $asset = DB::table('asset')->where('id', $id)->first();
        if (!$asset) {
            return response()->json(['error' => 'Asset not found'], 404);
        }
        //check admin location
        if ($sanctumUser->location != $asset->location) {
            return response()->json(['error' => 'You do not have permission to access this asset'], 401);
        }
        //check asset state
        if ($asset->state == 2) {
            return response()->json(['error' => 'Asset is assigned'], 422);
        }
        //return asset
        return $this->manageAssetRepository->edit($request, $id);
    }

}
