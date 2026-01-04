<?php

namespace App\Http\Controllers;
use App\Models\ChildrenGroup;
use App\Models\CourtAppointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Children;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

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
        // if(Auth::guard('admin')->attempt(['email'=> $request->email,'password'=> $request->password]))
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
            return redirect()->route('admin.login')->with('error', 'Invalid Credentials');
            // return redirect()->route('admin.dashboard');
        }
    }

    public function register()
    {
        $user = new User();
        $user->name="Admin4";
        $user->role="admin";
        $user->email="admin4@gmail.com";
        $user->password = Hash::make('admin4');
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
        //$januaryDOA = Children::selectRaw('COUNT(*) as count, MONTH(doa) january')->groupBy('january')->get();
        $januaryDOA = Children::query()->where('is_archived', '=', '0')->whereMonth('doa', '1')->count();
        $februaryDOA = Children::query()->where('is_archived', '=', '0')->whereMonth('doa', '2')->count();
        $marchDOA = Children::query()->where('is_archived', '=', '0')->whereMonth('doa', '3')->count();
        $aprilDOA = Children::query()->where('is_archived', '=', '0')->whereMonth('doa', '4')->count();
        $mayDOA = Children::query()->where('is_archived', '=', '0')->whereMonth('doa', '5')->count();
        $juneDOA = Children::query()->where('is_archived', '=', '0')->whereMonth('doa', '6')->count();
        $julyDOA = Children::query()->where('is_archived', '=', '0')->whereMonth('doa', '7')->count();
        $augustDOA = Children::query()->where('is_archived', '=', '0')->whereMonth('doa', '8')->count();
        $septemberDOA = Children::query()->where('is_archived', '=', '0')->whereMonth('doa', '9')->count();
        $octoberDOA = Children::query()->where('is_archived', '=', '0')->whereMonth('doa', '10')->count();
        $novemberDOA = Children::query()->where('is_archived', '=', '0')->whereMonth('doa', '11')->count();
        $decemberDOA = Children::query()->where('is_archived', '=', '0')->whereMonth('doa', '12')->count();
        $januaryCA = CourtAppointment::query()->whereMonth('appointment_date', '1')->count();
        $februaryCA = CourtAppointment::query()->whereMonth('appointment_date', '2')->count();
        $marchCA = CourtAppointment::query()->whereMonth('appointment_date', '3')->count();
        $aprilCA = CourtAppointment::query()->whereMonth('appointment_date', '4')->count();
        $mayCA = CourtAppointment::query()->whereMonth('appointment_date', '5')->count();
        $juneCA = CourtAppointment::query()->whereMonth('appointment_date', '6')->count();
        $julyCA = CourtAppointment::query()->whereMonth('appointment_date', '7')->count();
        $augustCA = CourtAppointment::query()->whereMonth('appointment_date', '8')->count();
        $septemberCA = CourtAppointment::query()->whereMonth('appointment_date', '9')->count();
        $octoberCA = CourtAppointment::query()->whereMonth('appointment_date', '10')->count();
        $novemberCA = CourtAppointment::query()->whereMonth('appointment_date', '11')->count();
        $decemberCA = CourtAppointment::query()->whereMonth('appointment_date', '12')->count();

        $doaChart = [$januaryDOA, $februaryDOA, $marchDOA, $aprilDOA, $mayDOA, $juneDOA, $julyDOA, $augustDOA, $septemberDOA, $octoberDOA, $novemberDOA, $decemberDOA];
        $doaChart2 = [$januaryCA, $februaryCA, $marchCA, $aprilCA, $mayCA, $juneCA, $julyCA, $augustCA, $septemberCA, $octoberCA, $novemberCA, $decemberCA];

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
            ->with('groups', $groups)
            ->with('doaChart', $doaChart)
            ->with('doaChart2', $doaChart2);
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

    public function resetPassword(Request $request){
        $request->validate([
            'password' => 'required'
            // Password::min(8)
            // ->letters()      // requires at least one letter
            // ->numbers()      // requires at least one number
            // ->mixedCase()    // requires at least one uppercase and one lowercase letter
            // ->symbols()],    // requires at least one symbol
        ]);

        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->update();

        return redirect()->back()->with('success','Password has been reset with the temporary password!');
    }

    public function changePassword(){
        return view('admin.change-password');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => ['required',
            Password::min(8)
            ->letters()      // requires at least one letter
            ->numbers()      // requires at least one number
            ->mixedCase()    // requires at least one uppercase and one lowercase letter
            ->symbols()],    // requires at least one symbol
            'password_confirmation' => 'required|same:new_password'
        ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $user = User::find(Auth::guard('admin')->user()->id);
        // if(Hash::check($old_password, $user->password)){
        if(Hash::check($old_password, $user->password)){
            $user->password = $new_password;
            $user->update();
            return redirect()->back()->with('success','Password has been updated successfully!');
        } else {
            return redirect()->back()->with('error','Old password is incorrect');
        }
    }
}
