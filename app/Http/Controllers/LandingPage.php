<?php

namespace App\Http\Controllers;

use App\Models\menu_item;
use Illuminate\Http\Request;

class LandingPage extends Controller
{
    public function LandingPage(){
        $menus=menu_item::all();
        // $menuspecial=menu_item::with('category')->where('category','Todays Special')->get();
        return view('LandingPage.index',compact('menus'));
    }
}
