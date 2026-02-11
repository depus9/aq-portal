<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Address;
use App\Models\Shop\Payment;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Routing\UrlRoutable;

class Customer extends Authenticatable implements FilamentUser
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Handles automatic hashing during registration
    ];

    // Required by FilamentUser interface
    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'customer';
    }
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}
