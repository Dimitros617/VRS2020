<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class department extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'departments';

    public function categories()
    {
        return $this->hasMany(categories::class);
    }
}
