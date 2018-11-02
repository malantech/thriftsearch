<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Yard;
use App\Models\YardsType;
use App\User;

use Request;
use Auth;
use DB;

use App\Http\Requests\StoreYardRequest;
use App\Utilities\GoogleMaps;

class YardsController extends Controller
{
    public function getYards(){
        $yards = Yard::with( 'savedYardsTypes' )->get();

        return response()->json( $yards );
    }

    public function getYard( $id ){
        //console.log( "ID:: " . $id );
        $yard = Yard::where( 'id', '=', $id )
            ->with( 'savedYardsTypes')
            ->with( 'userLike' )
            ->first();
        //console.log( $yard );

        return response()->json( $yard );
    }

    public function postNewYard( StoreYardRequest $request ){
        $coordinates = GoogleMaps::geocodeAddress( $request->get( 'address'), $request->get('city'), $request->get('state'), $request->get('zip') );

        $yard = new Yard();
        $yard->name         = $request->get('name' );
        $yard->address      = $request->get('address' );
        $yard->city         = $request->get('city' );
        $yard->state        = $request->get('state' );
        $yard->zip          = $request->get('zip' );
        $yard->description  = $request->get('description' );
        $yard->latitude     = $coordinates['lat'];
        $yard->longitude    = $coordinates['lng'];

        $yard->save();

        $yardsTypes = $request->get( 'yards_types' );
        $yard->savedYardsTypes()->sync( $yardsTypes );

        return response()->json( $yard, 201 );
    }

    public function getYardEditData(){

    }

    public function postLikeYard( $yardID ){
        $yard = Yard::where( 'id', '=', $yardID )->first();

        info("YardsController - YardID: " . $yardID . " AuthID: " . Auth::id());
        info("yard likes containers: " . $yard->likes->contains( 1 ));
        //info( "yard likes: " . $yard->likes . " auth id: " . Auth::user()->id );
        //info(" auth id: " . auth()->id());
        //info($yard->likes());

        if( !$yard->likes->contains( 1 ) ){
            $yard->likes()->attach( 1, [
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ]);

            return response()->json( ['yard_liked' => true ], 201 );
        }

    }

    public function deleteLikeYard( $yardID ){
        $yard = Yard::where( 'id', '=', $yardID )->first();

        $yard->likes()->detach( Auth::id() );

        return response( null, 204 );
    }
}