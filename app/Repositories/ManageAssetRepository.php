<?php

namespace App\Repositories;

use App\Http\Resources\AssetResource;
use App\Http\Resources\EditAssetResource;
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

    public function getAll($request, $sanctumUser)
    {
        $data = $this->query
            ->where('location', $sanctumUser->location)
            ->search($request)
            ->filterByCategory($request)
            ->filterByState($request)
            ->sortByAssetCode($request)
            ->sortByCategory($request)
            ->sortByName($request)
            ->sortByState($request)
            ->sortByEditAsset($request)
            ->sortByCreateAsset($request);

        if (empty($request->all())) {
            $data->orderBy('name', 'asc');
        }

        if (!$request->has('no-paginate')) {
            return AssetResource::collection($data->paginate(config('app.limit')));
        } else {
            return AssetResource::collection($data->where('state', 1)->get());
        }
    }

    public function getById($id)
    {
        return new AssetResource(
            $this->query->where('id', $id)->firstOrFail()
        );
    }

    public function edit($request, $id)
    {
        $asset = $this->query->find($id);
        return response()->json(new EditAssetResource($asset), 200);
    }

    public function update($request, $id): \Illuminate\Http\JsonResponse
    {
        $asset = $this->query->find($id);
        $asset->update($request->all());
        return response()->json([
            'message' => 'Asset updated successfully'
        ], 200);
    }
    public function report($request)
    {
        $report = DB::select(
            'select a.category_id id, c.name category, count(a.state) total,
                   COALESCE((select count(a0.state) from asset a0 where a0.state = 0 and a0.category_id = a.category_id group by a0.category_id), 0) as not_available,
                   COALESCE((select count(a1.state) from asset a1 where a1.state = 1 and a1.category_id = a.category_id group by a1.category_id), 0) as available,
                   COALESCE((select count(a2.state) from asset a2 where a2.state = 2 and a2.category_id = a.category_id group by a2.category_id), 0) as assigned,
                   COALESCE((select count(a3.state) from asset a3 where a3.state = -1 and a3.category_id = a.category_id group by a3.category_id), 0) as waiting_for_recycling,
                   COALESCE((select count(a4.state) from asset a4 where a4.state = -2 and a4.category_id = a.category_id group by a4.category_id), 0) as recycled
            from asset a
            join category c on a.category_id = c.id
            group by a.category_id, c.name
            order by ?',
            [$request->sortBy . ' ' . $request->sortOrder]
        );
        return response()->json(
            $report,
            200
        );
    }
}
