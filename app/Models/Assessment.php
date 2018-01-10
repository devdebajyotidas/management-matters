<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Assessment extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;

    protected $fillable = [
        'learner_id',
        'scores'
    ];

    protected $casts = [
        'scores' => 'array'
    ];

    public function learner(){
        return $this->belongsTo('App\Models\Learner');
    }
}
