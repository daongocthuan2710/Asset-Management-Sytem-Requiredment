<?php

namespace App\Repositories;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\NewUserResource;
use App\Http\Resources\UserResource;
use App\Models\Asset;
use App\Repositories\BaseRepository;
use App\Models\User;
use App\Rules\JoinedDateWeekend;
use App\Rules\LatinName;
use App\Rules\Over18;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\NoReturn;
use phpDocumentor\Reflection\Types\Integer;

class ManageAssignmentRepository extends BaseRepository
{
    public function getAll()
    {
        //
    }
    public function edit($request, $id)
    {
        //
    }
    public function update($request, $id)
    {
        //
    }
    public function show($id)
    {
        //
    }
}
