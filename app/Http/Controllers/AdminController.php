<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateProfileRequest;
use App\Mail\SignUp;
use App\Models\ActivityLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    public function loginView()

    {
        return view('login');
    }

    public function postLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password'=> 'required|min:7',

        ]);

        try {
            $remember = $request['remember
            '];
            if (Auth::attempt(['user_name' => $request['email'], 'password' => $request['password'],'user_type'=>1],$remember )) {
                $activity=[
                    'user_id'=>Auth::user()->id,
                    'message'=>'logged in',
                ];
                $activity['subjects']=$request->header('user-agent');
                $activity['ip_address']=$request->ip();
                ActivityLog::create($activity);
                Session::flash('success','Login Successfully');
                return redirect('admin/dashboard');

            }elseif (Auth::attempt(['email' => $request['email'], 'password' => $request['password'],'user_type'=>1],$remember)) {
                $activity=[
                    'user_id'=>Auth::user()->id,
                    'message'=>'logged in',
                ];
                $activity['subjects']=$request->header('user-agent');
                $activity['ip_address']=$request->ip();
                ActivityLog::create($activity);
                Session::flash('success','Login Successfully');
                return redirect('admin/dashboard');
            }else{

                Session::flash('error_msg','credential Error Login failed');
                return redirect('/login');
            }

        } catch (\Exception $e) {
            return  $e->getMessage() . "on line" . $e->getLine();

        }
    }
    ////////////////////////////////.........  Admin Dashboard ......////////////////////////

    public function dashboard(){
       $latest_user = DB::table('users')->whereRaw('date(created_at) = ?',
           [Carbon::now()->format('Y-m-d')])->count();
       $users = DB::table('users')->count();
       $unconfirmed_user= DB::table('users')->whereStatus('UnConfirmed')->count();
        $bane_users= DB::table('users')->whereStatus('baned')->count();
        $latest_registers = User::latest()->take(5)->get();

//        $res= User::whereUserType(2)->get()->groupBy(function($val) {
//             return Carbon::parse($val->created_at)->format('m');
//         });
//            isset($res['01']) ? $res['01']->count():0;

          $results = User::selectRaw('year(created_at) year, monthname(created_at) month, count(*) data')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->get();
         $months=[];
         $monthsCount=[];
       foreach ($results as $result){
          // print_r($result->month);
           $monthsCount[]=$result->data;
           $months[]=$result->month;
       }
      return view('layouts.Admin.Dashboard.index',compact(['users','latest_user','unconfirmed_user','bane_users','latest_registers','months','monthsCount']));
        }
    ////////////////////////////////.........sign users ......////////////////////////
    public function create()
    {
        return view('signup');
    }
    public function store(StoreUser $request)
    {
        $request->validate([

            'password'=> 'required|min:7',
        ]);
        $validated = $request->validated();
        if ($validated) {

            $user_data = [
                'user_name' => $request['user_name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'user_type'=>2,
            ];
            $user = User::create($user_data);
            Session::flash('success_signup','signUp Successfully');
            Auth::login($user);
            return redirect('admin/dashboard');
        }
    }
    ////////////////////////////////.........forget Password......////////////////////////
        Public function index(){

            return view('layouts.Auth.forgetPassword');

        }

    public function forget(Request $request){
        $request->validate([
            'email' => 'required|exists:Users,email',
        ]);
        $user_data = [
            'email' => $request['email'],
        ];
        $user_mail= User::whereEmail($request->email)->first();
        if($user_mail) {
            $code = rand(1001, 99999);
            User::whereEmail($user_mail->email)->update(['code'=> $code]);
            Mail::to($user_mail->email)->send(new SignUp($code));
            Session::flash('success','OTP send on email Successfully');
                  return redirect('/forget/code')->with($code);
              }else{
                  return redirect('forget_password')->with('error_msg','crendetial error');
              }
    }
    //////////////////////////.........verify OTP...............////////////////
    public function forgetCode(){

        return view('layouts.Auth.forget_code');
    }
    public function verifyOtp(Request $request){
        $request->validate([
            'code' => 'required|exists:Users,code',
            'password'=> 'required|confirmed|min:7',
        ]);
        $pass_reset=[
            'code' => $request['code'],
            'password' => $request['password']
        ];
            $user= User::whereCode($request['code'])->first();
        if($request['code']){
            $code=rand(1001,99999);
            User::whereCode($request['code'])->update(['password'=>\Hash::make($request['password']),'code'=>$code]);
            Session::flash('success','Reset Password successfully');
            return redirect('login');
        }else{
            return redirect('/forget/code')->with('error_msg','Password Reset failed');
        }
    }
//////////////////////.......Admin Update Profile Section........///////////
    public function getProfile(){
        return view('layouts.Admin.profile')->with("user", auth()->user());
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

       $user=Auth::user();
        if(empty($request->profile_picture)){
            $user->update([$user->profile_picture]);
        }elseif($request->profile_picture){
            $user->update([$request->profile_picture]);
        }
        $user->update([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
        ]);
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $file->move('uploads/profile/' . $request['id'], $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $file_path = 'uploads/profile/' . $request['id'] . '/' . $file_name;
            User::whereId($request['id'])->update(['profile_picture' => $file_path]);
        }
        return response()->json([
            "success" => [
                "message" => "profile update successfully"
            ]
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flash('success_msg','LogOut Successfully');
       return redirect('login');
    }
}
