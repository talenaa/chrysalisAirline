<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Airplane extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "places"
    ];
    
    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class);
    }
}
