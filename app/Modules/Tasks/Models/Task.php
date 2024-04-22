<?php

namespace App\Modules\Tasks\Models;

use App\Modules\Tasks\Enums\TaskStatusEnum;
use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Task extends Model
{
    use HasFactory;

    public const CACHE_TOKEN_LIST_MINUTES = 10;
    public const CACHE_TOKEN_LIST = "task_list";

    protected $table = "tasks";

    protected $fillable = [
        'name',
        'description',
        "delivery_date",
        "finished",
        "finished_at",
        "status"
    ];

    protected $casts = [
        'delivery_date' => 'datetime',
        'finished_at' => 'datetime',
        'status' => TaskStatusEnum::class,
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_x_tasks');
    }

    protected static function booted(){
        static::creating(function () {
            Cache::forget(self::CACHE_TOKEN_LIST);
        });

        static::updating(function ($user) {
            Cache::forget(self::CACHE_TOKEN_LIST);
        });
    }

}
