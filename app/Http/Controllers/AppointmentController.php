<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Dentist;
use App\Service;
use App\Patient;
use DB;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTable()
    {
        $appointments = DB::table('Appointments')
                        ->join('Dentists', 'Appointments.dentist_id', '=', 'Dentists.id')
                        ->join('Services', 'Appointments.service_id', '=', 'Services.id')
                        ->join('Patients', 'Appointments.patient_id', '=', 'Patients.id')
                        ->select('Appointments.*', 'Dentists.name as dentist_name', 'Services.name as service_name','Services.price as service_price','Patients.name as patient_name')
                        ->paginate();
                        
        return $appointments;
    }

    public function filteredTableApi($initialDate, $finalDate)
    {
        $appointments = DB::table('Appointments')
        ->join('Dentists', 'Appointments.dentist_id', '=', 'Dentists.id')
        ->join('Services', 'Appointments.service_id', '=', 'Services.id')
        ->join('Patients', 'Appointments.patient_id', '=', 'Patients.id')
        ->select('Appointments.*', 'Dentists.name as dentist_name', 'Services.name as service_name','Services.price as service_price','Patients.name as patient_name')
        ->whereBetween('date',array($initialDate,$finalDate) )
        ->paginate();
        
        return $appointments;
    }
    public function tableApi()
    {
        return $this->getTable();
    }

    public function index()
    {
        return view('Appointment.Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
