<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\User;

class ManageUserRepository extends BaseRepository
{
    public function __construct()
    {
        $this->query = User::query();
    }

    public function getAll()
    {
        return $this->query->get();
    }
}
