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

        return $this->query->with('asset')->get();

        // $data = $this->query;

        // return ReturningResource::collection($data->paginate(config('app.limit')));
    }



}
