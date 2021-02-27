<?php

namespace App\Repositories;

use App\Filters\UsersFilter;
use App\Models\User as Model;

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
