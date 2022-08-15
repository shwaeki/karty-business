<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{


    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected $providers = [
       'facebook','google','twitter',
    ];


    public function showLoginForm()
    {
        return view('auth.login', ['cities' => City::all()]);
    }

    public function redirectToProvider($driver)
    {
        if( ! $this->isProviderAllowed($driver) ) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }


    public function handleProviderCallback( $driver )
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        return empty( $user->email )
            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver);
    }

    protected function sendSuccessResponse()
    {
        return  redirect()->intended($this->redirectPath());
    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('login')
            ->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }

    protected function loginOrCreateAccount($providerUser, $driver)
    {
        $user = User::where('email', $providerUser->getEmail())->first();

        if( $user ) {
            $user->update([
                'provider' => $driver,
                'name' => $providerUser->getName(),
                'provider_id' => $providerUser->id,
            ]);
        } else {
            $user = User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'email_verified_at' =>  now(),
                'provider' => $driver,
                'provider_id' => $providerUser->getId(),
                'password' => ''
            ]);
        }
        // login the user
        Auth::login($user, true);

        return $this->sendSuccessResponse();
    }

    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }


}
