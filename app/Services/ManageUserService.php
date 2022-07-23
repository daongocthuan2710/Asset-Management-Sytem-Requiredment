<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\ManageUserRepository;

class ManageUserService extends BaseService
{
    protected $ManageUserRepository;
    public function __construct(ManageUserRepository $ManageUserRepository)
    {
        $this->manageUserRepository = $ManageUserRepository;
    }

    public function getAll()
    {
        return $this->manageUserRepository->getAll();
    }
}
