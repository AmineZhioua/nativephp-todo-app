<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status'
    ];

    public function simpleUser() {
        return $this->belongsTo(SimpleUser::class);
    }
}
