<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\UserChart;
use App\User;

class UserChartController extends Controller
{
    public function index()
    {
        $all_users = User::count();
        $precent =  $all_users/100;

        $usersChart = new UserChart;
        $usersChart->labels(['all users']);
        $usersChart->dataset('all user register', 'bar', [$precent]);
        return view('users', compact('usersChart','precent'));
    }



    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}



