<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignupFields extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $fillable = [
        'label',
        'type',
        'data',
        'order',
        'isRequired',
        'isActive',
    ];

    protected $casts = [
        'data' => 'json'
    ];

    public function getJsonFieldsAttribute()
    {
        return (object) [
            'label' => $this->attributes['label'],
            'type' => $this->attributes['type'],
            'data' => $this->attributes['data'],
        ];
    }

    private function propIconLabel($attribute)
    {
        $classBadge = 'badge badge-pill badge-';
        $classIcon = 'fas fa-';

        return $attribute
            ? "<span class=\"" . $classBadge . "success\">
                    <i class=\"" . $classIcon . "check\"></i> " . __('Yes') . "
                </span>"
            : "<span class=\"" . $classBadge . "danger\">
                    <i class=\"" . $classIcon . "times\"></i> " . __('No') . "
                </span>";
    }

    public function getIsRequiredLabelAttribute()
    {
        return $this->propIconLabel($this->attributes['isRequired']);
    }

    public function getIsActiveLabelAttribute()
    {
        return $this->propIconLabel($this->attributes['isActive']);
    }
}