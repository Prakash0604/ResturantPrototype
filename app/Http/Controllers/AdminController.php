<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\category;
use App\Models\menu_item;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Json;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totaluser = User::where("position", "employee")->count();
        return view('pages.dashboard', compact('totaluser'));
    }

    public function userstable()
    {
        $users = User::where('position', 'users')->get();
        return view('pages.tables', compact('users'));
        // dd($users);
    }
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

    public function employeeAdd(){
        return view('pages.employee');
    }
}
