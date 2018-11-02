<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;

use App\User;

class AuthenticationController extends Controller
{
    /**
     * @param $account
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getSocialRedirect( $account ){
        try{
            //return Socialite::with( $account )->redirect();
            return Socialite::driver('facebook')->redirect();
        }catch ( \InvalidArgumentException $e ){
            return redirect('/login');
        }
    }

    /**
     * @param $account
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getSocialCallback( $account ){
        $socialUser = Socialite::with( $account )->user();

        $user = User::where( 'provider_id', '=', $socialUser->id )
            ->where( 'provider', '=', $account )
            ->first();

        //$user = Socialite::driver('facebook')->user();
        info("AuthenticationController: ");
        info("Account: " . $account);
        info("socialUserID: " . $socialUser->id);
        if($user){
            info("userID a: " . $user->id);
        }else{
            info("no $ user object");
        }

        if( $user == null ){
            $newUser = new User();

            $newUser->name            = $socialUser->getName();
            $newUser->email           = $socialUser->getEmail() == '' ? '' : $socialUser->getEmail();
            $newUser->avatar          = $socialUser->getAvatar();
            $newUser->password        = '';
            $newUser->provider        = $account;
            $newUser->provider_id     = $socialUser->getId();
            $newUser->city            = '';
            $newUser->state           = '';

            $newUser->save();

            $user = $newUser;

            //Auth::login( $user );
            info("newUserID: " . $newUser->id);
            Auth::loginUsingId($newUser->id);
            info("Auth::id(): " . Auth::id());

            return redirect('/#/home');
        }else{
            Auth::loginUsingId($user->id);
            info("userID b: " . $user->id);
            return redirect('/');
        }
    }
}
