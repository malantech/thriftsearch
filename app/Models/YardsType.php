<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YardsType extends Model
{
    protected $table = 'yards_types';

    public function yards(){
        return $this->belongsToMany( 'App\Models\Yard', 'saved_yards_types', 'yards_types_id', 'yard_id');
    }
}
