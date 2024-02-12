<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function user() : BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
    public function donatur() : BelongsTo
    {
        return $this->belongsTo('App\Models\Donatur');
    }

}
