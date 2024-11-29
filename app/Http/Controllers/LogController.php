<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Children;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Log::with(['children'])->latest('id')->get();
        $data['logs'] = $query;
        return view('admin.logs.logs', $data);
    }
    public function headLindex($id)
    {
        $query = Log::with(['children'])->where('child_id', '=', $id)->latest('id')->get();
        $data['logs'] = $query;
        return view('head.logs.list', $data)->with('id', $id);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['children'] = Children::all();
        return view('admin.logs.create', $data);
    }
    public function headLcreate($id)
    {
        $child = Children::where('id', '=', $id)->first();
        return view('head.logs.create')->with('child', $child);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'child_id' => 'required',
            'details' => 'string|required'
        ]);

        $appointment = new Log();
        $appointment->child_id = $request->child_id;
        $appointment->details = $request->details;
        $appointment->save();

        return redirect()->route('logs.create')->with('success', 'Log created successfully!');
    }
    public function headLstore(Request $request)
    {
        $request->validate([
            'child_id' => 'required',
            'details' => 'string|required'
        ]);

        $appointment = new Log();
        $appointment->child_id = $request->child_id;
        $appointment->details = $request->details;
        $appointment->save();

        return redirect()->route('head.logs.index', $request->child_id)->with('success', 'Log created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Log $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['log'] = Log::find($id);
        $data['children'] = Children::all();
        return view('admin.logs.edit', $data);
    }
    public function headLedit($id)
    {
        $log = Log::find($id)->first();
        return view('head.logs.edit')->with('log', $log);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'child_id' => 'nullable',
            'details' => 'string|required'
        ]);

        $log = Log::find($request->id);
        $log->child_id = $request->child_id;
        $log->details = $request->details;
        $log->update();

        return redirect()->route('logs.index')->with('success', 'Log updated successfully!');
    }
    public function headLupdate(Request $request)
    {
        $request->validate([
            'child_id' => 'nullable',
            'details' => 'string|required'
        ]);

        $log = Log::find($request->id);
        $log->child_id = $request->child_id;
        $log->details = $request->details;
        $log->update();

        return redirect()->route('head.logs.index', $request->child_id)->with('success', 'Log updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Log $log)
    {
        $log = Log::find($log->id);
        $log->delete();

        return redirect()->route('logs.index')->with('success', 'Log deleted successfully');
    }
    public function headLdelete($id)
    {
        $log = Log::find($id);
        $redirect = $log->child_id;
        $log->delete();

        return redirect()->route('head.logs.index', $redirect)->with('success', 'Log deleted successfully');
    }

    // public function archive(Request $request)
    // {
    //     $user = Log::find($request->id);
    //     $user->is_archived = 1;
    //     $user->update();
    //     return redirect()->route('users.read')->with('success', 'Record archived successfully!');
    // }
}
