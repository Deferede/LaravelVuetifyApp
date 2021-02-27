<?php

namespace App\Http\Resources\Statuses;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'weight' => $this->weight,
            'category' => $this->category->name,
            'type' => $this->type->name,
            'active' => $this->active ? __('other.yes') : __('other.no'),
            'created at' => $this->created_at->format("Y-m-d H:i:s")
        ];

        return $data;
    }
}
