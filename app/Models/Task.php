<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidModel;

class Task extends Model
{
    use HasFactory, SoftDeletes, UuidModel;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;


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
        'status',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checklists()
    {
        return $this->hasMany(Checklist::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    //nullable поля updated_at при создании чеклиста
    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->updated_at = null;
        });
    }
}
