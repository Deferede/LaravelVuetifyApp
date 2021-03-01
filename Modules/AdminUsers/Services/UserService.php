<?php


namespace Modules\AdminUsers\Services;

use App\Constants\RoleTypes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserService
{
    protected User $user;

    public function __construct(User $user)
    {
            $this->user = $user;
    }

    public function createUser(array $data) : User
    {
        $this->user = User::create($data);

        try {
            $this->assignRoles($data);
        } catch (\Exception $exception) {
            $this->user->forceDelete();
        }

        return $this->user;
    }

    public function updateUser($data, User $user) : User
    {
        $this->user = $user;

        $this->user->update($data);

        $this->updateRoles($data);

        return $user;
    }

    public function deleteUser(User $user)
    {
        $this->user = $user;

        if (Auth::user()->id === $this->user->id) {
            throw new \Exception(__('user.cantDeleteSelf'), 400);
        } elseif ($this->user->id === 1) {
            throw new \Exception(__('user.cantDeleteSuperAdmin'), 400);
        }

        $this->user->delete();
    }

    public function restoreUser($id)
    {
        $user = User::whereId($id)->withTrashed()->firstOrFail();

        if (!$user->restore()) {
            throw new \Exception(__('user.cantRestore'), 400);
        }

        return $user;
    }

    private function assignRoles($data): void
    {
        if (!empty($data['role_id'])) {
            $this->user->syncRoles(Role::findById($data['role_id']));
        } else {
            $this->user->syncRoles(RoleTypes::DEFAULT_USER_TYPE);
        }
    }

    private function updateRoles($data): void
    {
        if ($this->user->id == 1) {
            throw new \Exception(__('user.cantSyncRolesSuperAdmin'));
        }

        if (!empty($data['role'])) {
            $this->user->syncRoles(Role::findById($data['role']));
        }
    }
}
