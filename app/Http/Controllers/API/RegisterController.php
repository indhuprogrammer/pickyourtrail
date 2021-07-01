<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $userEmail = User::where('email', $request->email)->where('users_active', '1')->first();
        if($userEmail != ""){
              $response = [
                'status' => false,
                'message' => "Already Registered Email."
                ];
            return response($response, 200);
          }else{
       
        $createUser = User::create([
        'name' => $request->name,
        'email' => $request->email,
		'password' => $request->email,
        'users_active' => '1',
        ]);
        }
        
        $success['status']=true;
        $success['message']="Registered successfully.";
        $success['name'] =  $createUser->name;
        $success['auth'] =  "Bearer ".$createUser->createToken('MyApp')->accessToken;

        return $this->sendResponse($success, 'Registered successfully.');
          
    } 

}