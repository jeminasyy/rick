<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usercateg extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'categ_id'
    ];

    // Relationship to User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to Categ
    public function categ() {
        return $this->belongsTo(Categ::class, 'categ_id');
    }
}
