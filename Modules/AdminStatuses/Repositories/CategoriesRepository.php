<?php


namespace Modules\AdminStatuses\Repositories;

use App\Repositories\CoreRepository;
use Modules\AdminStatuses\Entities\StatusCategory as Model;
use Modules\AdminStatuses\Filters\CategoriesFilter;

class CategoriesRepository extends CoreRepository
{
    private CategoriesFilter $filter;

    public function __construct(CategoriesFilter $filter)
    {
        parent::__construct();
        $this->filter = $filter;
    }

    protected function getModelClass(): string
    {
        return Model::class;
    }

    public function all(bool $paginate = true)
    {
        if ($paginate) {
            return $this->startConditions()->filter($this->filter)->paginate($this->filter->getLimit());
        } else {
            return $this->startConditions()->filter($this->filter)->get();
        }
    }
}
