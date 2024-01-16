<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserCategory
 *
 * @property int $user_id
 * @property int $category_id
 * @method static \Illuminate\Database\Eloquent\Builder|UserCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCategory whereUserId($value)
 * @mixin \Eloquent
 */
class UserCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'category_id'
    ];
}
