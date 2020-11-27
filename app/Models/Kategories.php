<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategories extends Model
{
    use HasFactory;

    protected $table = 'kategorie'; // Definování, že tenhle kontroler bude pracovat s tabulkou v databázi pod tímto jménem
}
