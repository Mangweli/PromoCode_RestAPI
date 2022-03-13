<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\V1\BaseController as BaseController;
use Carbon\Carbon;

class AuthController extends BaseController
{

    public function generateToken(Request $request)
    {
       // try{
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $auth                  = Auth::user();
                $success['token']      = $auth->createToken('LaravelSanctumAuth')->plainTextToken;
                $success['created_at'] = Carbon::now();

                return $this->handleResponse($success, 'Processed. This token will expire in 10 mins');
            }
            else{
                return $this->handleError('Unauthorised.', ['error'=>'Unauthorised']);
            }
        // }
        // catch (\Throwable $th) {
        //     return $this->handleError('Error.', ['error'=>'Unable to process your request']);
        // }
    }

}
