<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\newuserWelcome;
use App\Image;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\RequestForm;
use Illuminate\Support\Facades\Storage;
use session;
use Auth;
use App\Charts\UserChart;
use App\User_Role;

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

    public function store(RequestForm $form)
    {

        $form->persist();

        session()->flash('message', 'saved successfull');

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
        if (request()->has('sort')) {

            $users = User::orderBy('name', request('sort'))->paginate(4)->appends('sort', request('sort'));

        } else {

            $users = User::paginate(4);
        }


        $today_users = User::whereDate('created_at', today())->count();
        $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
        $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();
        $all_users = User::count();
        $precent=  $all_users/100;


        $usersChart = new UserChart;
        $usersChart->labels(['Today', 'Yesterday', '2 days ago']);
        $usersChart->dataset(' user ', 'line', [$today_users, $yesterday_users, $users_2_days_ago])
            ->color("RGB(0,94,255)");



        $userChart = new UserChart;
        $userChart->labels(['all users']);
        $userChart->dataset('all user register', 'bar', [ $precent ])
        ->backgroundcolor('005EFF');


        return view('adminv', compact('users', 'usersChart','userChart'));
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

    public function delete($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        return back();

    }

    public function edite(User $user)
    {
        //  $user = User::find($id);

        //return view('edite', compact('user'));
        return view('edite')->withUser($user);
    }

    public function update(Request $request, $id)
    {

        $user = User::whereId($id)->update($request->except(['_token']));
        session()->flash('message', 'modified has successful');
        return redirect('/admin');

    }


    public function editor()
    {

        return view('editorv');
    }


    public function file()
    {
        return view('feature');
    }


    public function uplodfile(Request $request)
    {

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

    public function downfile($id)
    {
        $image = Image::find($id);
        return Storage::download($image->photo);
    }


    public function showcontact()
    {
        return view('contact');
    }


    public function postcontact(Request $request)
    {
        $data = array(
            'email' => $request->email,
            'subject' => $request->subject,
            'Bodymessage' => $request->message
        );
        Mail::send('emails', $data, function ($message) use ($data) {

            $message->from($data['email']);
            $message->to('marwen.khefacha03@gmail.com');
            $message->subject($data['subject']);
        });
        session()->flash('message', 'votre mail bien envoyer');

        return redirect()->back();


    }


    public function search(Request $request)
    {
        $search = $request->get('search');

        $users = User::where('name', 'like', $search . '%')
            ->orWhere('id', 'like', '%' . $search . '%')
            ->paginate(4)->appends('search', request('search'));


        $user_admin = Role::where('name', 'admin')->count();
        $user_user = Role::where('name', 'user')->count();
        $user_editor = Role::where('name', 'editor')->count();
        $all_users=User::count();
        $precent=  $all_users/100;
        $usersChart = new UserChart;
        $usersChart->labels(['admin', 'users', 'editor']);
        $usersChart->dataset('All users', 'line', [$user_admin, $user_user, $user_editor])
            ->color("RGB Percent(50%,50%,50%)");

        $userChart = new UserChart;
        $userChart->labels(['all users']);
        $userChart->dataset('all user register', 'bar', [ $precent ])
            ->backgroundcolor('005EFF');



        return view('adminv', compact('users', 'usersChart','userChart'));


    }


    public function deleted()
    {

        $users = User::paginate(5);
        return view('deleted', compact('users'));
    }


    public function deletall(Request $request)
    {
        $ids = $request->get('ids');

        User::whereId($ids)
            ->delete();
        return back();
    }

}