<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\ChildrenGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['children_groups'] = ChildrenGroup::all();

        return view('admin.children.children', $data);
    }
    public function headIndex()
    {
        $data['children_groups'] = ChildrenGroup::all();

        return view('head.children.create', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.children.children');
    }

    public function headStore(Request $request){
        $request->validate([
            'children_group_id' => 'integer|nullable',
            'doa' => 'date|nullable',
            'is_foundling' => 'nullable',
            'first_name' => 'string|nullable',
            'middle_name' => 'string|nullable',
            'lastname' => 'string|nullable',
            'blood_type' => 'string|nullable',
            'age' => 'integer|nullable',
            'height' => 'decimal:0,4|nullable',
            'weight' => 'decimal:0,4|nullable',
            'dob' => 'date|nullable',
            'father_name' => 'string|nullable',
            'mother_name' => 'string|nullable',
            'guardian_name' => 'string|nullable',
            'csf' => ['file', 'nullable'],
            'poe' => ['file', 'nullable'],
            'cof' => ['file', 'nullable'],
            'cola' => ['file', 'nullable'],
            'cfsc' => ['file', 'nullable'],
            'bc' => ['file', 'nullable'],
            'admission_photo' => ['image', 'nullable'],
            'latest_photo' => ['image', 'nullable']
        ]);

        if($request->hasFile('csf')){
            $csf = $request->file('csf')->store(options:'s3');
        }

        if($request->hasFile('poe')){
            $poe = $request->file('poe');
        }

        if($request->hasFile('cof')){
            $cof = $request->file('cof')->store(options:'s3');
        }

        if($request->hasFile('cola')){
            $cola = $request->file('cola')->store(options:'s3');
        }

        if($request->hasFile('cfsc')){
            $cfsc = $request->file('cfsc')->store(options:'s3');        }

        if($request->hasFile('bc')){
            $bc = $request->file('bc')->store(options:'s3');        }

        if($request->hasFile('admission_photo')){
            $admission_photo = $request->file('admission_photo')->store(options:'s3');        }

        if($request->hasFile('latest_photo')){
            $latest_photo = $request->file('latest_photo')->store(options:'s3');        }

            Children::create([
                'children_group_id' => $request->children_group_id,
                'doa' => $request->doa,
                'is_foundling' => $request->is_foundling,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'lastname' => $request->lastname,
                'blood_type' => $request->blood_type,
                'age' => $request->age,
                'height' => $request->height,
                'weight' => $request->weight,
                'dob' => $request->dob,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'guardian_name' => $request->guardian_name,
                'csf' => $csf ??= null,
                'poe' => $poe ??= null,
                'cof' => $cof ??= null,
                'cola' => $cola ??= null,
                'cfsc' => $cfsc ??= null,
                'bc' => $bc ??= null,
                'admission_photo' => $admission_photo ??= null,
                'latest_photo' => $latest_photo ??= null
            ]);

            return redirect()->route('head.children.create')->with('success', 'Record added successfully');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'children_group_id' => 'integer|nullable',
            'doa' => 'date|nullable',
            'is_foundling' => 'nullable',
            'first_name' => 'string|nullable',
            'middle_name' => 'string|nullable',
            'lastname' => 'string|nullable',
            'blood_type' => 'string|nullable',
            'age' => 'integer|nullable',
            'height' => 'decimal:0,4|nullable',
            'weight' => 'decimal:0,4|nullable',
            'dob' => 'date|nullable',
            'father_name' => 'string|nullable',
            'mother_name' => 'string|nullable',
            'guardian_name' => 'string|nullable',
            'csf' => ['file', 'nullable'],
            'poe' => ['file', 'nullable'],
            'cof' => ['file', 'nullable'],
            'cola' => ['file', 'nullable'],
            'cfsc' => ['file', 'nullable'],
            'bc' => ['file', 'nullable'],
            'admission_photo' => ['image', 'nullable'],
            'latest_photo' => ['image', 'nullable']
        ]);

        if($request->hasFile('csf')){
            $csf = $request->file('csf')->store(options:'s3');
        }

        if($request->hasFile('poe')){
            $poe = $request->file('poe');
        }

        if($request->hasFile('cof')){
            $cof = $request->file('cof')->store(options:'s3');
        }

        if($request->hasFile('cola')){
            $cola = $request->file('cola')->store(options:'s3');
        }

        if($request->hasFile('cfsc')){
            $cfsc = $request->file('cfsc')->store(options:'s3');        }

        if($request->hasFile('bc')){
            $bc = $request->file('bc')->store(options:'s3');        }

        if($request->hasFile('admission_photo')){
            $admission_photo = $request->file('admission_photo')->store(options:'s3');        }

        if($request->hasFile('latest_photo')){
            $latest_photo = $request->file('latest_photo')->store(options:'s3');        }

        // $data = new Children();
        // $data->children_group_id = $request->children_group_id;
        // $data->doa = $request->doa;
        // $data->is_foundling = $request->is_foundling;
        // $data->first_name = $request->first_name;
        // $data->middle_name = $request->middle_name;
        // $data->lastname = $request->last_name;
        // $data->blood_type = $request->blood_type;
        // $data->age = $request->age;
        // $data->height = $request->height;
        // $data->weight = $request->weight;
        // $data->dob = $request->dob;
        // $data->father_name = $request->father_name;
        // $data->mother_name = $request->mother_name;
        // $data->guardian_name = $request->guardian_name;
        // $data->csf = $request->csf;
        // $data->poe = $request->poe;
        // $data->cof = $request->cof;
        // $data->cola = $request->cola;
        // $data->cfsc = $request->cfsc;
        // $data->bc = $request->bc;
        // $data->admission_photo = $request->admission_photo;
        // $data->latest_photo = $request->latest_photo;
        // $data->save();

        Children::create([
            'children_group_id' => $request->children_group_id,
            'doa' => $request->doa,
            'is_foundling' => $request->is_foundling,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'lastname' => $request->lastname,
            'blood_type' => $request->blood_type,
            'age' => $request->age,
            'height' => $request->height,
            'weight' => $request->weight,
            'dob' => $request->dob,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'guardian_name' => $request->guardian_name,
            'csf' => $csf ??= null,
            'poe' => $poe ??= null,
            'cof' => $cof ??= null,
            'cola' => $cola ??= null,
            'cfsc' => $cfsc ??= null,
            'bc' => $bc ??= null,
            'admission_photo' => $admission_photo ??= null,
            'latest_photo' => $latest_photo ??= null
        ]);

        return redirect()->route('children.create')->with('success', 'Record added successfully');
    }

    public function read(){
        $query = Children::with(['childrenGroup'])->where('is_archived', '=', '0')->latest('id')->get();
        $data['children'] = $query;
        return view('admin.children.children-list', $data);
    }
    public function headRead(){
        $query = Children::with(['childrenGroup'])->where('is_archived', '=', '0')->latest('id')->get();
        $data['children'] = $query;
        return view('head.children.list', $data);
    }
    public function staffRead(){
        $query = Children::whereHas('childrenGroup', function(Builder $query){
            $query->where('employee_id','=', Auth::user()->id);
        })->with(['childrenGroup'])
        ->where('is_archived', '=', '0')
        ->latest('id')
        ->get();
        $data['children'] = $query;
        return view('staff.children.list', $data);
    }
    public function staffGroupRead($id){
        $query = Children::with(['childrenGroup'])
        ->where('children_group_id', '=', $id)
        ->where('is_archived', '=', '0')
        ->latest('id')
        ->get();
        $data['children'] = $query;
        return view('staff.children.list-group', $data);
    }

    /**
     * Display the specified resource.
     */
    public function headShow($id)
    {
        $child = DB::table('childrens')->where('id','=', $id)->first();
        $children_groups = ChildrenGroup::all();
        return view('head.children.show')->with('children_groups', $children_groups)->with('child', $child);
    }
    public function staffShow($id)
    {
        $child = DB::table('childrens')->where('id','=', $id)->first();
        $children_groups = ChildrenGroup::all();
        return view('staff.children.show')->with('children_groups', $children_groups)->with('child', $child);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $children = DB::table('childrens')->where('id','=', $id)->first();
        $children_groups = ChildrenGroup::all();
        return view('admin.children.edit-children')->with('children_groups', $children_groups)->with('children', $children);
    }
    public function headEdit($id)
    {
        $children = DB::table('childrens')->where('id','=', $id)->first();
        $children_groups = ChildrenGroup::all();
        return view('head.children.edit')->with('children_groups', $children_groups)->with('children', $children);
    }
    public function staffEdit($id)
    {
        $children = DB::table('childrens')->where('id','=', $id)->first();
        $children_groups = ChildrenGroup::all();
        return view('staff.children.edit')->with('children_groups', $children_groups)->with('children', $children);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Children $children)
    {
        $data = Children::find($request->id);
        $request->validate([
            'children_group_id' => 'integer|nullable',
            'doa' => 'date|nullable',
            'is_foundling' => 'nullable',
            'first_name' => 'string|nullable',
            'middle_name' => 'string|nullable',
            'lastname' => 'string|nullable',
            'blood_type' => 'string|nullable',
            'age' => 'integer|nullable',
            'height' => 'decimal:0,4|nullable',
            'weight' => 'decimal:0,4|nullable',
            'dob' => 'date|nullable',
            'father_name' => 'string|nullable',
            'mother_name' => 'string|nullable',
            'guardian_name' => 'string|nullable',
            'csf' => ['file', 'nullable'],
            'poe' => ['file', 'nullable'],
            'cof' => ['file', 'nullable'],
            'cola' => ['file', 'nullable'],
            'cfsc' => ['file', 'nullable'],
            'bc' => ['file', 'nullable'],
            'admission_photo' => ['image', 'nullable'],
            'latest_photo' => ['image', 'nullable']
        ]);

        if($request->hasFile('csf')){
            $child = Children::findOrFail($request->id);
            if($child->csf != null) {
                Storage::disk('s3')->delete($child->csf);
            }
            $csf = $request->file('csf')->store(options:'s3');
            $data->csf = $csf;
        }

        if($request->hasFile('poe')){
            $child = Children::findOrFail($request->id);
            if($child->poe != null) {
                Storage::disk('s3')->delete($child->poe);
            }
            $poe = $request->file('poe')->store(options:'s3');
            $data->poe = $poe;
        }

        if($request->hasFile('cof')){
            $child = Children::findOrFail($request->id);
            if($child->cof != null) {
                Storage::disk('s3')->delete(paths: $child->cof);
            }
            $cof = $request->file('cof')->store(options:'s3');
            $data->cof = $cof;
        }

        if($request->hasFile('cola')){
            $child = Children::findOrFail($request->id);
            if($child->cola != null) {
                Storage::disk('s3')->delete(paths: $child->cola);
            }
            $cola = $request->file('cola')->store(options:'s3');
            $data->cola = $cola;
        }

        if($request->hasFile('cfsc')){
            $child = Children::findOrFail($request->id);
            if($child->cfsc != null) {
                Storage::disk('s3')->delete($child->cfsc);
            }
            $cfsc = $request->file('cfsc')->store(options:'s3');
            $data->cfsc = $cfsc;
        }

        if($request->hasFile('bc')){
            $child = Children::findOrFail($request->id);
            if($child->bc != null) {
                Storage::disk('s3')->delete($child->bc);
            }
            $bc = $request->file('bc')->store(options:'s3');
            $data->bc = $bc;
        }

        if($request->hasFile('admission_photo')){
            $child = Children::findOrFail($request->id);
            if($child->admission_photo != null) {
                Storage::disk('s3')->delete($child->admission_photo);
            }
            $admission_photo = $request->file('admission_photo')->store(options:'s3');
            $data->admission_photo = $admission_photo;
        }

        if($request->hasFile('latest_photo')){
            $child = Children::findOrFail($request->id);
            if($child->latest_photo != null) {
                Storage::disk('s3')->delete($child->latest_photo);
            }
            $latest_photo = $request->file('latest_photo')->store(options:'s3');
            $data->latest_photo = $latest_photo;
        }

        $data->children_group_id = $request->children_group_id;
        $data->doa = $request->doa;
        $data->is_foundling = $request->is_foundling;
        $data->first_name = $request->first_name;
        $data->middle_name = $request->middle_name;
        $data->lastname = $request->lastname;
        $data->blood_type = $request->blood_type;
        $data->age = $request->age;
        $data->height = $request->height;
        $data->weight = $request->weight;
        $data->dob = $request->dob;
        $data->father_name = $request->father_name;
        $data->mother_name = $request->mother_name;
        $data->guardian_name = $request->guardian_name;
        $data->update();
        return redirect()->route('children.read')->with('success', 'Record updated successfully');
    }

    public function headUpdate(Request $request){
        $data = Children::find($request->id);
        $request->validate([
            'children_group_id' => 'integer|nullable',
            'doa' => 'date|nullable',
            'is_foundling' => 'nullable',
            'first_name' => 'string|nullable',
            'middle_name' => 'string|nullable',
            'lastname' => 'string|nullable',
            'blood_type' => 'string|nullable',
            'age' => 'integer|nullable',
            'height' => 'decimal:0,4|nullable',
            'weight' => 'decimal:0,4|nullable',
            'dob' => 'date|nullable',
            'father_name' => 'string|nullable',
            'mother_name' => 'string|nullable',
            'guardian_name' => 'string|nullable',
            'csf' => ['file', 'nullable'],
            'poe' => ['file', 'nullable'],
            'cof' => ['file', 'nullable'],
            'cola' => ['file', 'nullable'],
            'cfsc' => ['file', 'nullable'],
            'bc' => ['file', 'nullable'],
            'admission_photo' => ['image', 'nullable'],
            'latest_photo' => ['image', 'nullable']
        ]);

        if($request->hasFile('csf')){
            $child = Children::findOrFail($request->id);
            if($child->csf != null) {
                Storage::disk('s3')->delete($child->csf);
            }
            $csf = $request->file('csf')->store(options:'s3');
            $data->csf = $csf;
        }

        if($request->hasFile('poe')){
            $child = Children::findOrFail($request->id);
            if($child->poe != null) {
                Storage::disk('s3')->delete($child->poe);
            }
            $poe = $request->file('poe')->store(options:'s3');
            $data->poe = $poe;
        }

        if($request->hasFile('cof')){
            $child = Children::findOrFail($request->id);
            if($child->cof != null) {
                Storage::disk('s3')->delete(paths: $child->cof);
            }
            $cof = $request->file('cof')->store(options:'s3');
            $data->cof = $cof;
        }

        if($request->hasFile('cola')){
            $child = Children::findOrFail($request->id);
            if($child->cola != null) {
                Storage::disk('s3')->delete(paths: $child->cola);
            }
            $cola = $request->file('cola')->store(options:'s3');
            $data->cola = $cola;
        }

        if($request->hasFile('cfsc')){
            $child = Children::findOrFail($request->id);
            if($child->cfsc != null) {
                Storage::disk('s3')->delete($child->cfsc);
            }
            $cfsc = $request->file('cfsc')->store(options:'s3');
            $data->cfsc = $cfsc;
        }

        if($request->hasFile('bc')){
            $child = Children::findOrFail($request->id);
            if($child->bc != null) {
                Storage::disk('s3')->delete($child->bc);
            }
            $bc = $request->file('bc')->store(options:'s3');
            $data->bc = $bc;
        }

        if($request->hasFile('admission_photo')){
            $child = Children::findOrFail($request->id);
            if($child->admission_photo != null) {
                Storage::disk('s3')->delete($child->admission_photo);
            }
            $admission_photo = $request->file('admission_photo')->store(options:'s3');
            $data->admission_photo = $admission_photo;
        }

        if($request->hasFile('latest_photo')){
            $child = Children::findOrFail($request->id);
            if($child->latest_photo != null) {
                Storage::disk('s3')->delete($child->latest_photo);
            }
            $latest_photo = $request->file('latest_photo')->store(options:'s3');
            $data->latest_photo = $latest_photo;
        }

        $data->children_group_id = $request->children_group_id;
        $data->doa = $request->doa;
        $data->is_foundling = $request->is_foundling;
        $data->first_name = $request->first_name;
        $data->middle_name = $request->middle_name;
        $data->lastname = $request->lastname;
        $data->blood_type = $request->blood_type;
        $data->age = $request->age;
        $data->height = $request->height;
        $data->weight = $request->weight;
        $data->dob = $request->dob;
        $data->father_name = $request->father_name;
        $data->mother_name = $request->mother_name;
        $data->guardian_name = $request->guardian_name;
        $data->update();
        return redirect()->route('head.children.read')->with('success', 'Record updated successfully');

    }
    public function staffUpdate(Request $request){
        $data = Children::find($request->id);
        $request->validate([
            'children_group_id' => 'integer|nullable',
            'doa' => 'date|nullable',
            'is_foundling' => 'nullable',
            'first_name' => 'string|nullable',
            'middle_name' => 'string|nullable',
            'lastname' => 'string|nullable',
            'blood_type' => 'string|nullable',
            'age' => 'integer|nullable',
            'height' => 'decimal:0,4|nullable',
            'weight' => 'decimal:0,4|nullable',
            'dob' => 'date|nullable',
            'father_name' => 'string|nullable',
            'mother_name' => 'string|nullable',
            'guardian_name' => 'string|nullable',
            'csf' => ['file', 'nullable'],
            'poe' => ['file', 'nullable'],
            'cof' => ['file', 'nullable'],
            'cola' => ['file', 'nullable'],
            'cfsc' => ['file', 'nullable'],
            'bc' => ['file', 'nullable'],
            'admission_photo' => ['image', 'nullable'],
            'latest_photo' => ['image', 'nullable']
        ]);

        if($request->hasFile('csf')){
            $child = Children::findOrFail($request->id);
            if($child->csf != null) {
                Storage::disk('s3')->delete($child->csf);
            }
            $csf = $request->file('csf')->store(options:'s3');
            $data->csf = $csf;
        }

        if($request->hasFile('poe')){
            $child = Children::findOrFail($request->id);
            if($child->poe != null) {
                Storage::disk('s3')->delete($child->poe);
            }
            $poe = $request->file('poe')->store(options:'s3');
            $data->poe = $poe;
        }

        if($request->hasFile('cof')){
            $child = Children::findOrFail($request->id);
            if($child->cof != null) {
                Storage::disk('s3')->delete(paths: $child->cof);
            }
            $cof = $request->file('cof')->store(options:'s3');
            $data->cof = $cof;
        }

        if($request->hasFile('cola')){
            $child = Children::findOrFail($request->id);
            if($child->cola != null) {
                Storage::disk('s3')->delete(paths: $child->cola);
            }
            $cola = $request->file('cola')->store(options:'s3');
            $data->cola = $cola;
        }

        if($request->hasFile('cfsc')){
            $child = Children::findOrFail($request->id);
            if($child->cfsc != null) {
                Storage::disk('s3')->delete($child->cfsc);
            }
            $cfsc = $request->file('cfsc')->store(options:'s3');
            $data->cfsc = $cfsc;
        }

        if($request->hasFile('bc')){
            $child = Children::findOrFail($request->id);
            if($child->bc != null) {
                Storage::disk('s3')->delete($child->bc);
            }
            $bc = $request->file('bc')->store(options:'s3');
            $data->bc = $bc;
        }

        if($request->hasFile('admission_photo')){
            $child = Children::findOrFail($request->id);
            if($child->admission_photo != null) {
                Storage::disk('s3')->delete($child->admission_photo);
            }
            $admission_photo = $request->file('admission_photo')->store(options:'s3');
            $data->admission_photo = $admission_photo;
        }

        if($request->hasFile('latest_photo')){
            $child = Children::findOrFail($request->id);
            if($child->latest_photo != null) {
                Storage::disk('s3')->delete($child->latest_photo);
            }
            $latest_photo = $request->file('latest_photo')->store(options:'s3');
            $data->latest_photo = $latest_photo;
        }

        $data->children_group_id = $request->children_group_id;
        $data->doa = $request->doa;
        $data->is_foundling = $request->is_foundling;
        $data->first_name = $request->first_name;
        $data->middle_name = $request->middle_name;
        $data->lastname = $request->lastname;
        $data->blood_type = $request->blood_type;
        $data->age = $request->age;
        $data->height = $request->height;
        $data->weight = $request->weight;
        $data->dob = $request->dob;
        $data->father_name = $request->father_name;
        $data->mother_name = $request->mother_name;
        $data->guardian_name = $request->guardian_name;
        $data->update();
        return redirect()->route('staff.children.read')->with('success', 'Record updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = Children::find($request->id);
        $data->is_archived = 1;
        $data->update();
        return redirect()->route('children.read')->with('success', 'Record archived successfully!');
    }
    public function headDestroy(Request $request)
    {
        $data = Children::find($request->id);
        $data->is_archived = 1;
        $data->update();
        return redirect()->route('head.children.read')->with('success', 'Record archived successfully!');
    }

    public function archives(){
        $query = Children::with(['childrenGroup'])->where('is_archived', '=', '1')->latest('id')->get();
        $data['children'] = $query;
        return view('admin.children.children-archives', $data);
    }
    public function headArchives(){
        $query = Children::with(['childrenGroup'])->where('is_archived', '=', '1')->latest('id')->get();
        $data['children'] = $query;
        return view('head.children.archives', $data);
    }

    public function unarchive(Request $request)
    {
        $data = Children::find($request->id);
        $data->is_archived = 0;
        $data->update();
        return redirect()->route('children.archives')->with('success', 'Record restored successfully!');
    }
    public function headUnarchive(Request $request)
    {
        $data = Children::find($request->id);
        $data->is_archived = 0;
        $data->update();
        return redirect()->route('head.children.archives')->with('success', 'Record restored successfully!');
    }

    public function downloadCsf($id)
    {
        $child = Children::findOrFail($id);
        return Storage::disk('s3')->download($child->csf);
    }
    public function downloadPoe($id)
    {
        $child = Children::findOrFail($id);
        return Storage::disk('s3')->download($child->poe);
    }
    public function downloadCof($id)
    {
        $child = Children::findOrFail($id);
        return Storage::disk('s3')->download($child->cof);
    }
    public function downloadCola($id)
    {
        $child = Children::findOrFail($id);
        return Storage::disk('s3')->download($child->cola);
    }
    public function downloadCfsc($id)
    {
        $child = Children::findOrFail($id);
        return Storage::disk('s3')->download($child->cfsc);
    }
    public function downloadBc($id)
    {
        $child = Children::findOrFail($id);
        return Storage::disk('s3')->download($child->bc);
    }
    public function downloadAdmissionPhoto($id)
    {
        $child = Children::findOrFail($id);
        return Storage::disk('s3')->download($child->admission_photo);
    }
    public function downloadLatestPhoto($id)
    {
        $child = Children::findOrFail($id);
        return Storage::disk('s3')->download($child->latest_photo);
    }
}
