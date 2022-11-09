<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reopen extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'reason',
        'response',
        'dateReopened',
        'dateResponded',
        'dateResolved'
    ];

    // Relationshipt to Reopen Rating
    public function reopenrating() {
        return $this->hasOne(Reopenrating::class, 'reopen_id');
    }

    // Relationship to Ticket
    public function ticket() {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    // Relationship to User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
