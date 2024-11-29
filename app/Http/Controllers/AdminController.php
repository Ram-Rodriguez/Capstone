<?php

namespace App\Http\Controllers;
use App\Models\ChildrenGroup;
use App\Models\CourtAppointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Children;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=> 'required'
        ]);
        if(Auth::guard('admin')->attempt(['email'=> $request->email,'password'=> $request->password]))
        {
            //return dd(Auth::user());
            //return dd(Auth::guard()->user());
            if(Auth::guard('admin')->user()->role != 'admin')
            {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with('error','Unauthorized user. Access denied!');
            }
            //return dd(Auth::user());
            //return dd(Auth::guard()->user());
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->with('error', 'Something went wrong');
        }
    }

    public function register()
    {
        $user = new User();
        $user->name="student";
        $user->role="staff";
        $user->email="student@gmail.com";
        $user->password = Hash::make('admin');
        $user->save();
        return redirect()->route('admin.login')->with('success', 'User created successfully');
    }

    public function dashboard()
    {
        $activeUsers = User::selectRaw('COUNT(*) as count')->where('is_archived', '=', '0')->first();
        $childrenRecords = Children::selectRaw('COUNT(*) as count')->where('is_archived', '=', '0')->first();
        $courtHearings = CourtAppointment::selectRaw('COUNT(*) as count')->first();
        $groups = ChildrenGroup::selectRaw('COUNT(*) as count')->first();
        $users = Children::selectRaw('MONTH(doa) as month, COUNT(*) as count')->whereYear('doa', date('Y'))->groupBy('month')->orderBy('month')->get();

        $labels = [];
        $data = [];
        $colors = ['#FF6384', '#36a2eb', '#ffce56', '#8bc34a', '#ff5722', '#009688', '#795548', '#9c27b0', '#2196f3', '#ff9800', '#cddc39', '#6078b'];

        for($i = 1; $i <= 12; $i++){
            $month = date('F', mktime(0,0,0, $i, 1));
            $count = 0;

            foreach($users as $user){
                if($user->month == $i){
                    $count = $user->count;
                    //break;
                }

                array_push($labels, $month);
                array_push($data, $count);
            }
        }

        $datasets = [
            [
                'label' => 'Children Records',
                'data' => $data,
                'grouped' => 'true'
                //'backgroundColor' => $colors
            ]
        ];

        return view('admin.dashboard', compact('datasets', 'labels'))
            ->with('activeUsers', $activeUsers)
            ->with('childrenRecords', $childrenRecords)
            ->with('courtHearings', $courtHearings)
            ->with('groups', $groups);
        //return dd(compact('datasets', 'labels'));
        //return dd($users);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'User logged out successfully');
    }
    public function form()
    {
        return view('admin.form');
    }
    public function table()
    {
        return view('admin.table');
    }

    public function changePassword(){
        return view('admin.change-password');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'password_confirmation' => 'required|same:new_password'
        ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $user = User::find(Auth::guard('admin')->user()->id);
        if(Hash::check($old_password, $user->password)){
            $user->password = $new_password;
            $user->update();
            return redirect()->back()->with('success','Password has been updated successfully!');
        } else {
            return redirect()->back()->with('error','Old password is incorrect');
        }
    }
}
