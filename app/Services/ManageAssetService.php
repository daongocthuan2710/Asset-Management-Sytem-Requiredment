<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\Assignment;
use App\Repositories\ManageAssetRepository;
use App\Services\BaseService;
use App\Repositories\ManageUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ManageAssetService extends BaseService
{
    protected $ManageAssetRepository;
    public function __construct(ManageAssetRepository $ManageAssetRepository, Assignment $assignment)
    {
        $this->assignment = $assignment;
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
    public function disable($id)
    {
        $sanctumUser = auth('sanctum')->user();
        if (!$sanctumUser || !$sanctumUser->admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            $asset = Asset::query()->findOrFail($id);
            $assignment = Assignment::where('asset_id', $id)->count();
            if ($assignment > 0) {
                return response()->json([
                    'message' => "You can't do any actions on an asset has been assigned"
                ], 400);
            } else {
                $asset->delete();
                return response()->json([
                    'message' => 'Asset have been deleted',
                ], 200);
            }
        }
    }
}
