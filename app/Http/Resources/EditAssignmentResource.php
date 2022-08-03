<?php

namespace App\Http\Resources;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class EditAssignmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $asset = Asset::query()->where('id', $this->asset_id)->first();
        $user = User::query()->where('id', $this->staff_id)->first();
        $admin = User::query()->where('id', $this->assigned_by)->first();
        return [
            'id' => $this->id,
            'asset_id' => $this->asset_id,
            'asset_name' => $asset->name,
            'staff_id' => $this->staff_id,
            'staff_name' => ucfirst($user->first_name) . ' ' . ucwords($user->last_name),
            'staff_username' => $user->username,
            'assigned_by' => $this->assigned_by,
            'assigned_by_name' => ucfirst($admin->first_name) . ' ' . ucwords($admin->last_name),
            'assigned_by_username' => $admin->username,
            'assigned_date' => $this->assigned_date,
            'note' => $this->note,
        ];
    }
}
