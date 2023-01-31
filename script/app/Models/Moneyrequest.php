<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Moneyrequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'amount',
        'charge',
        'status',
        'sender_id',
        'receiver_id',
        'request_currency_id',
        'approved_currency_id',
    ];

    private function paymentStatus($status)
    {
        $classBadge = 'badge badge-pill badge-';
        $classIcon = 'fas fa-';

        return [
            '0' => "<span class=\"" . $classBadge . "danger\">
                    <i class=\"" . $classIcon . "spinner\"></i> " . __('Rejected') . "
                </span>",
            '1' => "<span class=\"" . $classBadge . "success\">
                    <i class=\"" . $classIcon . "spinner\"></i> " . __('Completed') . "
                </span>",
            '2' => "<span class=\"" . $classBadge . "info\">
                    <i class=\"" . $classIcon . "check\"></i> " . __('Pending') . "
                </span>"
        ][$status];
    }

    public function getPaymentStatusAttribute()
    {
        return $this->paymentStatus($this->attributes['status']);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    public function sender_currency()
    {
        return $this->belongsTo(Currency::class, 'request_currency_id');
    }
}
