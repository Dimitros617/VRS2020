<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    use HasFactory;
    use SoftDeletes;
    public bool $timestamps = true;
    protected $dates = ['created_at'];

}
