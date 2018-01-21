<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketAssignment extends Model
{
    //protected $table = 'ticket_assignments';

    protected $fillable = [
        'ticket_id',
        'target_date',
        'note'
    ];

    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket')->withTrashed();
    }
}
