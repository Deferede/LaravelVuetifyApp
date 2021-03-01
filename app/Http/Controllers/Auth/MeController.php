<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class MeController extends BaseController
{
    /**
     * Get the authenticated User.
     *
     * @return UserResource
     */
    public function me()
    {
        $user = \Auth::user();
        return UserResource::make($user);
    }

    public function hasPermissionTo(Request $request)
    {
        $user = \Auth::user();

        if (!$user->can($request->permissionName))
        {
            return $this->sendError("Forbidden access", [], 403);
        }

        return $this->sendResponse([], 'access granted');
    }
}
