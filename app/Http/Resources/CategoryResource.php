<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $state = $this->state;
        switch ($state) {
            case -2:
                $state = 'Recycled';
                break;
            case -1:
                $state = 'Waiting for recycling';
                break;
            case 0:
                $state = 'Not available';
                break;
            case 1:
                $state = 'Available';
                break;
            default:
                $state = 'Assigned';
                break;
        }

        return [
            'asset_code' => $this->asset_code,
            'category' => new CategoryResource($this->category_id),
            'name' => $this->name,
            'state' => $state,
            'location' => $this->location
        ];
    }
}
