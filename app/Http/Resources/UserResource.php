<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Gender
        $gender = $this->gender;
        if ($gender === 1) $gender = 'Male';
        elseif ($gender === 0) $gender = 'Female';
        else $gender = '';
        // Date Format
        $newDate = date("d/m/Y", strtotime($this->joined_date));
        //Full Name
        $fullName = ucfirst($this->first_name) . ' ' . ucwords($this->last_name);
        return [
            'staff_code' => $this->staff_code,
            'full_name' => $fullName,
            'username' => $this->username,
            'birthday' => $this->date_of_birth,
            'gender' => $gender,
            'joined_date' => $newDate,
            'admin' => $this->admin,
            'location' => $this->location,
            'state' => $this->state,
            'id' => $this->id,
        ];
    }
}
