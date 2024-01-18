<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\Thread
 *
 * @property string $uuid
 * @property int $sender_id
 * @property int $receiver_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|Thread newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread query()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereReceiverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereUuid($value)
 * @mixin \Eloquent
 */
class Thread extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'created_at'
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($thread) {
            $thread->uuid = (string) Str::uuid();
        });
    }


    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
