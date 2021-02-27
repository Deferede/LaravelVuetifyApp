<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
            'name' => $this->dname,
            'group' => $this->getGroup($this->name),
        ];

        return $data;
    }

    private function getGroup($name)
    {
        $arr = explode('.', $name);
        $app = $arr[0];
        $arr = explode('-', $arr[1]);
        $group = $arr[0];

        return $group;
    }
}
