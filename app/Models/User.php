<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function getRole()
    {
        return $this->belongsto(Role::class,'role_id','id');
    }

    protected $appends = ['secret'];

    public function getSecretAttribute()
    {
        $encrypted_string=openssl_encrypt($this->id,config('services.encryption.type'),config('services.encryption.secret'));
        return base64_encode($encrypted_string);
    }

    public static function isAuthorized($module_name, $submodule_name = null)
    {
        $auth_user = User::where('id',Auth::user()->id)->first();
        $authorized = false;
        if(isset($auth_user) && $auth_user->hasPermissionTo(get_permission_name($module_name,$submodule_name)))
        {
            $authorized = true;
        }
        // access enabled for super admin(4)
        if(isset($auth_user) && $auth_user->role_id == 4)
        {
            $authorized = true;
        }
        return $authorized;
    }

}
