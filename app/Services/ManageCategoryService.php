<?php

namespace App\Services;

use App\Repositories\ManageCategoryRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ManageCategoryService extends BaseService
{
    protected $manageCategoryRepository;
    public function __construct(ManageCategoryRepository $manageCategoryRepository)
    {
        $this->manageCategoryRepository = $manageCategoryRepository;
    }

    public function getAll(Request $request)
    {
        //check admin
        $sanctumUser = auth('sanctum')->user();
        if (!$sanctumUser || !$sanctumUser->admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->manageCategoryRepository->getAll($request, $sanctumUser);
    }
}
