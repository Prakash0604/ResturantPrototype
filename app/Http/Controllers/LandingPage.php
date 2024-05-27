<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\event;
use App\Models\menu_item;
use Illuminate\Http\Request;

class LandingPage extends Controller
{
    public function LandingPage(){
        $menus=menu_item::all();
        $events=event::where('status','1')->paginate(4);
        $teams=User::where('position','employee')->where('is_verified',1)->paginate(4);
        // $menuspecial=menu_item::with('category')->where('category','Todays Special')->get();
        return view('LandingPage.index',compact('menus','events','teams'));
    }
}
