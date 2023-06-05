<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\SearchTask
 *
 * @property int $id
 * @property int|null $age_from
 * @property int|null $age_to
 * @property int|null $birth_day
 * @property int|null $birth_month
 * @property string|null $birth_year
 * @property int|null $city
 * @property int|null $university
 * @property string|null $university_year
 * @property int|null $university_faculty
 * @property int|null $university_chair
 * @property int|null $sex
 * @property int|null $status
 * @property int|null $has_photo
 * @property string|null $company
 * @property string|null $position
 * @property string|null $group_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|SearchTask newModelQuery()
 * @method static Builder|SearchTask newQuery()
 * @method static Builder|SearchTask query()
 * @method static Builder|SearchTask whereAgeFrom($value)
 * @method static Builder|SearchTask whereAgeTo($value)
 * @method static Builder|SearchTask whereBirthDay($value)
 * @method static Builder|SearchTask whereBirthMonth($value)
 * @method static Builder|SearchTask whereBirthYear($value)
 * @method static Builder|SearchTask whereCity($value)
 * @method static Builder|SearchTask whereCompany($value)
 * @method static Builder|SearchTask whereCreatedAt($value)
 * @method static Builder|SearchTask whereGroupId($value)
 * @method static Builder|SearchTask whereHasPhoto($value)
 * @method static Builder|SearchTask whereId($value)
 * @method static Builder|SearchTask wherePosition($value)
 * @method static Builder|SearchTask whereSex($value)
 * @method static Builder|SearchTask whereStatus($value)
 * @method static Builder|SearchTask whereUniversity($value)
 * @method static Builder|SearchTask whereUniversityChair($value)
 * @method static Builder|SearchTask whereUniversityFaculty($value)
 * @method static Builder|SearchTask whereUniversityYear($value)
 * @method static Builder|SearchTask whereUpdatedAt($value)
 * @property string $task_status
 * @property int $user_id
 * @property array $keywords
 * @property-read SearchTask $user
 * @method static Builder|SearchTask whereKeywords($value)
 * @method static Builder|SearchTask whereTaskStatus($value)
 * @method static Builder|SearchTask whereUserId($value)
 * @property string $title
 * @method static Builder|SearchTask whereTitle($value)
 * @property string $uuid
 * @method static Builder|SearchTask whereUuid($value)
 * @mixin Eloquent
 */
class SearchTask extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'keywords' => 'array',
    ];

    protected array $queryParams = [
        'age_from',
        'age_to',
        'birth_day',
        'birth_month',
        'birth_year',
        'city',
        'university',
        'university_year',
        'university_faculty',
        'university_chair',
        'sex',
        'status',
        'has_photo',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUrlParams(): array
    {
        return collect($this->getAttributes())
            ->only($this->queryParams)
            ->filter()
            ->toArray();
    }

    public function foundUsers(): HasMany
    {
        return $this->hasMany(FoundUser::class, 'task_id');
    }
}
