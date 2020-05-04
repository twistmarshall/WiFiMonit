<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
  public function showProfile()
     {
         return view('users.userProfile');
     }

     public function changeUserPasswordView()
     {
         return view('auth.passwords.changePasswordView');
     }

     public function changeUserPassword(Request $request)
     {

         $request->validate([
             'old_password' => 'required|string|min:3',
             'password' => 'required|string|min:3|confirmed|different:old_password',
         ]);

         $user = User::findOrFail(Auth::id());

         if (Hash::check($request->old_password, $user->password)) {
             $user->password = Hash::make($request->password);
             $user->save();
         } else {
             return redirect()->back()->withErrors(array("old_password" => "old password errada"));
         }

         return view('users.userProfile')->with('success');
     }

     public function changeUserProfile(Request $request)
     {

         $userId = Auth::id();
         $user = User::findOrFail($userId);

         if (!$request->has('phone')) {
             $request->request->add(['phone' => null]);   //caso não exista põe phone a null
         }

         if ($request->email !== $user->email) { //=== para verificar se tem mesmo tipo
             $request->validate([
                 'name'          => 'required|regex:/^[\pL\s]+$/u',
                 'email'         => 'required|string|email|max:255|unique:users',
                 'phone'         => 'nullable|regex:/^[0-9+\s]+$/',
             ]);
         } else {
             $request->validate([
                 'name'          => 'required|regex:/^[\pL\s]+$/u',
                 'phone'         => 'nullable|regex:/^[0-9+\s]+$/',
             ]);

         }
         $user->fill($request->all());





         $user->save();

         return view('users.userProfile')->with('success');

     }
  }
