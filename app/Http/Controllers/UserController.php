<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function deleteUser(User $user){
        $user->delete(); 
        return redirect('/users');
    }
    public function login(Request $request){
        $incomingField = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if(Auth::attempt(['username'=>$incomingField['loginusername'],'password'=>$incomingField['loginpassword']])){
            $request->session()->regenerate();
            return redirect()->route('home');
        }else{
            return redirect('/');
        }
    }
    public function register(Request $request){
        $incomingField = $request->validate([
            'name' => ['min:1','max:50'], 
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'usertype_id' => 'required'
        ]);
        $incomingField['password']=bcrypt($incomingField['password']);
        User::create($incomingField);
        
        return redirect('/users');
    }

    public function index()
    {
        $users = User::all(); 
        return view('users', compact('users'));
    }


    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function showEditScreen(User $user){
        return view('edit-user',['user'=> $user]);
    }

    public function updateUserInfo(User $user, Request $request ){
        $incomingFields = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'usertype_id' => 'required',
            'email' => 'required'
        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['username'] = strip_tags($incomingFields['username']);
        $incomingFields['password'] = strip_tags($incomingFields['password']);
        $incomingFields['usertype_id'] = strip_tags($incomingFields['usertype_id']);
        $incomingFields['email'] = strip_tags($incomingFields['email']);


        $user->update($incomingFields);
        return redirect('/users');
    }
}
