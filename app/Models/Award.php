<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable=[
        'learner_id',
        'title',
        'description',
        'type'
    ];

    public function learner(){
        return $this->belongsTo('App\Models\Learner')->withTrashed();
    }
}
