<?php

namespace Modules\AdminStatuses\Entities;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\AdminStatuses\Entities\StatusType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AdminStatuses\Entities\Status[] $statuses
 * @property-read int|null $statuses_count
 * @method static \Illuminate\Database\Eloquent\Builder|StatusType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusType query()
 * @mixin \Eloquent
 */
class StatusType extends Model
{
    use Filterable;

    protected $fillable = ['name'];

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

}
