<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\UuidModel;

class Tick extends Model
{
    use HasFactory, SoftDeletes, UuidModel;
    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;


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
        'checklist_id',
        'status',
        'author_id'
    ];

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
    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }
}
