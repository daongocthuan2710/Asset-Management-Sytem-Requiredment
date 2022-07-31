<?php

namespace App\Services;

use App\Models\Category;
use App\Services\BaseService;

class ManageCateService extends BaseService
{
    protected $cateModel;
    public function __construct(Category $cateModel)
    {
        $this->cateModel = $cateModel;
    }

    public function getAll()
    {
    }

    public function store($data)
    {
        $sanctumUser = auth('sanctum')->user();
        if (!$sanctumUser || !$sanctumUser->admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            $cate = $this->cateModel->create($data);
            $cate = $cate->find($cate->id);
            $cate->id = $data['id'];
            $cate->save();
            return $cate;
        }
    }
}
