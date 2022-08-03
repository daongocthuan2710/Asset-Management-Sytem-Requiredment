<?php

namespace App\Repositories;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\BaseRepository;

class ManageCategoryRepository extends BaseRepository
{
    public function __construct()
    {
        $this->query = Category::query();
    }

    public function getAll($request, $sanctumUser)
    {
        $data = $this->query->get();
        return CategoryResource::collection($data);
    }
}
