<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\YardsType;

class YardsTypesController extends Controller
{
    public function getYardsTypes(){
        $yardsTypes = YardsType::withCount( 'yards' )->get();

        return response()->json( $yardsTypes );
    }
}
