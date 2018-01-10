<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use softDeletes;

    protected $table = 'quiz';

    protected $fillable = [
        'learner_id',
        'learning_id',
        'result',
        'is_completed',
    ];

    public $rules = [];

    public function learning()
    {
        return $this->belongsTo('App\Models\Learning');
    }

    public function learner()
    {
        return $this->belongsTo('App\Models\Learner');
    }
}