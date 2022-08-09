<?php

namespace App\Repositories;

use App\Http\Resources\ReturningResource;
use App\Models\Returning;
use App\Repositories\BaseRepository;


class ManageReturningRepository extends BaseRepository
{
    public function __construct()
    {
        $this->query = Returning::query();
    }

    public function getAll($request)
    {
        $data = $this->query
            ->search($request)
            ->filterByState($request)
            ->filterByDate($request)
            ->sortByNo($request)
            ->sortByAssetCode($request)
            ->sortByAssetName($request)
            ->sortByRequestedBy($request)
            ->sortByAssignedDate($request)
            ->sortByAcceptedBy($request)
            ->sortByReturnedDate($request)
            ->sortByState($request);

        return ReturningResource::collection($data->paginate(config('app.limit')));
    }
}
