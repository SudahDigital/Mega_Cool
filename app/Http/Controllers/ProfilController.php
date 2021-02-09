<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index(){
        $id=\Auth::user()->id;
        $user = \App\User::with('cities')->where('id',$id)->first();
        return view('customer.profil',['user'=> $user]);
    }

    public function update(Request $request, $id)
    {
        $user =\App\User::findOrFail($id);
        if($request->has('avatar')){
            if($request->file('avatar')){
                if($user->avatar && file_exists(storage_path('app/public/'.$user->avatar)))
                {
                    \Storage::delete('public/'.$user->avatar);
                }
                $file = $request->file('avatar')->store('avatars','public');
                $user->avatar =$file;
            }
        }else if($request->has('profil_desc')){
            $user->profil_desc = $request->get('profil_desc');
        }
        
        $user->save();
        return redirect()->route('profil_user',[$id])->with('status','User Succsessfully Update');
    }
}
