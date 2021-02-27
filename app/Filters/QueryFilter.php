<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected Builder $builder;

    protected array $data;

    protected array $columns;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getLimit()
    {
        return $this->request->has('limit') ? $this->request->limit : 25;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        $this->columns = \Schema::getColumnListing($this->builder->getModel()->getTable());

        foreach ($this->request->all() as $filter => $value)
        {
            if (!$value) {
                continue;
            }

            if (method_exists($this, $filter))
            {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    /**
     *
     * @param $value
     * @return mixed
     */
    public function offset($value)
    {
        return $this->builder->offset($value);
    }

    public function search($value)
    {
        if (!empty($value)) {
            return $this->builder->where(function (Builder $query) use ($value) {
                foreach ($this->columns as $column) {
                    $query->orWhere($column, 'like', "%".$value."%");
                }
            });
        }
        return $this->builder;
    }

    public function orderBy($value)
    {
        $orders = explode('|', $value);
        $column = $orders[0];
        $orderDesc = $orders[1] === "true";

        if (isset(array_flip($this->columns)[$column])) {
            if (!$orderDesc) {
                return $this->builder->orderBy($column);
            } else {
                return $this->builder->orderByDesc($column);
            }
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    public function limit($value)
    {
        return $this->builder->limit($value);
    }

}
