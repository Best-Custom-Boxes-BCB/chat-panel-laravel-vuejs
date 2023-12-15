<?php

namespace App\Http\Controllers\Admin\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }
    public function checkLogin(Request $request){
        $validate = Validator::make($request->all(),[
            'email' => 'required',
            'password'  =>  'required'
        ]);

        if($validate->fails()){
            return redirect()->back()->with('error',$validate->errors()->all()[0])->withInput();
        }

        if(Auth::attempt(['email' =>  $request->email , 'password'   =>  $request->password])){

            return redirect()->route('home');

        }else{

            return redirect()->back()->with('error','Email & Password are incorrect!');

        }
        return redirect()->to('login');
    }



    public function register(){
        return view('admin.auth.register');
    }

    public function storeRegister(Request $request){
        // return $request;
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required','unique:users,email', 'string','max:255',
            'password' => 'required'
        ]);
        if($validate->fails()){
            return redirect()->back()->with('error',$validate->errors()->all()[0])->withInput();
        }
        //         $request->validate([
        //                'name' => ['required'],
        //                'email' => ['required','unique:users,email', 'string','max:255'],
        //                'password' => ['required']

        // ]);

        // store the detail in db
        User::create($request->all());

        if(Auth::attempt(['email'   =>  $request->email, 'password' =>  $request->password])){
            return view('admin.dashboard.index');
        }else{
            return redirect()->back()->with('errors','Something went.! Please try again');
        }
    }
}
