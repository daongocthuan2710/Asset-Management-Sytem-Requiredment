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
        ->sortByType($request);
        if (!$request->has('sortByFullName')) {
            $data = $data->orderBy('first_name', 'asc');
        }
        if (!$request->has('sortByStaffCode')) {
            $data = $data->orderBy('staff_code', 'asc');
        }
        if (!$request->has('sortByJoinedDate')) {
            $data = $data->orderBy('joined_date', 'asc');
        }
        if (!$request->has('sortByType')) {
            $data = $data->orderBy('admin', 'asc');
        }
        
        return $data->paginate($this->default_paginate);
    }   
}
