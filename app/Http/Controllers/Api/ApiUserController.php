<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\Controller;
use App\Core\Interfaces\UserInterface;
use JWTAuth;

class ApiUserController extends Controller{



	protected $user_repo;



	public function __construct(UserInterface $user_repo){
		$this->user_repo = $user_repo;
	}



	public function getUserBearerToken(){

		JWTAuth::fromUser(auth()->user());

    }



    
}
