<?php

namespace App\Http\Controllers;

use App\Models\MedicalAppointment;
use App\Models\Children;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MedicalAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = MedicalAppointment::with(['children'])->latest('created_at')->get();
        $data['appointments'] = $query;
        return view('admin.medical-appointments.appointments', $data);
        // $user = Auth::user();
        // if(Auth::check()) { $user = Auth::user()->id; } else { $user = Auth::user(); }
        // dd(Auth::check());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['children'] = Children::whereHas('childrenGroup', function(Builder $query){
            $query->where('employee_id','=', Auth::user()->id);
        })->with(['childrenGroup'])
        ->where('is_archived', '=', '0')
        ->latest('id')
        ->get();
        return view('admin.medical-appointments.create', $data);
    }
    public function staffAcreate()
    {
        $data['children'] = Children::whereHas('childrenGroup', function(Builder $query){
            $query->where('employee_id','=', Auth::user()->id);
        })->with(['childrenGroup'])
        ->where('is_archived', '=', '0')
        ->latest('id')
        ->get();
        return view('staff.appointments.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required',
            'child_id' => 'nullable',
            'title' => 'string|required',
            'details' => 'string|nullable'
        ]);

        $appointment = new MedicalAppointment();
        $appointment->appointment_date = $request->appointment_date;
        $appointment->child_id = $request->child_id;
        // $appointment->employee_id = $request->user()->id;
        $appointment->title = $request->title;
        $appointment->details = $request->details;
        $appointment->employee_id = Auth::user()->id;
        $appointment->save();

        return redirect()->route('medical-appointments.create')->with('success', 'Appointment created successfully!');
    }
    public function staffAstore(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required',
            'child_id' => 'nullable',
            'title' => 'string|required',
            'details' => 'string|nullable'
        ]);

        $appointment = new MedicalAppointment();
        $appointment->appointment_date = $request->appointment_date;
        $appointment->child_id = $request->child_id;
        // $appointment->employee_id = $request->user()->id;
        $appointment->title = $request->title;
        $appointment->details = $request->details;
        $appointment->employee_id = Auth::user()->id;
        $appointment->save();

        return redirect()->route('staff.appointments.create')->with('success', 'Appointment created successfully!');
    }

    public function staffAread()
    {
        $query = MedicalAppointment::with(['children'])->where('employee_id', '=', Auth::user()->id)->latest('id')->get();
        $data['appointments'] = $query;
        return view('staff.appointments.list', $data);
        // $user = Auth::user();
        // if(Auth::check()) { $user = Auth::user()->id; } else { $user = Auth::user(); }
        // dd(Auth::check());
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalAppointment $medicalAppointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['appointment'] = MedicalAppointment::find($id);
        $data['children'] = Children::all();
        return view('admin.medical-appointments.edit', $data);

    }
    public function staffAedit(string $id)
    {
        $data['appointment'] = MedicalAppointment::find($id);
        $data['children'] = Children::whereHas('childrenGroup', function(Builder $query){
            $query->where('employee_id','=', Auth::user()->id);
        })->with(['childrenGroup'])
        ->where('is_archived', '=', '0')
        ->latest('id')
        ->get();
        return view('staff.appointments.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required',
            'child_id' => 'nullable',
            'title' => 'string|required',
            'details' => 'string|nullable'
        ]);

        $appointment = MedicalAppointment::find($request->id);
        $appointment->appointment_date = $request->appointment_date;
        $appointment->child_id = $request->child_id;
        // $appointment->employee_id = $request->user()->id;
        $appointment->title = $request->title;
        $appointment->details = $request->details;
        $appointment->employee_id = Auth::user()->id;
        $appointment->update();

        return redirect()->route('medical-appointments.index')->with('success', 'Appointment updated successfully!');

    }
    public function staffAupdate(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required',
            'child_id' => 'nullable',
            'title' => 'string|required',
            'details' => 'string|nullable'
        ]);

        $appointment = MedicalAppointment::find($request->id);
        $appointment->appointment_date = $request->appointment_date;
        $appointment->child_id = $request->child_id;
        // $appointment->employee_id = $request->user()->id;
        $appointment->title = $request->title;
        $appointment->details = $request->details;
        $appointment->employee_id = Auth::user()->id;
        $appointment->update();

        return redirect()->route('staff.appointments.read')->with('success', 'Appointment updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalAppointment $medicalAppointment)
    {
        $appointment = MedicalAppointment::find($medicalAppointment->id);
        $appointment->delete();

        return redirect()->route('medical-appointments.index')->with('success', 'Appointment deleted successfully');
    }
    public function staffAdelete($id)
    {
        $appointment = MedicalAppointment::find($id);
        $appointment->delete();

        return redirect()->route('staff.appointments.read')->with('success', 'Appointment deleted successfully');
    }
}
