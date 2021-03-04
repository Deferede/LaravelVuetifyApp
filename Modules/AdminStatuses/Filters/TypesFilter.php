<?php

namespace Modules\AdminStatuses\Filters;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class TypesFilter extends QueryFilter
{
    public function activeStatus($value): Builder
    {
        if ($value === 'all') {
            return $this->builder->withTrashed();
        } elseif ($value === 'isNotActive') {
            return $this->builder->onlyTrashed();
        }

        return $this->builder;
    }
}
