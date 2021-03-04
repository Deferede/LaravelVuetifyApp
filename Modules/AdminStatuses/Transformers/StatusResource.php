<?php

namespace Modules\AdminStatuses\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'priority' => $this->priority,
            'type' => StatusTypeResource::make($this->type),
            'category' => StatusCategoryResource::make($this->category),
            'active' => $this->active,
            'created_at' => $this->created_at->format("Y-m-d H:i:s")
        ];

        return $data;
    }
}
