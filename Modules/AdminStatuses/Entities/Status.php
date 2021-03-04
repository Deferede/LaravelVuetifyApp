<?php

namespace Modules\AdminStatuses\Entities;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modules\AdminStatuses\Entities\Status
 *
 * @property int $id
 * @property string $name
 * @property int $priority
 * @property int $status_type_id
 * @property int $status_category_id
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Modules\AdminStatuses\Entities\StatusCategory|null $category
 * @property-read \Modules\AdminStatuses\Entities\StatusType|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status newQuery()
 * @method static \Illuminate\Database\Query\Builder|Status onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Status query()
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereStatusCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereStatusTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Status withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Status withoutTrashed()
 * @mixin \Eloquent
 */
class Status extends Model
{
    use Filterable;

    protected $fillable = ['name', 'priority', 'status_type_id', 'status_category_id'];

    public function type()
    {
        return $this->belongsTo(StatusType::class, 'status_type_id');
    }

    public function category()
    {
        return $this->belongsTo(StatusCategory::class, 'status_category_id');
    }
}
