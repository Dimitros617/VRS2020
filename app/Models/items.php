<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class items extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "items";
    public bool $timestamps = true;
    protected $dates = ['created_at'];

}
