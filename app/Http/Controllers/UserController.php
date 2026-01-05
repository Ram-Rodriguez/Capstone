<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\ChildrenGroup;
use App\Models\CourtAppointment;
use App\Models\MedicalAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'employee_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => ['required',
            Password::min(8)
            ->letters()      // requires at least one letter
            ->numbers()      // requires at least one number
            ->mixedCase()    // requires at least one uppercase and one lowercase letter
            ->symbols()]    // requires at least one symbol
        ]);

        $user = new User();
        $user->role = $request->role;
        $user->employee_number = $request->employee_number;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.read')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function read()
    {
        $query = User::where('is_archived', '=', '0')->get();
        $data['users'] = $query;

        return view('admin.users.user-list', $data);
    }
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['user'] = User::find($id);
        return view('admin.users.edit-user', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'role' => 'required',
            'employee_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::find($request->id);
        $user->role = $request->role;
        $user->employee_number = $request->employee_number;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->update();

        return redirect()->route('users.read')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function archive(Request $request)
    {
        $user = User::find($request->id);
        $user->is_archived = 1;
        $user->update();
        return redirect()->route('users.read')->with('success', 'Record archived successfully!');
    }
    public function archives()
    {
        $query = User::where('is_archived', '=', '1')->get();
        $data['users'] = $query;
        return view('admin.users.archives', $data);
    }
    public function unarchive(Request $request)
    {
        $data = User::find($request->id);
        $data->is_archived = 0;
        $data->update();
        return redirect()->route('users.read')->with('success', 'Record restored successfully!');
    }

    public function headIndex(){
        return view('head.login');
    }
    public function staffIndex(){
        return view('staff.login');
    }
    public function headAuthenticate(Request $request){
        if(Auth::attempt(['email' => $request->email,'password'=> $request->password]))
        {
            if(Auth::user()->role != 'head')
            {
                Auth::logout();
                return redirect()->route('head.login')->with('error','Unauthorized user. Access denied!');
            }
            //$user = Auth::user();
            return /*dd(Auth::user());*/redirect()->route('head.dashboard');
        } else {
            return redirect()->route('head.login')->with('error', 'Invalid Credentials');
        }
    }
    public function staffAuthenticate(Request $request){
        if(Auth::attempt(['email' => $request->email,'password'=> $request->password]))
        {
            if(Auth::user()->role != 'staff')
            {
                Auth::logout();
                return redirect()->route('staff.login')->with('error','Unauthorized user. Access denied!');
            }
            //$user = Auth::user();
            return /*dd(Auth::user())*/redirect()->route('staff.dashboard');
        } else {
            return redirect()->route('staff.login')->with('error', 'Invalid Credentials');
        }
    }

    public function headDashboard(){
        $childrenRecords = Children::selectRaw('COUNT(*) as count')->where('is_archived', '=', '0')->first();
        $eligible = Children::where('is_archived', '=', '0')->get();
        $courtHearings = CourtAppointment::selectRaw('COUNT(*) as count')->first();
        $groups = ChildrenGroup::selectRaw('COUNT(*) as count')->first();
        $appointments = CourtAppointment::with(['children', 'employee'])
            // ->whereBetween('appointment_date', [now()->startOfMonth(), now()->endOfMonth()])
            ->where('appointment_date', '>=', now())
            ->orderBy('appointment_date')
            ->orderByDesc('appointment_date')
            ->get();
        $data['appointments'] = $appointments;
        $users = Children::selectRaw('MONTH(doa) as month, COUNT(*) as count')
            ->whereYear('doa', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
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


        return view('head.dashboard', $data)
        ->with('childrenRecords', $childrenRecords)
        ->with('courtHearings', $courtHearings)
        ->with('groups', $groups)
        ->with('eligible', $eligible)
        ->with('doaChart', $doaChart)
        ->with('doaChart2', $doaChart2);
    }

    public function staffDashboard(Request $request){
        $childrenRecords = Children::whereHas('childrenGroup', function(Builder $query){
            $query->where('employee_id','=', Auth::user()->id);
        })->where('is_archived', '=', '0')->count();
        $childrenGroup = ChildrenGroup::where('employee_id', '=', Auth::user()->id)->get();
        $appointments = MedicalAppointment::with(['children', 'employee'])
        // ->whereBetween('appointment_date', [now()->startOfMonth(), now()->endOfMonth()])
        ->where('appointment_date', '>=', now())
        ->where('employee_id', '=', Auth::user()->id)
        ->orderBy('appointment_date')
        ->orderByDesc('appointment_date')
        ->get();

        return view('staff.dashboard')->with('childrenRecords', $childrenRecords)
            ->with('childrenGroup', $childrenGroup)
            ->with('appointments', $appointments);
    }
    public function headLogout(){
        Auth::logout();
        return redirect()->route('head.login')->with('success','Logged out successfully');
    }
    public function staffLogout(){
        Auth::logout();
        return redirect()->route('staff.login')->with('success','Logged out successfully');
    }

    // public function resetPassword(Request $request){
    //     $request->validate([
    //         'password' => ['required',
    //         Password::min(8)
    //             ->letters()      // requires at least one letter
    //             ->numbers()      // requires at least one number
    //             ->mixedCase()    // requires at least one uppercase and one lowercase letter
    //             ->symbols()]    // requires at least one symbol
    //     ]);
    // }

    public function changePassword(){
        return view('head.change-password');
    }
    public function staffChangePassword(){
        return view('staff.change-password');
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
        $user = User::find(Auth::user()->id);
        if(Hash::check($old_password, $user->password)){
            $user->password = Hash::make($new_password);
            $user->update();
            return redirect()->back()->with('success','Password has been updated successfully!');
        } else {
            return redirect()->back()->with('error','Old password is incorrect');
        }
    }
    public function staffUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => ['required',
            Password::min(8)
                ->letters()      // requires at least one letter
                ->numbers()      // requires at least one number
                ->mixedCase()    // requires at least one uppercase and one lowercase letter
                ->symbols()],
            'password_confirmation' => 'required|same:new_password'
        ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $user = User::find(Auth::user()->id);
        if(Hash::check($old_password, $user->password)){
            $user->password = Hash::make($new_password);
            $user->update();
            return redirect()->back()->with('success','Password has been updated successfully!');
        } else {
            return redirect()->back()->with('error','Old password is incorrect');
        }
    }

    // public function userChart() {
    //     $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
    //         ->whereYear('created_at', date('Y'))
    //         ->groupBy('month')
    //         ->orderBy('month')
    //         ->get();

    //     $labels = [];
    //     $data = [];
    //     $colors = ['#FF6384', '#36a2eb', '#ffce56', '#8bc34a', '#ff5722', '#009688', '#795548', '#9c27b0', '#2196f3', '#ff9800', '#cddc39', '#6078b'];

    //     for($i = 1; $i < 12; $i++){
    //         $month = date('F', mktime(0,0,0, $i,1));
    //         $count = 0;

    //         foreach($users as $user){
    //             if($user->month == $i){
    //                 $count = $user->count;
    //                 break;
    //             }

    //             array_push($labels, $month);
    //             array_push($data, $count);
    //         }
    //     }

    //     $datasets = [
    //         [
    //             'label' => 'Users',
    //             'data' => $data,
    //             'backgroundColor' => $colors
    //         ]
    //     ];

    //     return compact('datasets', 'labels');
    // }

}
