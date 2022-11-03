<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submission extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'email',
        'tickets',
        'code',
        // 'requestFor'
    ];

    protected $hidden = [
        'id',
        'code'
    ];

    public static function generateUserid(int $length = 9): string {
        $submission_id = Str::random($length);//Generate random string
        $exists = DB::table('submissions')
            ->where('id', '=', $submission_id)
            ->get(['id']);//Find matches for id = generated id
        if (isset($exists[0]->id)) {//id exists in users table
            return self::generateUserid();//Retry with another generated id
        }
        return $submission_id;//Return the generated id as it does not exist in the DB
    }
}
