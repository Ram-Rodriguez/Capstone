<?php

namespace App\Http\Controllers;

use App\Models\CourtAppointment;
use App\Models\Children;
use Auth;
use Illuminate\Http\Request;

class CourtAppointmentController extends Controller
{
    // public function __construct(){
    //     $this->middleware("admin.auth");
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = CourtAppointment::with(['children', 'employee'])->latest('id')->get();
        $data['appointments'] = $query;
        return view('admin.court-appointments.appointments', $data);
        // $user = Auth::user();
        // if(Auth::check()) { $user = Auth::user()->id; } else { $user = Auth::user(); }
        // dd(Auth::check());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['children'] = Children::all();
        return view('admin.court-appointments.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required',
            'child_id' => 'nullable',
            'employee_id' => 'nullable',
            'title' => 'string|required',
            'details' => 'string|nullable',
            'csf' => 'nullable',
            'poe' => 'nullable',
            'cola' => 'nullable',
            'cfsc' => 'nullable',
            'bc' => 'nullable',
            'admission_photo' => 'nullable',
            'latest_photo' => 'nullable',
        ]);

        $appointment = new CourtAppointment();
        $appointment->appointment_date = $request->appointment_date;
        $appointment->child_id = $request->child_id;
        // $appointment->employee_id = $request->user()->id;
        $appointment->title = $request->title;
        $appointment->details = $request->details;
        $appointment->csf = $request->csf;
        $appointment->poe = $request->poe;
        $appointment->cof = $request->cof;
        $appointment->cola = $request->cola;
        $appointment->cfsc = $request->cfsc;
        $appointment->bc = $request->bc;
        $appointment->admission_photo = $request->admission_photo;
        $appointment->latest_photo = $request->latest_photo;
        $appointment->save();

        return redirect()->route('court-appointments.create')->with('success', 'Appointment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CourtAppointment $courtAppointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['appointment'] = CourtAppointment::find($id);
        $data['children'] = Children::all();
        return view('admin.court-appointments.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required',
            'child_id' => 'nullable',
            'employee_id' => 'nullable',
            'title' => 'string|required',
            'details' => 'string|nullable',
            'csf' => 'nullable',
            'poe' => 'nullable',
            'cola' => 'nullable',
            'cfsc' => 'nullable',
            'bc' => 'nullable',
            'admission_photo' => 'nullable',
            'latest_photo' => 'nullable',
        ]);

        $appointment = CourtAppointment::find($request->id);
        $appointment->appointment_date = $request->appointment_date;
        $appointment->child_id = $request->child_id;
        // $appointment->employee_id = $request->user()->id;
        $appointment->title = $request->title;
        $appointment->details = $request->details;
        $appointment->csf = $request->csf;
        $appointment->poe = $request->poe;
        $appointment->cof = $request->cof;
        $appointment->cola = $request->cola;
        $appointment->cfsc = $request->cfsc;
        $appointment->bc = $request->bc;
        $appointment->admission_photo = $request->admission_photo;
        $appointment->latest_photo = $request->latest_photo;
        $appointment->update();

        return redirect()->route('court-appointments.index')->with('success', 'Appointment updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourtAppointment $courtAppointment)
    {
        $appointment = CourtAppointment::find($courtAppointment->id);
        $appointment->delete();

        return redirect()->route('court-appointments.index')->with('success', 'Appointment deleted successfully');
    }
}
