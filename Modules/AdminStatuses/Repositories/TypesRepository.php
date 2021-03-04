<?php


namespace Modules\AdminStatuses\Repositories;

use App\Repositories\CoreRepository;
use Modules\AdminStatuses\Entities\StatusType as Model;
use Modules\AdminStatuses\Filters\TypesFilter;

class TypesRepository extends CoreRepository
{
    private TypesFilter $filter;

    public function __construct(TypesFilter $filter)
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
        if ($this->filter->toPaginate()) {
            return $this->startConditions()->filter($this->filter)->paginate($this->filter->getLimit());
        } else {
            return $this->startConditions()->filter($this->filter)->get();
        }
    }
}
