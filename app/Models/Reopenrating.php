<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reopenrating extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'reopen_id',
        'rating',
        'comments'
    ];

    // Relationship to Reopen
    public function reopen() {
        return $this->belongsTo(Reopen::class, 'reopen_id');
    }

    // Relationship to Student
    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
