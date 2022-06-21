<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\UuidModel;

class Checklist extends Model
{
    use HasFactory, SoftDeletes, UuidModel;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;
    
    //nullable поля updated_at при создании чеклиста
    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->updated_at = null;
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */
    protected $fillable = [
        'name',
        'text',
        'author_id',
        'task_id',
    ];

    public function ticks()
    {
        return $this->hasMany(Tick::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
