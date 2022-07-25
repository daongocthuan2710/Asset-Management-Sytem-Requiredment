<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Http\Resources\UserResource;
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
    public function disable($id)
    {
        $haveAssignment = false;
        if ($haveAssignment) {
            return response()->json([
                'message' => 'There are valid assignments belonging to this user. Please close all assignments before disabling user.'
            ], 200);
        } else {
            $user = $this->query->findOrFail($id);
            if ($user) {
                $user->delete();
                return response()->json([
                    'message' => 'delete user success'
                ], 200);
            }
        }
    }
}
