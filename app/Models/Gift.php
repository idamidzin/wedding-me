<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gift extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'amount',
        'payment_method',
        'for',
    ];
}
