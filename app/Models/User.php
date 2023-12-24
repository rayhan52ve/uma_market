<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const USER = 1;
    const SERVICE_PROVIDER = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'username',
        'created_by',
        'email',
        'mobile',
        'link_token',
        'mobile_otp_expire_at',
        'mobile_verified_at',
        'verification_code',
        'password',
        'employee_role',
        'user_type',
        'status',
        'district_id',
        'division_id',
        'upazila_id',
        'union_id',
        'has_agent_id',
        'has_agent_name',
        'slug',
        'referral',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends= ['full_name'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'address' => 'object',
        'social' => 'object'
    ];

    public function scopeUser($query)
    {
        return $query->where('user_type',self::USER);
    }
    public function scopeServiceProvider($query)
    {
        return $query->where('user_type',self::SERVICE_PROVIDER);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function getFullNameAttribute()
    {
        return $this->fname.' '. $this->lname;
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function biddings()
    {
        return $this->hasMany(Bidding::class,'provider_id')->where('status',1);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function userDetails()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class,'division_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class,'upazila_id');
    }

    public function union()
    {
        return $this->belongsTo(Union::class,'union_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function scopeAgent($query)
    {
        return $query->where('user_type', 4);
    }

    public function scopeEmployee($query)
    {
        return $query->where('user_type', 3);
    }

    public function scopeCustomer($query)
    {
        return $query->where('user_type', 1);
    }

    public function scopeVendor($query)
    {
        return $query->where('user_type', 2);
    }

    public function scopeCreatedBy($query)
    {
        return $query->where('created_by',Auth::user()->id);
    }

}
