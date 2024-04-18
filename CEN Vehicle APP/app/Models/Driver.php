<?php

namespace App\Models;

use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

class Driver extends Authenticatable implements JWTSubject, Scope, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'createdby',
        'password',
        'email_verified_at',
        'remember_token',
        'vehicle_1',
        'vehicle_2',
        'vehicle_3',
        'phone',
        'type',
        'is_active',
        'user_password'
    ];
    public function templates()
    {
        return $this->hasMany('App\Template');
    }

    public function user_template()
    {
        return $this->hasMany('App\UserTemplate');
    }

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function toArray()
    {
        return [
            'email' => $this->email
        ];
    }
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('type', 'DRIVER');
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // public function handle(Registered $event)
    // {
    //     if ($event->user instanceof MustVerifyEmail && ! $event->user->hasVerifiedEmail()) {
    //         $event->user->sendEmailVerificationNotification();
    //     }
    // }

}
