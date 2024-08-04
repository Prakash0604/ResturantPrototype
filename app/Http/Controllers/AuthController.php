<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function index(){
        return view('Auth.sign-up');
    }
    public function storeSignup(Request $request){
        $request->validate([
            'name'=>'required|string|min:4',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);
        $token=Str::random(50);
        $users=new User();
        $users->name=$request->name;
        $users->email=$request->email;
        $users->password=$request->password;
        $users->is_verified=1;
        $file=$request->images;
        if($file){
            $filename=time()."-".$file->getclientOriginalName();
            $file->storeAs('public/images/'.$filename);
            $users->images=$filename;
        }
        $users->remember_token=$token;
        $users->save();
        // $domain=URL::to('/');
        // $url=$domain."/email/verification/".$token;
        // $data['url']=$url;
        // $data['username']=$request->name;
        // $data['email']=$request->email;
        // $data['title']="Email Verification";
        // Mail::send('Mail.MailVerification',['data'=>$data],function($message) use($data){
        //     $message->to($data['email'])->subject($data['title']);
        // });
        return redirect('/')->with('success','Registered successfully!!');
    }

    public function verification($token){
        // dd($token);
        $users=User::where('remember_token',$token)->get();
        if($users->count() > 0){
            if($users[0]['is_verified']==1){
                return response()->json(['email'=>'Email already verified']);
            }

            User::where('id',$users[0]['id'])->update([
                'is_verified'=>1,
                'email_verified_at'=>date('Y-m-d H:i:s'),
            ]);

            return response()->json(['success'=>200]);
        }else{
            return response()->json(['warning'=>"Invalid token"]);
        }
    }

    public function indexview(){
        return view('Auth.sign-in');
    }
    public function storeindex(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);
        $users=User::where('email',$request->email)->get();
        if($users && Auth::attempt($request->only('email','password'))){
            if($users[0]['is_verified']==1){
                if($users[0]['is_admin']==1){
                    // return response()->json(['success'=>"Admin Login"]);
                    // return redirect('/admin/dashboard');
                    session()->put($request->email);
                    return redirect('/admin/dashboard');
                }else{
                    session()->put($request->email);
                    // return response(['message'=>'User Login']);
                    return redirect('/users/booktable');
                }
            }else{
                return back()->with(['message'=>"Pelase verify your email"]);
            }
            return response()->json(['success'=>true]);
        }
        else{
            // echo $users;
            // die();
            if($users->count()>0){
                return back()->with(['message'=>'Invalid Login Crediantials']);
            }else{
                return back()->with(['message'=>'Email not register yet']);
            }
        }
        return response()->json(['success'=>false]);

    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('message','Logout Successfully');
    }
}
