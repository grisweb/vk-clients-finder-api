<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\FoundUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FoundUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FoundUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FoundUser query()
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FoundUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoundUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoundUser whereUpdatedAt($value)
 * @property string $uuid
 * @property int $vk_id
 * @property string $first_name
 * @property string $last_name
 * @property int $is_closed
 * @property string|null $last_seen
 * @property int $task_id
 * @property string|null $img_url
 * @method static \Illuminate\Database\Eloquent\Builder|FoundUser whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoundUser whereImgUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoundUser whereIsClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoundUser whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoundUser whereLastSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoundUser whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoundUser whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FoundUser whereVkId($value)
 * @property-read SearchTask $task
 * @mixin \Eloquent
 */
class FoundUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'vk_id',
        'task_id',
        'first_name',
        'last_name',
        'is_closed',
        'last_seen',
        'img_url'
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(SearchTask::class);
    }
}
