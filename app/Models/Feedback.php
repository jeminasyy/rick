<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'ticket_id',
        'rating',
        'comments'
    ];

    // Filter

    // Relationship to Ticket
    public function ticket() {
        return $this->hasOne(Ticket::class, 'ticket_id');
    }

    // Relationship to Student
    public function student() {
        return $this->hasOne(Student::class, 'student_id');
    }
}
