<?php


namespace Modules\AdminStatuses\Repositories;

use App\Repositories\CoreRepository;
use Modules\AdminStatuses\Entities\Status as Model;
use Modules\AdminStatuses\Filters\StatusesFilter;

class StatusesRepository extends CoreRepository
{

    private StatusesFilter $filter;

    public function __construct(StatusesFilter $filter)
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
