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
        "finished_at"
    ];

    protected $casts = [
        'delivery_date' => 'datetime',
        'finished_at' => 'datetime',
    ];

}
