<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

 
class ApiController extends Controller
{
    

    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|min:3|max:255',
            'lastname' => 'required|min:3|max:255',
            'phone_number' => 'required|digits:10|unique:users',
            'email' => 'required|email|unique:users',
            'dob' => 'required|date_format:Y-m-d',
            'password' => 'required|min:6|max:16',
            'confirm_password' => 'required|same:password',
        ]);

        Log::info("ApiController->register() 
            firstname = $request->firstname ".PHP_EOL."
            lastname = $request->lastname ".PHP_EOL."
            phone_number = $request->phone_number ".PHP_EOL."
            email = $request->email ".PHP_EOL."
            dob = $request->dob ".PHP_EOL."
            password = $request->password ".PHP_EOL."
            confirm_password = $request->confirm_password ".PHP_EOL." ");

        if ($validator->fails()) // if validation error true
        {   
            Log::error("ApiController->register() validator fails");
            return response()->json([
                'error'=>true,
                'message'=>$validator->errors()->all(),
                'status'=>422
            ],422);
        }
        
        try{
                $user = User::create([
                    'user_role_id'=>'1',
                    'firstname'=> $request->firstname,
                    'lastname' => $request->firstname,
                    'dob' => $request->dob, 
                    'phone_number'=> $request->phone_number, 
                    'email'=> $request->email, 
                    'password'=> bcrypt($request->password),  
                   // 'profile_image'=> 
                   // 'email_verified_at', 
                    'is_active'=>'1',
                ]);
            
                $token = $user->createToken('TutsForWeb')->accessToken;
        
                if ($user) {    
                    
                    Log::info("ApiController->register()  User Created successfully user->id = $user->id");

                    return response()->json([
                        'error' =>false,
                        'message'=>''.$request->firstname.' User Created successfully',
                        'status' => 200,
                        'token' => $token
                    ], 200);

                }else{

                    Log::error("** User Created failed **   ".PHP_EOL." ");

                    return response()->json([
                        'error' =>true,
                        'message'=>''.$request->name.' User Created failed',
                        'status' => 500,
                    ], 500);

                }
        

            } catch (\Exception $e) {

                Log::error("** something went wrong please try again - ".$e->getMessage()." **   ".PHP_EOL." ");

                return response()->json([
                    'error' =>false,
                    'message'=>$e->getMessage(),
                    'status' => 500,
                ], 500);
            }

        
    }
 
    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        Log::info("ApiController->login()  ".PHP_EOL."
            email=$request->email, ".PHP_EOL."
            password=$request->password ".PHP_EOL."
        ");

        if ($validator->fails()) // if validation error true
        {   
            Log::error("ApiController->login() validator fails");
            return response()->json([
                'error'=>true,
                'message'=>$validator->errors()->all(),
                'status'=>422], 422);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        
        try{
            if (auth()->attempt($credentials)) {

                $token = auth()->user()->createToken('TutsForWeb')->accessToken;

                Log::info("ApiController->login() Login successfully ".PHP_EOL." 
                    token=$token, ".PHP_EOL."
                    email=$request->email, ".PHP_EOL." 
                    password=$request->password ".PHP_EOL."
                ");

                return response()->json([
                    'error' =>false,
                    'message'=>'Login successfully',
                    'status' => 200,
                    'token' => $token,
                ], 200);

            }else{

                Log::error("ApiController->login() ".PHP_EOL."
                    email=$request->email, invalid credentials");

                return response()->json([
                    'error' =>true,
                    'message'=>''.$request->email.' invalid credentials',
                    'status' => 500,
                ], 500);
            }

        } catch (\Exception $e) {

            Log::error("** something went wrong please try again - ".$e->getMessage()." **   ".PHP_EOL." ");

            return response()->json([
                'error' =>false,
                'message'=>$e->getMessage(),
                'status' => 500,
            ], 500);
        }

    }





    /*******************************************************************
                //  logout //
    /*******************************************************************/



    /**
     * Handles  Logout Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {

        Log::info("ApiController->logout()  ".PHP_EOL."  ");

        $result = $request->user()->token()->revoke();  

        if($result){
            
            Log::info("ApiController->logout() token revoke  ".PHP_EOL."  ");

            return response()->json([
                'error' =>false,
                'message'=>'Logout successfully',
                'status' =>200,
            ], 200);


        }else{

            Log::error("ApiController->logout() Unable to Logout  ".PHP_EOL."  ");

            return response()->json([
                'error' =>true,
                'message'=>'Unable to Logout',
                'status' =>501,
            ], 501);

        }     
    
    }
    




}