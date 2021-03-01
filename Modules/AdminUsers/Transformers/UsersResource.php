<?php

namespace Modules\AdminUsers\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'role' => RoleResource::make($this->roles->first()),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'is_deleted' => (bool) $this->deleted_at,
        ];

//        if ($request->withPermissionsIds) {
//            $data['permissions_id'] = $this->getAllPermissions()->map(function ($item) {return $item->id;});
//        }
//
        if ($request->withPermissions) {
            $data['permissions'] = PermissionResource::collection($this->getAllPermissions());
        }

        return $data;
    }
}
