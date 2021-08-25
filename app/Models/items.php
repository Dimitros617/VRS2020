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


    public function loans()
    {
        return $this->hasMany(loans::class, 'item');
    }

    public function historyEvidences()
    {
        return $this->hasMany(loans_histories::class, 'itemId');
    }
}
