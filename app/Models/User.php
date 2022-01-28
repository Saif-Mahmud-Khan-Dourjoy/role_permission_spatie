<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getAllGroupName(){
        $grp_name=DB::table('permissions')->select('group_name')->groupBy('group_name')->get();

        return $grp_name;
    }

     public static function getAllPermissionByGroupName($grp_name){
        $permission=DB::table('permissions')->where('group_name',$grp_name)->get();

        return $permission;
    }

    public static function roleHasPermissions($role,$permission){
        $hasPermission=true;
        foreach ($permission as $key => $permission) {
            if(!$role->hasPermissionTo($permission->name)){
                $hasPermission=false;

                return $hasPermission;
            }
        }

        return $hasPermission;
    }

    public static function roleHasAllPermissions($role,$permissions){
        $hasAllPermission=true;
        foreach ($permissions as $key => $permissions) {
            if(!$role->hasPermissionTo($permissions->name)){
                $hasAllPermission=false;

                return $hasAllPermission;
            }
        }

        return $hasAllPermission;
    }
}
