<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'email',
        'FName',
        'LName',
        'studNumber',
        'tickets',
        'ongoingTickets',
        'code',
    ];

    protected $hidden = [
        'id',
        'code'
    ];

    public static function generateStudentid(int $length = 9): string {
        $student_id = Str::random($length);//Generate random string
        $exists = DB::table('students')
            ->where('id', '=', $student_id)
            ->get(['id']);//Find matches for id = generated id
        if (isset($exists[0]->id)) {//id exists in users table
            return self::generateStudentid();//Retry with another generated id
        }
        return $student_id;//Return the generated id as it does not exist in the DB
    }

    // Relationship with Ticekts
    public function tickets() {
        return $this->hasMany(Ticket::class, 'student_id');
    }

    // Relationship with Ratings
    public function rating() {
        return $this->hasMany(Rating::class, 'student_id');
    }

    // Relationship with Reopenratings
    public function reopenrating() {
        return $this->hasMany(Reopenrating::class, 'student_id');
    }
}
