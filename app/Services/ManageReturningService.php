<?php

namespace App\Services;

use App\Repositories\ManageReturningRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class ManageReturningService extends BaseService
{
    protected $manageReturningRepository;
    public function __construct(ManageReturningRepository $manageReturningRepository)
    {
        $this->manageReturningRepository = $manageReturningRepository;
    }

    public function getAll($request)
    {
        return $this->manageReturningRepository->getAll($request);
    }

}
