<?php

namespace App\Repositories;

use App\Http\Requests\CreateUserRequest;
use App\Repositories\BaseRepository;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Rules\JoinedDateWeekend;
use App\Rules\LatinName;
use App\Rules\Over18;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

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
        $user = $this->query->findOrFail($id);
        if ($user) {
            $user->state = -1;
            $user = new UserResource($user);
            return response()->json([
                'message' => 'update state user disable',
                'new_state' => $user
            ], 200);
        }
    }

    public function canDisable($id)
    {
        $valid = false;
        if ($valid) {
            return response()->json([
                'message' => 'There are valid assignments belonging to this user.
                              Please close all assignments before disabling user.',
                'id' => $id,
                'disable' => $valid
            ], 200);
        } else {
            return response()->json([
                'message' => "There's no one assigned. You can disable this user",
                'id' => $id,
                'disable' => $valid
            ], 200);
        }
    }
}
