<?php

namespace Auth\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Partner\Models\Client;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'login',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that are ignored
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * Set the user's Password.
     *
     * @param string $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Get the user's Name
     * 
     * @param string $value
     */
    public function getNameAttribute($name) {
        return ucwords($name);
    }

    /**
     * Set the user's Name and Slug
     */
    public function setNameAttribute($name) {
        $this->attributes['name'] = strtoLower(trim($name));
        $this->attributes['slug'] = str_replace('.','',str_replace(' ','-',strtoLower(trim($name))));
    }

    /**
     * Get client on the system.
     *
     * @return  BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get JWT identifier.
     *
     * @return array
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get JWT custom claims.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
