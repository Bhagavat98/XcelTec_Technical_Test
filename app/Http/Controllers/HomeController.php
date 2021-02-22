<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        Log::info("HomeController->index() ");

        // $users = User::
        // ->where('user_role_id','!=', '0')
        // ->get()->paginate(8);


        $users = DB::table('users')
        ->orderBy('id','desc')
        ->simplePaginate(10);


      //   $employees = Employee::paginate(8);
      // return view('home', compact('employees'));

        foreach ($users as $value) {
            
            if ($value->is_active == '1') {
                $value->is_active_string = 'Active';
                $value->is_active_lable = 'success';
            }elseif ($value->is_active == '0') {
                $value->is_active_string = 'InActive';
                $value->is_active_lable = 'danger';
            }elseif ($value->is_active == '2') {
                $value->is_active_string = 'Pending';
                $value->is_active_lable = 'warning';
            }else{
                $value->is_active_string = 'NA'; 
                $value->is_active_lable = 'info'; 
            }


            if ($value->user_role_id == '0') {
                $value->user_role_id_string = 'Admin';
            }elseif ($value->user_role_id == '1') {
                $value->user_role_id_string = 'User';
                
            }else{
                $value->user_role_id_string = 'NA'; 
            }
            
        }

        return view('/users',['users'=>$users]);

    }



    /********************************************************************/
    /*                      //  Add Users //                            */
    /********************************************************************/

    /**
     * Handles Add new users
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function store(Request $request)
    {        
        Log::info("HomeController->store() ");

        $validatedData = $request->validate([
            'firstname' => 'required|min:3|max:255',
            'lastname' => 'required|min:3|max:255',
            'phone_number' => 'required|digits:10|unique:users',
            'email' => 'required|email|unique:users',
            'dob' => 'required|date_format:Y-m-d',
            'password' => 'required|min:6|max:16',
            'confirm_password' => 'required|same:password',
        ]);


        $user = User::create([
            'user_role_id'=>'1',
            'firstname'=> $request->firstname,
            'lastname' => $request->lastname,
            'dob' => $request->dob, 
            'phone_number'=> $request->phone_number, 
            'email'=> $request->email, 
            'password'=> bcrypt($request->password),  
           // 'profile_image'=> 
           // 'email_verified_at', 
            'is_active'=>'1',
        ]);


        if ($user) {    
                    
            Log::info("**  User Created successfully user->id = $user->id");

            return redirect('home')->with('success',''.$request->firstname.' User Created successfully');

        }else{

            Log::error("** User Created failed **   ".PHP_EOL." ");

            return redirect('users.add')->with('error','Error in added user!');

        }

    }






    /********************************************************************/
    /*                      //  Add Users //                            */
    /********************************************************************/

    /**
     * Handles Add new users
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function edit(Request $request)
    {        
        Log::info("HomeController->store() ");

        $users = DB::table('users')
        ->where('user_role_id','!=', '0')
        ->first();

        return view('/edit-users',['users'=>$users]);

    }







    /********************************************************************/
    /*                      //  user save //                            */
    /********************************************************************/

    /**
     * Handles users save
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function save(Request $request)
    {        
        Log::info("HomeController->save() ");

        $validatedData = $request->validate([
            'id' => 'required',
            'firstname' => 'required|min:3|max:255',
            'lastname' => 'required|min:3|max:255',
            'phone_number' => 'required|digits:10|unique:users,phone_number,'.$request->id,
            'email' => 'required|email|unique:users,email,'.$request->id,
            'dob' => 'required|date_format:Y-m-d',
        ]);

        $user = DB::table('users')
        ->where('id',$request->id)
        ->update([
            'firstname'=> $request->firstname,
            'lastname' => $request->lastname,
            'dob' => $request->dob, 
            'phone_number'=> $request->phone_number, 
            'email'=> $request->email,
            'created_at'=>date('Y-m-d H:i:s'), 
        ]);


        if ($user) {    
                    
            Log::info("**  User Save successfully user->id = $request->id");

            return redirect('home')->with('success',''.$request->firstname.' Save User successfully');

        }else{

            Log::error("** User Save failed **   ".PHP_EOL." ");

            return back()->with('error','Error in Save user!');

        }

    }






    /********************************************************************/
    /*                      //  user delete //                            */
    /********************************************************************/
    /**
     * Handles users delte
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function delete(Request $request)
    {        
        Log::info("HomeController->delete() ");

        $validatedData = $request->validate([
            'id' => 'required',
        ]);

        $userDelete = DB::table('users')
        ->where('id',$request->id)
        ->delete();


        if ($userDelete) {    
                    
            Log::info("**  User Delete successfully user->id = $request->id");

            return redirect('home')->with('success',''.$request->firstname.' Delete User successfully');

        }else{

            Log::error("** User Delete failed **   ".PHP_EOL." ");

            return back()->with('error','Error in Delete user!');

        }

    }

    





}
