<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'phone', 'email', 'password', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) \Webpatser\Uuid\Uuid::generate(config('vars.uuid_version'));
        });
    }

    /**
     *  Create new resource
     */
    public static function store($inputs)
    {
        return self::create($inputs);
    }

    /**
     *  Update existing resource
     */
    public static function edit($inputs, $resource)
    {
        return self::where('id', $resource)->update($inputs);
    }

    /**
     *  Delete existing resource
     */
    public static function remove($resource)
    {
        return self::where('id', $resource)->delete();
    }

    /**
     *  Get a specific resource
     */
    public static function getBy($by, $resource)
    {
        return self::where($by, $resource)->first();
    }

    /**
     *  Relationship with users
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');

    }

    /**
     *  Relationship with users
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');

    }

    /**
     *  Relationship with roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /**
     *  User authorities
     */
    public static function authorities($user)
    {
        if(session()->has('permissions')){
            $return = session('permissions')[0];
        }else{
            $roles = $user->roles;
            $permissions = [];
            foreach ($roles as $role){
                foreach ($role->permissions as $permission){
                    $element = PermissionGroup::getBy('id', $permission->pivot->permission_group_id)->name . '.' . $permission->name;
                    if (!in_array($element, $permissions)){
                        $permissions[] = $element;
                    }
                }
            }
            session()->push('permissions', $permissions);
            $return = $permissions;
        }

        return $return;
    }

    /**
     *  User authorities
     */
    public static function hasAuthority($authority)
    {
        $status = false;
        if (in_array($authority, User::authorities(auth()->user()))){
            $status = true;
        }
        if (in_array(auth()->user()->id, config('vars.authorized_users'))){
            $status = true;
        }
        return $status;
    }
}
