<?php

namespace App\Http\Controllers\Api;

use App\Core\Interfaces\UserInterface;

use JWTAuth;
use App\Core\Helpers\__cache;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class ApiAuthController extends Controller{
   

    use AuthenticatesUsers;

    protected $user_repo;
    protected $__cache;

    protected $redirectTo = 'dashboard/home';
    protected $maxAttempts = 4;
    protected $decayMinutes = 2;





    public function __construct(UserInterface $user_repo, __cache $__cache){

        $this->user_repo = $user_repo;
        $this->__cache = $__cache;
        parent::__construct();

    }



    
    public function username(){

        return 'username';    
        
    }




    protected function login(Request $request){

        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if($this->auth->guard()->attempt($this->credentials($request))){

            if($this->auth->user()->is_active == false){

                $this->session->flush();
                $this->auth->logout();

            }else{

                $user = $this->user_repo->login($this->auth->user()->slug);
                $token = JWTAuth::attempt($this->credentials($request));

                $this->__cache->deletePattern(''. config('app.name') .'_cache:users:fetch:*');
                $this->__cache->deletePattern(''. config('app.name') .'_cache:users:findBySlug:'. $user->slug .'');
                $this->__cache->deletePattern(''. config('app.name') .'_cache:users:getByIsOnline:'. $user->is_online .'');

                $this->clearLoginAttempts($request);
                return response()->json(['token' => $token]);

            }
        
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);

    }




    public function logout(Request $request){

        if($request->isMethod('post')){

            if(isset($request->access_token)){

                $user = $this->user_repo->logout($this->auth->user()->slug);

                JWTAuth::setToken($request->access_token);
                JWTAuth::invalidate();

                $this->session->flush();
                $this->auth->guard()->logout();
                $request->session()->invalidate();

                $this->__cache->deletePattern(''. config('app.name') .'_cache:users:fetch:*');
                $this->__cache->deletePattern(''. config('app.name') .'_cache:users:findBySlug:'. $user->slug .'');
                $this->__cache->deletePattern(''. config('app.name') .'_cache:users:getByIsOnline:'. $user->is_online .'');
    
                $this->session->flash('LOGOUT_SUCCESS','You have been logged out successfully!');
    
                return redirect('/');

            }

        }
        
        return abort(404);

    }




}
