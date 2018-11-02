<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getUser(){
        info("UsersController: User: " . Auth::guard('api')->user());
        return Auth::guard('api')->user();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers(){
        $query = Request::get('search');

        $users = User::where('name', 'LIKE', '%'.$query.'%')
            ->orWhere('email', 'LIKE', '%'.$query.'%')
            ->get();


        return response()->json( $users );
    }

    /**
     * @param EditUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function putUpdateUser( EditUserRequest $request ){
        $user = Auth::user();

        $favoriteCoffee       = $request->get('favorite_coffee');
        $flavorNotes          = $request->get('flavor_notes');
        $profileVisibility    = $request->get('profile_visibility');
        $city                 = $request->get('city');
        $state                = $request->get('state');

        /*
          Ensure the user has entered a favorite coffee
        */
        if( $favoriteCoffee != '' ){
            $user->favorite_coffee    = $favoriteCoffee;
        }

        /*
          Ensure the user has entered some flavor notes
        */
        if( $flavorNotes != '' ){
            $user->flavor_notes       = $flavorNotes;
        }

        /*
          Ensure the user has submitted a profile visibility update
        */
        if( $profileVisibility != '' ){
            $user->profile_visibility = $profileVisibility;
        }

        /*
          Ensure the user has entered something for city.
        */
        if( $city != '' ){
            $user->city   = $city;
        }

        /*
          Ensure the user has entered something for state
        */
        if( $state != '' ){
            $user->state  = $state;
        }

        $user->save();

        /*
                Return a response that the user was updated successfully.
            */
        return response()->json( ['user_updated' => true], 201 );
    }
}
