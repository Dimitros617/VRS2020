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

//    protected $table = 'kategorie'; // Definování, že tenhle kontroler bude pracovat s tabulkou v databázi pod tímto jménem



}
