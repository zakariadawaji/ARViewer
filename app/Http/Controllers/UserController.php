<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Item;
use Validator;

class UserController extends Controller
{
    public function profile()
    {
        $data = ["user" => Auth::user()];
        return view('profile', $data);
    }

    public function profileUpdateView()
    {
        $data = ["user" => Auth::user()];
        return view('profileUpdate', $data);
    }

    public function profileUpdate( Request $request )
    {
      $validated = $request->validate([
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'required|email|unique:users,email,'.Auth::user()->id,
      ]);

      if ( !$validated ) return back();

      $user = Auth::user();
      $user->fname = $request->input('fname');
      $user->lname = $request->input('lname');
      $user->email = $request->input('email');
      $user->save();

      return redirect()->route('profile');

    }
}
