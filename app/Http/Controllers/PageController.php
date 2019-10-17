<?php

namespace App\Http\Controllers;

use App\Image;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function posts()
    {

        return view('navbar');
    }

    public function create()
    {

        return view('register');

    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();
// add role;
        $user->roles()->attach(Role::where('name', 'user')->first());

        //login
        auth()->login($user);

        return redirect('/post');

    }


    public function viewlogin()
    {

        return view('login');
    }

    public function storelogin(Request $request)
    {

        if (!auth()->attempt(request(['email', 'password']))) {
            return back()->with('danger', 'mail or password not valid');
        }

        {
            return redirect('/post');

        }


    }

    public function destroy()
    {

        auth()->logout();
        return redirect('/post');

    }

    public function admin()
    {
        $users = User::all();

        return view('adminv', compact('users'));
    }


    public function addRole(Request $request)

    {


        $usersID = $request->get('users_id');
        $admins = $request->get('roles_admin');
        $editors = $request->get('roles_editor');
        $users = $request->get('roles_user');


        foreach ($usersID as $id) {
            $user = User::where('id', $id)->first();
            $user->roles()->detach();

            if ($users && in_array($id, $users)) {
                $user->roles()->attach(Role::role_user());
            }
            if ($admins && in_array($id, $admins)) {
                $user->roles()->attach(Role::role_admin());
            }
            if ($editors && in_array($id, $editors)) {
                $user->roles()->attach(Role::role_editor());
            }

        }

        return back();
    }


    public function editor()
    {

        return view('editorv');
    }


    public function file()
    {
        return view('welcome');
    }


    public function uplodfile(Request $request){

    // return $request->file('photo')->store('photos');
    // dd($path);
    // cache the file


     $file = Image::create([
         'photo' => $request->file('photo')->store('photos')
     ]);
     return redirect()->back();

 }


    public function show()
    {

        $file = Image::all();
        return view('info', compact('file'));

    }


}