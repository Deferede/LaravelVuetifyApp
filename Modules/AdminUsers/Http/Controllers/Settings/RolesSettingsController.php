<?php

namespace App\Http\Controllers\Settings;

use App\Constants\RoleTypes;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Settings\RoleSettingsRequest;
use App\Http\Resources\RoleResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Permission\Models\Role;

class RolesSettingsController extends BaseController
{
    public function __construct()
    {
        $this->middleware('permission:crm.roles-list')->only(['index', 'show']);
        $this->middleware(['permission:crm.roles-edit','role:admin'])->only(['update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return RoleResource::collection(Role::all());
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return RoleResource
     */
    public function show(Role $role)
    {
        return RoleResource::make($role);
    }

    /**
     * Update the specified resource.
     *
     * @param RoleSettingsRequest $request
     * @param Role $role
     * @return JsonResponse|JsonResource
     */
    public function update(RoleSettingsRequest $request, Role $role)
    {
        if ($role->name === RoleTypes::ADMIN_TYPE) {
            return $this->sendError(__('role.permissions.admin_deny'), null, 403);
        }

        $role->permissions()->sync($request->permissions);
        return $this->sendResponse([], __('role.permissions.attached'));
    }
}
