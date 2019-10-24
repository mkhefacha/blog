<?php

namespace App\Http\Requests;
use App\Mail\welcome;
use App\Role;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RequestForm extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required',

        ];
    }


    public function persist()
    {

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('name')),
        ]);



        $user->roles()->attach(Role::where('name', 'user')->first());

        //login
        auth()->login($user);
        Mail::to($user)->send(new welcome($user));
    }
}


/*$user = new User();
$user->name = $request->name;
$user->email = $request->email;
$user->password = bcrypt($request->password);

$user->save();
// add role;*/