<?php

namespace Modules\AdminUsers\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserResource extends JsonResource
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
            'username' => $this->username,
            'email' => $this->email,
            'api_token' => $this->api_token,
            'roles' => $this->roles->map(function ($role) {return $role->name;}),
            'permissions' => $this->getAllPermissions()->map(function ($permission) {return $permission->name;}),
        ];

        return $data;
    }
}
