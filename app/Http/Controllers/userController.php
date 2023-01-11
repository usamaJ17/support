<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
   public function signup()
   {
    return view('auth.signup');
   }
   public function do_signup(Request $request)
   {
    $request->validate([
        'name' => 'required',
        'email' => 'required',
        'password'=> 'required',
    ]);
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = md5($request['password']);
    $user->save();
    $files = ['image', 'cover'];
    foreach ($files as $file) {
        if (request($file)){
            $name=uniqid().".".$request->file($file)->extension();
            $user->addMedia(request($file))->usingName($file)->usingFileName($name)->toMediaCollection();
        }
    }
    $session_data = [
        'id'=>$user->id,
        'name' => $user->name,
        'email' => $user->email,
        'role' => 'user',
        'logged_in' => true
    ];
    session()->put($session_data);
    return redirect(route('dashboard'));
   }
   public function signin()
   {
    return view('auth.signin');
   }
   public function do_signin(Request $req)
   {
    $email = $req['email'];
    $pass = md5($req['password']);
    if ($email != "") {
        if (User::where('email', '=', $email)->exists()) {
            $data = User::where('email', '=', $email)->first();
            if ($pass == $data->password) {
                $session_data = [
                    'id'=>$data->id,
                    'name' => $data->name,
                    'email' => $data->email,
                    'role' => $data->role,
                    'logged_in' => true
                ];
                session()->put($session_data);
                return redirect(route('dashboard'));            
            } else {
               echo "Password Wrong";
            }
        } else {
            echo"Email doesnot exist";
        }
    }
    echo"login succ234234s";
   }
   public function logout()
   {
    session()->flush();
    return redirect('/signin');
   }
}
