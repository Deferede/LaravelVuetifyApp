<?php

namespace Modules\AdminUsers\Http\Controllers\Settings;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\AdminUsers\Http\Requests\Settings\UserSettingsRequest;
use Modules\AdminUsers\Repositories\UserRepository;
use Modules\AdminUsers\Services\UserService;
use Modules\AdminUsers\Transformers\UsersResource;


class UserSettingsController extends BaseController
{
    private UserService $userService;
    private UserRepository $usersRepo;

    public function __construct(UserService $userService, UserRepository $userRepository)
    {
        $this->middleware(['permission:crm.users-list'])->only(['index', 'show']);
        $this->middleware(['permission:crm.users-create', 'role:admin'])->only(['store']);
        $this->middleware(['permission:crm.users-edit', 'role:admin'])->only(['update']);
        $this->middleware(['permission:crm.users-delete', 'role:admin'])->only(['destroy']);

        $this->userService = $userService;
        $this->usersRepo = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $users = $this->usersRepo->all();
        return $this->sendResponse(UsersResource::collection($users), 'test');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserSettingsRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function store(UserSettingsRequest $request)
    {
        $user = $this->userService->createUser($request->all());
        return $this->sendResponse(UsersResource::make($user), __('user.created', ['name' => $user->username]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return $this->sendResponse(UsersResource::make($user), '');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UserSettingsRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserSettingsRequest $request, User $user)
    {
        $user = $this->userService->updateUser($request->all(), $user);
        return $this->sendResponse(UsersResource::make($user), __('user.updated', ['name' => $user->username]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);
        return $this->sendResponse([], __('user.deleted', ['name' => $user->username]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     * @throws \Exception
     */
    public function restore(Request $request)
    {
        $user = $this->userService->restoreUser($request->id);
        return $this->sendResponse(UsersResource::make($user), __('user.restored', ['name' => $user->username]));
    }
}
