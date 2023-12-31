<?php

namespace App\Models;

use App\Models\Traits\HasConfirmationTokens;
use App\Models\Traits\HasSubscriptions;
use App\Models\Traits\HasTwoFactorAuthentication;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Billable, Notifiable, HasConfirmationTokens, HasSubscriptions, HasTwoFactorAuthentication, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
        'activated',
        'setup',
        'provider',
        'provider_id',
        'application_id',
        'phone',
        'address',
        'company_name',
        'country',
        'city',
        'state',
        'payment_type',
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

    public function hasNotActivated()
    {
        return !$this->hasActivated();
    }

    public function hasActivated()
    {
        return $this->activated;
    }

    public function getPlanAttribute()
    {
        return $this->plan();
    }

    public function plan()
    {
        return $this->plans->first();
    }

    public function website()
    {
        return $this->hasOne(Website::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function plans()
    {
        $secondaryKey = 'stripe_plan';
        return $this->hasManyThrough(
            Plan::class, Subscription::class, 'user_id', 'gateway_id', 'id', $secondaryKey
        )->orderBy('subscriptions.created_at', 'desc');
    }
}