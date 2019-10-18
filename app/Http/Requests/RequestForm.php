<?php

namespace App\Http\Requests;
use App\Role;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

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
            'email' => 'required',
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

    }
}


/*$user = new User();
$user->name = $request->name;
$user->email = $request->email;
$user->password = bcrypt($request->password);

$user->save();
// add role;*/