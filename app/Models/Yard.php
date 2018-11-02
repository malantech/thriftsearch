<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Yard extends Model
{
    protected $table = 'yards';

    public function savedYardsTypes(){
        return $this->belongsToMany( 'App\Models\YardsType', 'saved_yards_types', 'yard_id','yards_types_id' );
    }

    public function likes(){
        return $this->belongsToMany( 'App\User', 'users_yards_likes', 'yard_id','user_id');
    }

    public function userLike(){
        return $this->belongsToMany( 'App\User', 'users_yards_likes', 'yard_id', 'user_id')->where( 'user_id', auth()->id() );
    }

    public function tags(){
        return $this->belongsToMany( 'App\User', 'yards_users_tags', 'yard_id', 'tag_id');
    }
}
