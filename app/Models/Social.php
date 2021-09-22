<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lookup_provider_id',
        'name',
        'link',
        'is_active',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        '',
    ];

    /*
     * Change Route Key Name
     * */
    public function getRouteKeyName()
    {
        return 'uuid';
    }


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
     *  Get One Resource By
     */
    public static function getOneBy($field, $value)
    {
        return self::where($field, $value)->first();
    }

    /**
     *  Get All Resource By
     */
    public static function getAllBy($field, $value)
    {
        return self::where($field, $value)->get();
    }

    /**
     *  Created By Relation
     */
    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     *  Updated By Relation
     */
    public function updated_by_user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     *  Lookup provider Relation
     */
    public function provider()
    {
        return $this->belongsTo(Lookup::class, 'lookup_provider_id', 'id');
    }
}
