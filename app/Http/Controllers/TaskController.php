<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\jb;
use App\Models\jb_ty;
use App\Models\un;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Session;

class TaskController extends Controller
{
    public function Registration(Request $request)
    {
        $users = new un;
        $users->first_name = $request['first_name'];
        $users->last_name = $request['last_name'];
        $users->country = $request['country'];
        $users->email = $request['email'];
        $users->password = Hash::make($request['password']);
        $users->re_password = Hash::make($request['re_password']);
        $res = $users->save();
        if ($res) {
            return redirect('/login');
        } else {
            return back()->with('fail', 'something went wrong');
        }
    }
    public function loginuser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:5|max:8'
        ]);
        $users = un::where('email', '=', $request->email)->first();
        if ($users) {
            if (Hash::check($request['password'], $users->password)) {
                $request->session()->put('LoginId', $users->id);
                return redirect('/Dashboard');
            } else {
                return back()->with('fail', 'match does not match');
            }
        } else {
            return back()->with('fail', 'You are not registered');
        }
    }


    public function Dashboard()
    {

        $country = country::all();

        $users = new un;
        $users = un::all();

        $jobs = new jb;
        $jobs = jb::all();

        $job_types = new jb_ty;
        $job_types = jb_ty::all();

        return view("Dashboard")
            ->with('country', $country)
            ->with('users', $users)
            ->with('jobs', $jobs)
            ->with('job_types', $job_types);
    }
    public function Logout()
    {
        if (Session::has('LoginId')) {
            Session::pull('LoginId');
            return redirect('/login');
        }
    }
}
