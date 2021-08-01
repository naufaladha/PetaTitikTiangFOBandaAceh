<?php

namespace App\Http\Controllers;
use App\Models\User; 
use App\Models\Post;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $users = User::all();
        
        return view("admin.home",['users' => $users, 'i' => 1]);
    }

    public function create(){
        return view("admin.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' =>  'required',
            'email' => 'required|unique:users',
            'role' =>'required'
            
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt("12345678")
        ]);

        return redirect()->route('admin_home')->with(['success' => 'User berhasil ditambahkan']);
    }

    public function edit( $id){
        $user = User::findOrFail($id);
        return view("admin.edit", ['user'=>$user]);
    }
    public function update(Request $request ,$id){

        $request->validate([
            'name' =>  'required',
            'email' => ['required',Rule::unique('users')->ignore($id)],
            // 'email' => 'required|unique:users,name,except,id',
            'role' =>'required',
            'password' => 'nullable|min:6'
            
        ]);

        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' =>  ($request->password != null)? bcrypt($request->password) : bcrypt("12345678"),
        ]);
        return redirect()->route('admin_home')->with(['success' => 'User berhasil diperbarui']);
    }

    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin_home');
    }
}