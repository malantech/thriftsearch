<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function yards(){
        return $this->belongsToMany( 'App\Models\Yards', 'yards_users_tags', 'tag_id', 'user_id');
    }
}
