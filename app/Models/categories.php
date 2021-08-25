<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\This;

class categories extends Model
{
    use HasFactory;
    public bool $timestamps = false;
    protected $table = "categories";
    
    public function department()
    {
        return $this->belongsTo(department::class, 'id');
    }

    public function items()
    {
        return $this->hasMany(items::class, 'categories');
    }
    
}
