<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'categ_id',
        'user_id',
        'student_id',
        'assignee',
        'description',
        'year',
        'department',
        'status',
        'response',
        'timesReopened',
        'dateResponded',
        'dateResolved',
        'priority'
    ];

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('id', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('department', 'like', '%' . request('search') . '%')
                ->orWhere('status', 'like', '%' . request('search') . '%')
                ->orWhere('response', 'like', '%' . request('search') . '%')
                ->orWhere('created_at', 'like', '%' . request('search') . '%')
                ->orWhere('student_id', 'like', '%' . request('search') . '%')
                ->orWhere('priority', 'like', '%' . request('search') . '%');
        }
        
        if($filters['categ_id'] ?? false) {
            $query->where('categ_id', 'like', '%' . request('categ_id') . '%');
        }

        if($filters['priority'] ?? false) {
            $query->where('priority', 'like', '%' . request('priority') . '%');
        }

        if($filters['status'] ?? false) {
            $query->where('status', 'like', '%' . request('status') . '%');
        }

        if($filters['user_id'] ?? false) {
            $query->where('user_id', 'like', '%' . request('user_id') . '%');
        }
    }

    // Relationship to User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to Category
    public function categ() {
        return $this->belongsTo(Categ::class, 'categ_id');
    }

    // Relationship to Student
    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Relationship to Rating
    public function rating(){
        return $this->hasOne(Rating::class, 'ticket_id');
    }

    // Relationship to Reopen
    public function reopens() {
        return $this->hasMany(Reopen::class, 'ticket_id');
    }
}
