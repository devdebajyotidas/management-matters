<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Ticket extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;

    protected $fillable = [
        'learner_id',
        'learning_id',
        'title',
        'impact_level',
        'is_archived'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $rules = [
        'create' => [
            'learner_id' => 'required',
            'learning_id' => 'required',
            'title' => 'required',
            'impact_level' => 'required',
        ],
        'update' => [
        ]
    ];

    public function learner()
    {
        return $this->belongsTo('App\Models\Learner')->withTrashed();
    }

    public function learning()
    {
        return $this->belongsTo('App\Models\Learning');
    }

    public function assignments()
    {
        return $this->hasMany('App\Models\TicketAssignment');
    }
}
