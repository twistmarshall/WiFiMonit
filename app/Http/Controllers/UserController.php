<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

     public function showProfile()
      {
          $user = Auth::user();
          return view('users.userProfile', compact('user'));
      }

      public function changeUserPasswordView()
      {
          return view('auth.passwords.changePassword');
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


      public function changeUserProfile(Request $request){
        $user = Auth::user();

        $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email'         => 'required|string|email|max:255|unique:users,email,'.$user->id,
        'telefone'         => 'nullable|regex:/^[0-9+\s]+$/',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);


        $user->fill($request->all());


        if($user->foto != null && Hash::check($request->file('foto'), $user->foto)){
            Storage::delete("public/fotos/{$user->foto}");
        }

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $foto = $request->file('foto')->hashName();
            $request->file('foto')->store('fotos', 'public');
            $user->foto = $foto;
        }

        $user->save();



        return view('users.userProfile')->with('success', 'Profile saved successfully.');
    }


}
