<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\User;
class ManageUserRepository extends BaseRepository
{
    public int $default_paginate = 20;

    public function __construct()
    {
        $this->query = User::query();
    }

    public function getAll()
    {
        return $this->query->get();
    }
    public function manageUser($request)
    {
        
        $data = $this->query
        ->search($request)
        ->filter($request)
        ->sortByFullName($request)
        ->sortByStaffCode($request)
        ->sortByJoinedDate($request)
        ->sortByType($request)
        ->paginate($this->default_paginate);
        
        return $data;
    }   
}
