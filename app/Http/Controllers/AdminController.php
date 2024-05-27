<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\event;
use App\Models\category;
use App\Models\menu_item;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use PHPUnit\Framework\fileExists;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Casts\JsonileExists;

class AdminController extends Controller
{
    // ================Dashboard Controller Start=======================
    public function dashboard()
    {
        $totaluser = User::where("position", "users")->count();
        return view('pages.dashboard', compact('totaluser'));
    }
    // ================Dashboard Controller End=======================



    // ================Users Controller Start=======================
    public function userstable()
    {
        $users = User::where('position', 'users')->get();
        return view('pages.tables', compact('users'));
        // dd($users);
    }
    // ================Users Controller End=======================



    // ================Profile Controller Start=======================
    public function profile()
    {

        return view('pages.profile')->with('user', auth()->user());
    }

    public function updateprofile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4',
            'email' => 'required|email',
        ]);
        $filename = null;
        $file = $request->images;
        if ($file != "") {
            $filename = time() . '-' . $file->getclientOriginalName();
            $file->storeAs('public/images/' . $filename);
            // $users->images=$filename;
        }
        User::where('email', $request->email)->update(
            [

                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'images' => $filename,
                ]
            );
            return back()->with('message', 'Profile has been updated');
        }

        // ================Profile Controller End=======================


        // ================Menu Controller Start=======================
        public function addMenu(Request $request)
        {
        $search=$request->search;
        $category=category::all();
        if($search!=""){
            $menuitems=menu_item::where('category_id',$search)->get();

        }else{

            $menuitems=menu_item::with('category')->get();
        }
        return view('pages.menu-item',compact('category','menuitems'));
    }

 public function additem(Request $request){
    try{
        $request->validate([
            'name'=>'required|string|min:3',
            'images'=>'mimes:jpeg,jpg,png',
            'description'=>'required',
            'price'=>'required|numeric',
        ]);

            $menu= new menu_item();
            $menu->name=$request->name;
            $file=$request->file('images');
            if($file!=""){
                $filename=time().'-'.$file->getClientOriginalName();
                $file->storeAs('public/food/'.$filename);
                $menu->images=$filename;
            }
            $menu->description=$request->description;
            $menu->price=$request->price;
            $menu->category_id=$request->category;
            $menu->save();
            return response()->json(['success'=>true,"menu"=>$menu]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }
    // ================Menu Controller End=======================

    // ================Category Controller Start=======================
    public function addCategory(Request $request)
    {
        try {
            $request->validate([
                'cat_name' => 'required|string|min:3',
            ]);
            // $data=$request->cat_name;
            category::create([
                'name' => $request->cat_name,
            ]);
            return response()->json(['success' => true, 'message' => 'Category added successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function showCategory()
    {
        $categories = category::all();

        return view('pages.categorylist', compact('categories'));
    }

    public function editcat($id)
    {
        $cat = category::find($id);
        return response()->json(['cat' => $cat]);
    }

    public function updateCat(Request $request)
    {
        try {
            $id = $request->id;
            $catcategory = category::find($id)->update([
                'name' => $request->edit_cat_name,
            ]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteCat($id)
    {
        try {
            $category = category::find($id);
            $category->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, "message" => $e->getMessage()]);
        }
    }
    // ================Category Controller End=======================



    // ================Employee  Controller  Start =======================
    public function employeeAdd(){
        return view('pages.employee');
    }
    // ================Employee  Controller  Start =======================

    // ========Event Controller start===============

    public function event(){
        $events=event::all();
        return view('pages.event',compact('events'));
    }

    public function eventAdd(Request $request){
        try{
            $request->validate([
                'event_name'=>'required|string|min:4',
                'event_description'=>'required|string',
                'event_price'=>'required|numeric',
                'event_images'=>'required|mimes:jpg,jpeg,png'
            ]);
            $event=new event();
            $event->event_name=$request->event_name;
            $event->event_desc=$request->event_description;
            $event->event_price=$request->event_price;
            $images=$request->file('event_images');
            if($images!=""){
                $filename=time().'-'.$images->getClientOriginalName();
                $images->storeAs('public/event/'.$filename);
                $event->event_image=$filename;
            }
            $event->save();
            return response()->json(['success'=>true,'message'=>$event]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function editEvent($id){
        try{
            $events=event::find($id);
            return response()->json(['success'=>true,'message'=>$events]);
        }catch(\Exception $e){
            return response()->json(['success'=>true,'message'=>$e->getMessage()]);

        }
    }

    public function updateEvent(Request $request){
        try{
            $id=$request->id;
            $event=event::find($id);
            if(!$event){
                return response()->json(['success'=>false,'message'=>'Event not found']);
            }
            $imagename=$event->event_image;
            if($request->hasFile("edit_event_images")){
                if($imagename && file_exists(public_path('storage/event/'.$imagename))){
                    unlink(public_path('storage/event/'.$imagename));
                }
                $image=$request->file('edit_event_images');
                $imagename=time().'.'.$image->getclientOriginalName();
                $image->storeAs('public/event/'.$imagename);
            }

            $event->update([
                'event_name'=>$request->edit_event_name,
                'event_desc'=>$request->edit_event_description,
                'event_image'=>$imagename,
                'event_price'=>$request->edit_event_price,
                'status'=>$request->edit_status,
            ]);
            return response()->json(['success'=>true]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);

        }

    }

    public function deleteEvent($id){
        try{
            $id=event::find($id);
            $id->delete();
            return response()->json(['success'=>true]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }
    // ========Event Controller End===============
}
