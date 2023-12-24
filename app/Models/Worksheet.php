<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model
{
    use HasFactory;
    protected $fillable = [
         // Add any other fields you want to allow for mass assignment here
        // ...
        'employee_id',
        'daily_target',
        'target_achive',
        'target_extra_achive',
        'target_non_achive',
        'total_final_achive',
        'final_non_achive',
        'bonus_point',
    ];
    public function getExtraTargetAttribute()
    {
        // Calculate the extra target by subtracting daily_target from target_achive
        return $this->target_achive - $this->daily_target;
    }

    public function user(){
        return $this->belongsTo(User::class,'employee_id');
    }

    public function scopeTeamLeader($query)
    {
        return $query->where('employee_role','Team Leader');
    }

    public function scopeZoneManager($query)
    {
        return $query->where('employee_role','Zone Manager');
    }

    public function scopeBrandPromoter($query)
    {
        return $query->where('employee_role','Brand Promoter');
    }

}
