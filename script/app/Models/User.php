<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use DB;
use Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'avatar',
        'username',
        'phone',
        'email',
        'currency_id',
        'role',
        'wallet',
        'status',
        'meta',
        'public_key',
        'secret_key',
        'qr',
        'password',
        'ip_address',
        'last_login_at',
        'kyc_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'kyc_verified_at' => 'datetime',
        'meta' => 'json'
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function banks(): HasMany
    {
        return $this->hasMany(UserBank::class);
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function kycMethods(): BelongsToMany
    {
        return $this->belongsToMany(KycMethod::class)->withPivot('kyc_request_id');
    }

    public function getCountryAttribute()
    {
        return $this->currency->country_name ?? null;
    }

    public function getAttribute($key): mixed
    {
        $attribute = parent::getAttribute($key);

        if ($attribute === null && array_key_exists($key, $this->meta ?? [])) {
            return $this->meta[$key];
        }

        return $attribute;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $user){
            $user->public_key = "PUBLIC-". Str::random(32);
            $user->secret_key = "SECRET-". Str::random(32);
            $user->qr = Str::random(32);
        });
    }
}
