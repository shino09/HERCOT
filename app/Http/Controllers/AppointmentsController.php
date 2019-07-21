<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
/*SE AGREGAN EM MODELO appointmentS*/
use App\Appointments;
use App\Patients;
use App\Dentists;
use App\Services;


class AppointmentsController extends Controller
{
    
    public function __construct()
    {
    }

    /*SE PASAN TODOS LOS USARIOS AL INDEX*/
    public function index()
    {
        $appointments = Appointments::all();
        $patients = Patients::all();
        $services = Services::all();
        $dentists = Dentists::all();
        $ganancia= $appointments->sum('price') - $services->sum('price');
        $appointments_filtradas=NULL;

        return view('appointments.index',['appointments'   =>  $appointments ,'appointments_filtradas'   =>  $appointments_filtradas , 'patients'   =>  $patients,
            'dentists'   =>  $dentists, 'services'   =>  $services, 'ganancia'   =>  $ganancia]);    
    }

        public function ajaxRequest()

    {

        return view('ajaxRequest');

    }

   
    //metodo para realizar el filtro de fechas en proceso
    public function index2()
    {
        //die('llego a index2');
        //echo $fecha_inicio;
        //echo $fecha_fin;
        //die();
        $fecha_inicio = request()->input('fecha_inicio');
        $fecha_fin = request()->input('fecha_fin');
        //echo $fecha_inicio;
        //echo $fecha_fin;
        //die('index2');
        $appointments = Appointments::all();
        $patients = Patients::all();
        $services = Services::all();
        $dentists = Dentists::all();
        $ganancia= $appointments->sum('price') - $services->sum('price');
        $appointments_filtradas =NULL;
        if($fecha_inicio != NULL && $fecha_fin != NULL){
        //$appointments_filtradas = Appointments::select("appointments.*")
        //->whereBetween('date', [$fecha_inicio, $fecha_fin])
        //->get();
        $appointments_filtradas=Appointments::where("date",">=",$fecha_inicio)
             ->where("date","<=",$fecha_fin)
             ->get(); 
             
        $ganancia= $appointments_filtradas->sum('price') - $services->sum('price');

        $appointments =NULL;
        }
        //print_r($appointments_filtradas);
        //dd($appointments_filtradas);
        //die('dsd');
        if($appointments_filtradas!=NULL && $appointments ==NULL){
        return view('appointments.table',compact('appointments_filtradas','appointments','patients','dentists','services','ganancia'));
        }
    }

   
    /*EL FORM CREATE VA VACIO*/
    public function create()
    {
        $appointments = Appointments::all();
        $patients = Patients::all();
        $services = Services::all();
        $dentists = Dentists::all();

        return view('appointments.create',['appointments'   =>  $appointments , 'patients'   =>  $patients,
            'dentists'   =>  $dentists, 'services'   =>  $services]);
        //return view('appointments.create');
    }


   /*SE VALIDAN Y SE GURDAN LOS DATOS*/
    public function store(Request $request)
    {

        //REGLAS DE VALIDACION DE LARAVEL
        $rules = [
            'date' => 'required',
            'price' => 'required',
            'dentist_id' => 'required',
            'patient_id' => 'required',
            'service_id' => 'required',

        ];

        //MENSAJES DE LAS VALIDACIONES
        $messages = [
            'date.required' => 'Debe ingresar una fecha',
            'price.required' => 'Debe ingresar un precio',
            'patient_id.required' => 'Debe ingresar un paciente',
            'dentist_id.required' => 'Debe ingresar un dentista',
            'service_id.required' => 'Debe ingresar un servicio',

        ];

        $this->validate($request, $rules, $messages);

        $appointment=new Appointments();
        $appointment->date = $request->input('date') ;
        $appointment->price = $request->input('price') ;
        $appointment->dentist_id = $request->input('dentist_id') ;
        $appointment->patient_id = $request->input('patient_id') ;
        $appointment->service_id = $request->input('service_id') ;
        $appointment->save();

        return redirect('/appointments')->with('mensaje','appointment registrado exitósamente');
    }
 
    /*SE BUSCAN TODOS LOS DATOS DEL appointment CUYA ID ES RECIBIDA Y SE PASAN AL FORM*/
    public function edit($id)
    {
        $appointments = Appointments::find($id);
        $patients = Patients::all();
        $services = Services::all();
        $dentists = Dentists::all();

        return view('appointments.edit',['appointments'   =>  $appointments , 'patients'   =>  $patients,
            'dentists'   =>  $dentists, 'services'   =>  $services]);
    }
  
    /*SE VALIDAN Y SE GUARDAN LOS DATOS DEL appointment CUYA ID SE RECIVIO*/
    public function update(Request $request, $id)
    {
        //print_r($request);
        //echo ($id);
        //die('edit');
        //REGLAS DE VALIDACION DE LARAVEL
        $rules = [
            'date' => 'required',
            'price' => 'required',
            'dentist_id' => 'required',
            'patient_id' => 'required',
            'service_id' => 'required',
        ];

        //MENSAJES DE LAS VALIDACIONES
        $messages = [
             'date.required' => 'Debe ingresar una fecha',
             'price.required' => 'Debe ingresar un precio',
            'patient_id.required' => 'Debe ingresar un paciente',
            'dentist_id.required' => 'Debe ingresar un dentista',
            'service_id.required' => 'Debe ingresar un servicio',
            
        ];

        $this->validate($request, $rules, $messages);

        //SE BUSCA EL CITA Y SE GURDAN LOS DTAOS RECIBIDOS
        $appointment = Appointments::find($id);
        $appointment->date = $request->input('date');
        $appointment->price = $request->input('price') ;
        $appointment->dentist_id = $request->input('dentist_id') ;
        $appointment->patient_id = $request->input('patient_id') ;
        $appointment->service_id = $request->input('service_id') ;
        $appointment->save();
        return Redirect::to('/appointments');
    }

     /* SE ELIMINA EL CITA CUYA ID ES RECIBIDA*/ 
     public function destroy($id)
    {
        //echo $id;
        //die('llego al metodo destroy');
        $appointment = Appointments::find($id);
        $appointment->delete();
        return Redirect::to('/appointments');
        
    }

}

