<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\ManageUserRepository;
use Illuminate\Http\Request;

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

    public function update($request, $id): \Illuminate\Http\JsonResponse
    {
        return $this->manageUserRepository->update($request, $id);
    }
    public function edit($id): \Illuminate\Http\JsonResponse
    {
        return $this->manageUserRepository->edit($id);
    }
}
