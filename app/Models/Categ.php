<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categ extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description'
    ];

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('id', 'like', '%' . request('search') . '%')
                ->orWhere('name', 'like', '%' . request('search') . '%')
                ->orWhere('type', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship with Tickets
    public function tickets() {
        return $this->hasMany(Ticket::class, 'categ_id');
    }

    // Relationship with Users
    public function users() {
        return $this->hasManyThrough(User::class, 'categ_id');
    }

    // Relationship to Usercategs
    public function usercategs() {
        return $this->hasMany(Usercateg::class, 'usercateg_id');
    }
}
