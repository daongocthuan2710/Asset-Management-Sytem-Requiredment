<?php

namespace App\Repositories;

use App\Http\Resources\AssignmentResource;
use App\Models\Assignment;
use App\Repositories\BaseRepository;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\NoReturn;
use phpDocumentor\Reflection\Types\Integer;

class ManageAssignmentRepository extends BaseRepository
{
    public function __construct()
    {
        $this->query = Assignment::query();
    }

    public function getAll($request, $sanctumUser)
    {
        $data = $this->query
            ->search($request)
            ->filterByState($request)
            ->filterByDate($request)
            ->sortByNo($request)
            ->sortByAssetCode($request)
            ->sortByAssetName($request)
            ->sortByAssignedTo($request)
            ->sortByAssignedBy($request)
            ->sortByAssignedDate($request)
            ->sortByAssignedState($request);


        return AssignmentResource::collection($data->paginate(config('app.limit')));
    }
}
