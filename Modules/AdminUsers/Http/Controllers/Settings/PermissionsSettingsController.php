<?php

namespace Modules\AdminUsers\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Modules\AdminUsers\Transformers\PermissionResource;
use Spatie\Permission\Models\Permission;

class PermissionsSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:crm.permissions-list']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PermissionResource::collection(Permission::all());
    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permission
     * @return PermissionResource
     */
    public function show(Permission $permission)
    {
        return PermissionResource::make($permission);
    }
}
