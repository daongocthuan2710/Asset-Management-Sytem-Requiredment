<?php

namespace App\Repositories;

use App\Http\Resources\ReportResource;
use App\Models\Category;
use App\Repositories\BaseRepository;
use http\Env\Request;
use Illuminate\Database\Eloquent\Builder;


class ReportRepository extends BaseRepository
{
    public function __construct()
    {
        $this->query = Category::query();
    }

    public function getAll($request)
    {
        $data = $this->query
            ->withCount(["assets AS count_available" => function (Builder $query) {
                $query->where('state', 1);
            }, "assets AS count_not_available" => function (Builder $query) {
                $query->where('state', 0);
            }, "assets AS count_assinged" => function (Builder $query) {
                $query->where('state', 2);
            }, "assets AS count_waiting_for_recycling" => function (Builder $query) {
                $query->where('state', -1);
            }, "assets AS count_recycled" => function (Builder $query) {
                $query->where('state', -2);
            }]);

        return ReportResource::collection($data->get());
    }
}
