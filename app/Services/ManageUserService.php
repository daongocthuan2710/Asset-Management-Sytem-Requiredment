<?php

namespace App\Services;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Services\BaseService;
use App\Repositories\ManageUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class ManageUserService extends BaseService
{
    protected $ManageUserRepository;
    protected $userModel;
    public function __construct(User $userModel, ManageUserRepository $ManageUserRepository)
    {
        $this->userModel = $userModel;
        $this->manageUserRepository = $ManageUserRepository;
    }

    public function getAll()
    {
        return $this->manageUserRepository->getAll();
    }
    public function store($data): User
    {
        $dob = Carbon::parse($data['date_of_birth']);
        $first_name = trim(preg_replace("/\s+/", ' ', $data['first_name']));
        $last_name = trim(preg_replace("/\s+/", ' ', $data['last_name']));
        $base_username = $this->createBaseUsername($first_name, $last_name);

        $user = User::create(
            [
                "first_name" => $first_name,
                "last_name" => $last_name,
                "base_username" => $base_username,
                "date_of_birth" => $data['date_of_birth'],
                "joined_date" => $data['joined_date'],
                "admin" => $data['admin'],
                "location" => $data['location'],
                "gender" => $data['gender'],
            ]
        );
        $id = $user->id;
        $username = $this->createNewUserName($first_name, $last_name, $id);
        $staff_code = $this->createNewStaffCode($id);
        $password = Hash::make($this->generatePassword($username, $dob));
        // $password = $this->generatePassword($username, $dob);
        $user->update(["staff_code" => $staff_code, "username" => $username, "password" => $password]);
        return $user;
    }
    protected function createBaseUsername(string $first_name, string $last_name): string
    {
        $first_name = str_replace(' ', '', strtolower($first_name));
        $last_name = strtolower($last_name);
        $words_of_last_name = explode(" ", $last_name);
        $acronym = "";
        foreach ($words_of_last_name as $word) {
            $acronym .= substr($word, 0, 1);
        }
        return $first_name . $acronym;
    }

    protected function createNewUserName(string $first_name, string $last_name, int $id): string
    {
        $username = static::createBaseUsername($first_name, $last_name);
        $count_duplicate_name = $this->userModel->where('base_username', $username)->where('id', '<', $id)->count();
        if ($count_duplicate_name > 0) {
            $username .= $count_duplicate_name;
        }
        return $username;
    }

    protected function createNewStaffCode(int $id): string
    {
        return sprintf('SD%04d', $id);
    }
    protected function generatePassword(string $username, Carbon $birthday): string
    {
        $part_of_password = $birthday->format('dmY');
        return $username . '@' . $part_of_password;
    }

    public function disable($id)
    {
        return $this->manageUserRepository->disable($id);
    }
    public function canDisable($id)
    {
        return $this->manageUserRepository->canDisable($id);
    }
}
