<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Department extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;

    protected $fillable = [
        'organization_id',
        'name',
    ];

    public static $rules = [
        'create' => [
            'organization_id',
            'name' => 'required'
        ],
        'update' => [
            'name' => 'required'
        ]
    ];

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization')->withTrashed();
    }

    public function learners()
    {
        return $this->hasMany('App\Models\Learner')->withTrashed();
    }

}
