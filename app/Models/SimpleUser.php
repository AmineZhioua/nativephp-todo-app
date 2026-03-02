<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimpleUser extends Model
{
    protected $fillable = [
        "username"
    ];

    public function todo() {
        return $this->hasMany(Todo::class);
    }
}
