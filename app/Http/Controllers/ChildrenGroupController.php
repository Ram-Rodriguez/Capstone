<?php

namespace App\Http\Controllers;

use App\Models\ChildrenGroup;
use Illuminate\Http\Request;

class ChildrenGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.children-group.children-group');
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
            'children_group_name' => 'required'
        ]);

        
        $data = new ChildrenGroup();
        $data->name = $request->children_group_name ;
        $data->save();

        return redirect()->route('children-group.create')->with('success', 'Children Group Added Successfully!');
    }

    public function read()
    {
        $data['children_group']= ChildrenGroup::get();
        return view('admin.children-group.children-group-list', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(ChildrenGroup $childrenGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['children_group'] = ChildrenGroup::find($id);
        return view('admin.children-group.edit-children-group', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = ChildrenGroup::find($request->id);
        $data->name = $request->children_group_name;
        $data->update();

        return redirect()->route('children-group.read')->with('success','Children Group Updated Successfully!');
    }

    public function delete($id)
    {
        $data = ChildrenGroup::find($id);
        $data->delete();

        return redirect()->route('children-group.read', $data)->with('success', 'Children Group Deleted Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChildrenGroup $childrenGroup)
    {
        //
    }
}
