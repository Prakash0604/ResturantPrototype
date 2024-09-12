<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\menu_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function booktable(){
        return view('UsersPage.booktable');
    }
    public function userProfile(){
        $user=Auth::user();
        return  view('UsersPage.profile',['user'=>$user]);
    }
    public function updateProfile(Request $request){
        $request->validate([
            'user_name'=>'required|string|min:3',
            'user_images'=>'mimes:jpg,png,jpeg|min:100',
            'user_phone'=>'min:10',
        ]);
        // $data=$request->only('user_name','user_phone','user_email','user_id','user_images');
        $user=User::find($request->id);
        $currentimage=$user->images;
        if($request->hasFile('user_images')){
            if($currentimage && file_exists(public_path('storage/images/'.$currentimage))){
                unlink(public_path('storage/images/'.$currentimage));
            }
            $newimage=$request->file('user_images');
            $currentimage=time().'.'.$newimage->getClientOriginalName();
            $newimage->storeAs('public/images/'.$currentimage);
        }
        $user->name=$request->user_name;
        $user->images=$currentimage;
        $user->address=$request->user_address;
        $user->phone=$request->user_phone;
        $user->save();
        return back();
    }

    public function menuitem(){
        $menu=menu_item::all();
        return view('UsersPage.menu',['menu'=>$menu]);
    }

    public function storeItems(Request $request){
        $items=$request->input('items',[]);
        session(['selected_items'=>$items]);
        return response()->json(['success'=>true]);
    }

    public function showItems($id){
        $data=menu_item::find($id);
        return view('UsersPage.OrderItemsList',compact('data'));
    }
    public function reservedTable(){

    }
}
