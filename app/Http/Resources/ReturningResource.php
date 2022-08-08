<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ReturningResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'assignment' => new AssignmentResource($this->assignment),
            'accepted_by' => new UserResource(User::findOrFail($this->accepted_by)),
            'requested_by' => new UserResource(User::findOrFail($this->requested_by)),
        ];
    }
}
