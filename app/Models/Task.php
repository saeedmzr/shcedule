<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    use HasFactory;
    protected $guarded = [];
    public function user() {
        return $this->belongsTo(User::class);
    }

    // simple scope filter for filtering tasks by user_id
    public function scopeFilter($query) {

        $user_id = request('user_id');

        if (isset($user_id)) {

            $query->where('user_id', $user_id);
        }

        return $query;

    }

}
