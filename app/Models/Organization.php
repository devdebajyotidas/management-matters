<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Organization extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'contact_person',
        'name_on_card',
        'card_number',
        'expiry_date',
        'cvv'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static $rules = [
        'create' => [
            'name' => 'required'
        ],
        'update' => [
        ]
    ];

    public function user()
    {
        return $this->morphOne('App\Models\User','account');
    }

    public function subscription()
    {
        return $this->morphOne('App\Models\Subscription','account');
    }

    public function departments()
    {
        return $this->hasMany('App\Models\Department');
    }

    public function learners()
    {
        return $this->hasManyThrough('App\Models\Learner', 'App\Models\Department');
    }

}
