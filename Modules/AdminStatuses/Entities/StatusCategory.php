<?php

namespace Modules\AdminStatuses\Entities;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\AdminStatuses\Entities\StatusCategory
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AdminStatuses\Entities\Status[] $statuses
 * @property-read int|null $statuses_count
 * @method static \Illuminate\Database\Eloquent\Builder|StatusCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusCategory query()
 * @mixin \Eloquent
 */
class StatusCategory extends Model
{
    use Filterable;

    protected $fillable = ['name'];

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }
}
