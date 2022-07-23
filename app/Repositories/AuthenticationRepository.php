<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;

class AuthenticationRepository extends BaseRepository
{
    public function __construct()
    {
        $this->query = User::query();
    }

    public function getAll()
    {
        return $this->query->get();
    }

    public function getUserInformation($request)
    {
        $bearerArr = explode(" ", $request->header('Authorization'));
        $token = explode("|", $bearerArr[1]);
        $bearer = DB::table('personal_access_tokens')->where('id', $token[0])->first();
        $user = $this->query->where('id', $bearer->tokenable_id)->first();
        return $user;
    }

    public function login($request)
    {

        $user = User::where('username', $request->username)->first();

        if ($request->username == '' || $request->password == '') {
            return response()->json(['message' => 'Username or password can not be null '], 404);
        }
        if (!$user) {
            return response()->json(['message' => 'Username or password is incorrect please try again ! '], 404);
        }
        if ((!Hash::check($request->password, $user->password))) {
            return response()->json(['message' => 'Username or password is incorrect please try again ! '], 404);
        }
        if ($user->state == -1) {
            return response()->json(['message' => 'Your account has been disable ! '], 404);
        }



        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json(
            ['message' => 'Login Success ! '    ,
            'username' => $user->username,
            'state' => $user->state,
            'admin' => $user->admin,
            'token' => $token,
            'token_type' => 'Bearer',
            ],
            200
        );
    }

    public function logout()
    {
        $user = request()->user();
        $user->tokens()->delete();
        return response()->json(['message' => 'Logout Success ! '], 200);
    }
}
