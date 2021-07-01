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
class LoginController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
	public function login(Request $request)
    {
		$userEmail=$request->email;
        $user = User::where('email', $userEmail)->first();
		
        if($user != ""){
        $success['loginStatus']=1;
        $success['status']=true;
        $success['message']="Logged successfully.";
        $success['name'] =  $user->name;
        $success['email'] =  $user->email;
        $success['auth'] =  "Bearer ".$user->createToken('MyApp')->accessToken;

        return $this->sendResponse($success, 'Logged successfully.');
         }
        else {
            $response = [
                'loginStatus' => 0,
                'status' => false,
                "message" => "Invalid Login."];
            return response($response, 200);
        }
    }  
}