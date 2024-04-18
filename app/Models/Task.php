<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

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
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_x_tasks');
    }
}
