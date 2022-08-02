<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $stateName = $this->state;
        switch ($stateName) {
            case 0:
                $stateName = 'Waiting for acceptance';
                break;
            case -1:
                $stateName = 'Decline';
                break;
            case 1:
                $stateName = 'Accepted';
                break;
        }
        return [
            'id' => $this->id,
            'asset' => new AssetResource($this->asset),
            'assigned_by' => new UserResource(User::findOrFail($this->assigned_by)),
            'staff' => new UserResource(User::findOrFail($this->staff_id)),
            'assigned_date' => $this->assigned_date,
            'note' => $this->note,
            'state' => [
                'code' => $this->state,
                'name' => $stateName
            ]
        ];
    }
}
