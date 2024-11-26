<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
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

        return redirect()->route('users.create')->with('success', 'User created successfully!');
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
            'middle_name' => 'required',
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
        return redirect()->route('users.archives')->with('success', 'Record restored successfully!');
    }

    public function headIndex(){
        return view('head.login');
    }
    public function headAuthenticate(Request $request){
        if(Auth::attempt(['email' => $request->email,'password'=> $request->password]))
        {
            if(Auth::user()->role != 'head')
            {
                Auth::logout();
                return redirect()->route('head.login')->with('error','Unauthorized user. Access denied!');
            }
            return redirect()->route('head.dashboard');
        } else {
            return redirect()->route('head.login')->with('error', 'Something went wrong');
        }
    }

    public function headDashboard(){
        return route('head.dashboard');
    }
}
