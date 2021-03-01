<?php

namespace Modules\AdminUsers\Repositories;

use App\Models\User as Model;
use App\Repositories\CoreRepository;
use Modules\AdminUsers\Filters\UsersFilter;

class UserRepository extends CoreRepository
{
    private UsersFilter $filter;

    public function __construct(UsersFilter $filter)
    {
        parent::__construct();
        $this->filter = $filter;
    }

    protected function getModelClass(): string
    {
        return Model::class;
    }

    public function all()
    {
        return $this->startConditions()->filter($this->filter)->paginate($this->filter->getLimit());
    }
}
