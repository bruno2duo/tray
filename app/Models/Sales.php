<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Sellers;

class Sales extends Authenticatable
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'seller_id',
        'amount',
        'sale_date',
        'applied_commission',
        'total_commission'
    ];

    /**
     * Get the vendedor that owns the Venda.
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Sellers::class);
    }
}
