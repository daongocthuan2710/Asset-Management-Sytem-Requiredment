<?php

namespace App\Repositories;

use App\Http\Resources\UserResource;
use App\Models\Asset;
use App\Repositories\BaseRepository;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\NoReturn;
use phpDocumentor\Reflection\Types\Integer;

class ManageAssetRepository extends BaseRepository
{
    public function __construct()
    {
        $this->query = Asset::query();
    }

    public function getAll()
    {
        return $this->query->get();
    }

    public function edit($request, $id)
    {
        try {
            $asset = $this->query->find($id);
            $category = DB::table('category')->where('id', $asset->category_id)->first();
            return response()->json([
                'name' => $asset->name,
                'category' => $category->name,
                'specification' => $asset->specification,
                'installed_date' => $asset->installed_date,
                'state' => $asset->state,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }

    public function update($request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $asset = $this->query->find($id);
            $asset->update($request->all());
            return response()->json([
                'message' => 'Asset updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }
}
