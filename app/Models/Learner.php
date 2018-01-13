<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Learner extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;

    protected $fillable = [
        'department_id',
        'name',
        'phone',
        'image',
        'name_on_card',
        'card_number',
        'expiry_date'
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

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function assessments()
    {
        return $this->hasMany('App\Models\Assessment');
    }
    public function ticket()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function awards(){
       return $this->hasMany('App\Models\Award');
    }

    public function scopeArchived($query)
    {
        return $query->whereNotNull('learners.deleted_at');
    }

    public function scopeActive($query)
    {
        return $query->whereNull('learners.deleted_at');
    }
}
