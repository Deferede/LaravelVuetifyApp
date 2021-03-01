<?php

namespace Modules\AdminUsers\Filters;

use App\Filters\QueryFilter;

class UsersFilter extends QueryFilter
{
    /**
     * @param $value
     * @return mixed
     */
    public function username($value)
    {
        return $this->builder->where('username', 'like', "%$value%");
    }

    /**
     * @param $value
     * @return mixed
     */
    public function activeStatus($value)
    {
        if ($value === 'all') {
            return $this->builder->withTrashed();
        } elseif ($value === 'isNotActive') {
            return $this->builder->onlyTrashed();
        }

        return $this->builder;
    }
}
