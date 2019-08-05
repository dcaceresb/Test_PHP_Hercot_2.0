<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Dentist;
use App\Service;
use App\Patient;
use App\Http\Requests\AppointmentRequest;
use DB;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    
    public function save(AppointmentRequest $request, $id)
    {
        if($id!=0)
        {
            $Appointment = Appointment::find($id);
        }
        else
        {
            $Appointment = new Appointment;
        }
        $Appointment->date = $request->date;
        $Appointment->price = str_replace(".","",$request->price);
        $Appointment->dentist_id = $request->dentist_id;
        $Appointment->patient_id = $request->patient_id;
        $Appointment->service_id = $request->service_id;
        $Appointment->save();
    }

    public function filteredTableApi($initialDate, $finalDate)
    {
        $appointments = DB::table('Appointments')
        ->join('Dentists', 'Appointments.dentist_id', '=', 'Dentists.id')
        ->join('Services', 'Appointments.service_id', '=', 'Services.id')
        ->join('Patients', 'Appointments.patient_id', '=', 'Patients.id')
        ->select('Appointments.*', 'Dentists.name as dentist_name', 'Services.name as service_name','Services.price as service_price','Patients.name as patient_name')
        ->whereBetween('date',array($initialDate,$finalDate) )
        ->get();
        
        return $appointments;
    }

    public function tableApi()
    {
        $appointments = DB::table('Appointments')
        ->join('Dentists', 'Appointments.dentist_id', '=', 'Dentists.id')
        ->join('Services', 'Appointments.service_id', '=', 'Services.id')
        ->join('Patients', 'Appointments.patient_id', '=', 'Patients.id')
        ->select('Appointments.*', 'Dentists.name as dentist_name', 'Services.name as service_name','Services.price as service_price','Patients.name as patient_name')
        ->orderBy('date','asc')
        ->get();
                        
        return $appointments;
    }

    public function index()
    {
        return view('Appointment.Index');
    }

    public function create()
    {
        $dentists = Dentist::orderBy('id','ASC')->paginate();
        $services = Service::orderBy('id','ASC')->paginate();
        $patients = Patient::orderBy('id','ASC')->paginate();
        
        return view("Appointment.Create",compact('dentists','services','patients'));
    }

    public function store(AppointmentRequest $request)
    {

        $this->save($request,0);
        return view("Appointment.Index" )->with('info','La cita ha sido Guardada');
    }

    
    public function show(Appointment $appointment)
    {
        //
    }

    
    public function edit($id)
    {
        $dentists = Dentist::orderBy('id','ASC')->paginate();
        $services = Service::orderBy('id','ASC')->paginate();
        $patients = Patient::orderBy('id','ASC')->paginate();

        $Appointment = Appointment::find($id);
        return view ("Appointment.Edit",compact('Appointment','dentists','services','patients'));
    }

    
    public function update(AppointmentRequest $request, $id)
    {
        $this->save($request, $id);
        return view("Appointment.Index" )->with('info','La cita ha sido Guardada');
    }

    public function destroy(Request $request)
    {
        $appointment = Appointment::destroy($request->id);

        return $appointment;
    }
}
