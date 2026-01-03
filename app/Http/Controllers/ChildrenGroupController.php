<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\ChildrenGroup;
use App\Models\User;
use Illuminate\Http\Request;

class ChildrenGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employee = User::all();
        return view('admin.children-group.children-group')->with('employee', $employee);
    }
    public function headCGindex()
    {
        //
        $employee = User::all();
        return view('head.children-group.create')->with('employee', $employee);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'children_group_name' => 'required'
        ]);


        $data = new ChildrenGroup();
        $data->employee_id = $request->employee_id ;
        $data->name = $request->children_group_name ;
        $data->save();

        return redirect()->route('children-group.create')->with('success', 'Children Group Added Successfully!');
    }
    public function headCGstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'children_group_name' => 'required'
        ]);


        $data = new ChildrenGroup();
        $data->employee_id = $request->employee_id ;
        $data->name = $request->children_group_name ;
        $data->save();

        return redirect()->route('head.children-group.create')->with('success', 'Children Group Added Successfully!');
    }

    public function read()
    {
        $data['children_group']= ChildrenGroup::with(['employee'])->latest('created_at')->get();
        return view('admin.children-group.children-group-list', $data);
    }
    public function headCGread()
    {
        $data['children_group']= ChildrenGroup::with(['employee'])->latest('created_at')->get();
        return view('head.children-group.list', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data['children_group'] = ChildrenGroup::with(['employee'])->find($id);
        $children = Children::where('children_group_id', '=', $id)->get();
        return view('head.children-group.view', $data)->with('children', $children);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['children_group'] = ChildrenGroup::with(['employee'])->find($id);
        $employee = User::all();
        return view('admin.children-group.edit-children-group', $data)->with('employee', $employee);
    }
    public function headCGedit($id)
    {
        $data['children_group'] = ChildrenGroup::with(['employee'])->find($id);
        $employee = User::all();
        return view('head.children-group.edit', $data)->with('employee', $employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = ChildrenGroup::find($request->id);
        $data->employee_id = $request->employee_id;
        $data->name = $request->children_group_name;
        $data->update();

        return redirect()->route('children-group.read')->with('success','Children Group Updated Successfully!');
    }
    public function headCGupdate(Request $request)
    {
        $data = ChildrenGroup::find($request->id);
        $data->employee_id = $request->employee_id;
        $data->name = $request->children_group_name;
        $data->update();

        return redirect()->route('head.children-group.read')->with('success','Children Group Updated Successfully!');
    }

    public function delete($id)
    {
        $data = ChildrenGroup::find($id);
        $data->delete();

        return redirect()->route('children-group.read', $data)->with('success', 'Children Group Deleted Successfully!');
    }
    public function headCGdelete($id)
    {
        $data = ChildrenGroup::find($id);
        $data->delete();

        return redirect()->route('head.children-group.read', $data)->with('success', 'Children Group Deleted Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChildrenGroup $childrenGroup)
    {
        //
    }
}
