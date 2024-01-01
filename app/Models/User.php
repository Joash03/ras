<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
     * @var array<int, string>
     */
    protected $guarded = [];

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
        'password' => 'hashed',
    ];

    public static function getpermissionGroups()
    {
        $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_groups;
    } // End Method

    public static function getpermissionByGroupName($group_name)
    {
        $permissions = DB::table('permissions')->select('name','id')->where('group_name',$group_name)->get();
          return $permissions;
    }// End Method

    public static function roleHasPermissions($role, $permissions)
    {
        $hasPermission = true;
        foreach($permissions as $permission){
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }
            return $hasPermission;
        }

    }// End Method


    public function employee()
    {
        return $this->hasOne(Employee::class)->where(function ($query) {
            $query->where('role', 'employee')->orWhere('role', 'admin');
        });
    }

    public function advancesalary()
    {
        if ($this->role === 'employee') {
            return $this->hasOne(AdvanceSalary::class);
        }
        return null; // Return null for users with roles other than "employee"
    }

    public function paysalary()
    {
        if ($this->role === 'employee') {
            return $this->hasOne(PaySalary::class);
        }
        return null; // Return null for users with roles other than "employee"
    }

    public function attendace()
    {
        if ($this->role === 'employee') {
            return $this->hasOne(Attendance::class);
        }
        return null; // Return null for users with roles other than "employee"
    }

    public function blog()
    {
        if ($this->role === 'employee') {
            return $this->hasOne(Blog::class);
        }
        return null; // Return null for users with roles other than "admin"
    }

    public function webcart()
    {
        return $this->hasOne(WebCart::class, 'user_id', 'id');
    }


}
