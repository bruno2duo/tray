<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; 
use App\Models\Sales;

class Sellers extends Authenticatable
{
    use HasFactory;

    protected $table = 'sellers';

    protected $fillable = [
        'nome',
        'email'
    ];

    /**
     * Get all of the vendas for the Vendedor.
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
