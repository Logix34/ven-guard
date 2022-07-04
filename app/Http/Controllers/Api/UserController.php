<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users=User::whereUserType(2)->get();
        return response()->json([
            "status"      =>'Success',
            "data"        =>$users,
        ]);
    }
    public function login(Request $request)
    {
        $credentials= $request->validate([
            'user_name'     =>'required',
            'password'      =>'required|min:7',
        ]);
        try {

                  $user= User::whereUserName($request->user_name)->orWhere( 'email', $request->user_name)->first();

                  if($user && Hash::check($request->password,$user->password) && $request->user_type== 1){
                      $token = $user->createToken("name")->plainTextToken;
                      return response()->json([
                    "status"      =>'Login Successfully',
                    "token"       =>$token,
                    "data"        =>$user,
                ]);
                  }else{
                      return response()->json([
                          "status"     => 'Login failed',
                      ]);
                  }


//            if(Auth::attempt($credentials )|| Auth::attempt(['email' => $request['email'], 'password' => $request['password'],'user_type'=>1])) {
//                $activity=[
//                    'user_id'=>Auth::user()->id,
//                    'message'=>'logged in',
//                ];
//                $activity['subjects']=$request->header('user-agent');
//                $activity['ip_address']=$request->ip();
//                $activityData= ActivityLog::create($activity);
//                $token = Auth::user()->createToken('name')->plainTextToken;
//                return response()->json([
//                    "status"     =>'success',
//                    "token"     => $token,
//                    "user"       => Auth::user(),
//                    "data"       => $activityData,
//                   "device_name"
//                ]);
//            }
//            else{
//                return  response()->json([
//                    "status" =>'failed',
//                ]);
//            }
        } catch (\Exception $e) {
            return  $e->getMessage() . "on line" . $e->getLine();

        }
    }

    public function signUp(Request $request)
    {
        $request->validate([
            'user_name'     => 'required',
            'email'         => 'required',
            'password'      => 'required|min:7',
            'device_name'   => 'required',
        ]);


            $user_data = [
                'user_name' => $request['user_name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'user_type'=>2,
            ];
        if($user_data){
           $user= User::create($user_data);
            Auth::login($user);
            $token = $request->user()->createToken($request->device_name)->plainTextToken;
            return  response()->json([
                "status"     =>'success',
                "token"      =>$token,
                "user"   =>$user,
            ]);
        }else{
            return  response()->json([
                "status" =>'failed',
            ]);
        }
    }




    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
