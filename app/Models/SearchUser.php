<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * App\Models\SearchUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SearchUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchUser query()
 * @mixin \Eloquent
 */
class SearchUser extends Model
{
    use Searchable;
    use HasFactory;
}
