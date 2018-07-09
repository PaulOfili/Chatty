<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $tables = 'statuses';

    protected $fillable = [
        'body',

        //Second way works with this guy being active
        // 'parent_id',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function scopeNotReply($query) {
        return $query->whereNull('parent_id');
    }

    //This didnt work, maybe cos of latest version of laravel
    public function replies() {
        return $this->hasMany('App\Models\Status','parent_id');
    }
}
