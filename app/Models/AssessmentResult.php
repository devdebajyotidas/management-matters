<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentResult extends Model
{
    protected $fillable = [
        'statement_id',
        'name',
        'email',
        'result',
        'is_self'
    ];

    public function statement(){
        return $this->belongsTo(AssessmentStatement::class, 'statement_id', 'id');
    }
}
