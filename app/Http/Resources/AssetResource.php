<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
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
            case -2:
                $stateName = 'Recycled';
                break;
            case -1:
                $stateName = 'Waiting for recycling';
                break;
            case 0:
                $stateName = 'Not available';
                break;
            case 1:
                $stateName = 'Available';
                break;
            default:
                $stateName = 'Assigned';
                break;
        }

        return [
            'asset_code' => $this->asset_code,
            'category' => new CategoryResource($this->category),
            'name' => $this->name,
            'state' => [
                'code' => $this->state,
                'name' => $stateName
            ],
            'location' => $this->location
        ];
    }
}
