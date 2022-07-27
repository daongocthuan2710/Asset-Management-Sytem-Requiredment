<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        $fullName = $this->last_name . ' ' . $this->first_name;
//        if ($this->gender) {
//            $gender = 'Male';
//        } elseif ($this->gender == null) {
//            $gender = '';
//        } else {
//            $gender = 'Female';
//        }
        return [
            'id' => $this->id,
            'staff_code' => $this->staff_code,
            'full_name' => $fullName,
            'username' => $this->username,
            'birthday' => $this->date_of_birth,
            'gender' => $this->gender,
            'joined_date' => $this->joined_date,
            'admin' => $this->admin,
            'location' => $this->location,
            'state' => $this->state
        ];
    }
}
