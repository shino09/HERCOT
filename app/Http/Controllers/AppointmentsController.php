<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

/*SE AGREGAN LOS MODELOS NECESARIOS*/
use App\Appointments;
use App\Patients;
use App\Dentists;
use App\Services;


class AppointmentsController extends Controller
{
    public function __construct()
    {
    }

    /*METODO QUE MUESTRA TODAS LAS CITAS SIN REALIZAR NINGUN FILTRO*/
    public function index()
    {
        $appointments = Appointments::all();
        $patients = Patients::all();
        $services = Services::all();
        $dentists = Dentists::all();
        //SE CALCULA LA GANANCIA DE LA SUMA DE TODOS LOS PRECIOS DE LAS CITAS MENOS LA SUMA DE TODOS LOS PRECIOS DE LOS SERVICIOS
        $ganancia= $appointments->sum('price') - $services->sum('price');
        //EN ESTE CASO NO HAY FILTROS
        $appointments_filtradas=NULL;

        //SE ENVIAN LOS DATOS A LA VISTA
        return view('appointments.index',['appointments'   =>  $appointments ,'appointments_filtradas'   =>  $appointments_filtradas , 'patients'   =>  $patients,
            'dentists'   =>  $dentists, 'services'   =>  $services, 'ganancia'   =>  $ganancia]);    
    }

    
    /*METODO ARA MOSTRAR LAS CITAS APLICANDOLE FILTRO DE DOS FECHAS*/
    public function filtrar()
    {
        //SE RECIBEN LAS FECHAS A TRAVEZ DEL FORM ENVIADO POR AJAX
        $fecha_inicio = request()->input('fecha_inicio');
        $fecha_fin = request()->input('fecha_fin');
        //SE DECLARAN TODOS LAS TABLAS A USAR
        $appointments = Appointments::all();
        $patients = Patients::all();
        $services = Services::all();
        $dentists = Dentists::all();
        //SE DECLARA LAS CITAS FILTRADAS
        $appointments_filtradas =NULL;
        //SI AMBAS FECHAS NO SON NULL ENTONCES SE HACE EL FILTRO
        if($fecha_inicio != NULL && $fecha_fin != NULL){
        /*$appointments_filtradas = Appointments::select("appointments.*")
        ->whereBetween('date', [$fecha_inicio, $fecha_fin])
        ->get();*/
        //SE OBTIENEN SOLO LAS CITAS QUE ESTEN ENTRE FECHA INICIO Y FECHA FIN
        $appointments_filtradas=Appointments::where("date",">=",$fecha_inicio)
        ->where("date","<=",$fecha_fin)
        ->get(); 
        //SE REALIZA EL CALCULO DE LAS GANANCIAS SOLO CON LAS CITAS FILTRADAS
        $ganancia= $appointments_filtradas->sum('price') - $services->sum('price');
        //SE DECLARA CITAS SIN FILTRO COMO NULL YA QUE NO SE USARA EN LA NUEVA VISTA, PERO DEBE ESTAR DECLARADA
        $appointments =NULL;
    }
        //SE COMPUREBA QUE HALLA CITAS FILTRADAS Y SE ENVIAN LOS DATOS A LA VISTA TABLE, LA CUAL SOLO MOSTRARA LOS DATOS DE LAS CITAS CON FILTRO DE FECHAS
    if($appointments_filtradas!=NULL && $appointments ==NULL){
        return view('appointments.table',compact('appointments_filtradas','appointments','patients','dentists','services','ganancia'));
    }
}


/*EL FORM CREATE VA VACIO*/
public function create()
{
        //SE DECLARAN TODOS LAS TABLAS A USAR
    $appointments = Appointments::all();
    $patients = Patients::all();
    $services = Services::all();
    $dentists = Dentists::all();
        //SE ENVIAN A LA VISTA CREATE DONDE ESTA EL FORMULARIO
    return view('appointments.create',['appointments'   =>  $appointments , 'patients'   =>  $patients,
        'dentists'   =>  $dentists, 'services'   =>  $services]);
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

        //SI LAS VALIDACIONES NO DAN ERROR SE GUARDAN LOS DATOS RECIBIDOS DEL FORMULARIO PARA CERAR
    $appointment=new Appointments();
    $appointment->date = $request->input('date') ;
    $appointment->price = $request->input('price') ;
    $appointment->dentist_id = $request->input('dentist_id') ;
    $appointment->patient_id = $request->input('patient_id') ;
    $appointment->service_id = $request->input('service_id') ;
    $appointment->save();
        //SE REDIRIGE AL INDEX
    return redirect('/appointments')->with('mensaje','appointment registrado exitósamente');
}

/*SE BUSCAN TODOS LOS DATOS DEL appointment CUYA ID ES RECIBIDA Y SE PASAN AL FORM*/
public function edit($id)
{
        //SE DECLARAN TODOS LAS TABLAS A USAR
    $appointments = Appointments::find($id);
    $patients = Patients::all();
    $services = Services::all();
    $dentists = Dentists::all();
        //SE ENVIAN A LA VISTA CREATE DONDE ESTA EL FORMULARIO PARA EDITAR
    return view('appointments.edit',['appointments'   =>  $appointments , 'patients'   =>  $patients,
        'dentists'   =>  $dentists, 'services'   =>  $services]);
}

/*SE VALIDAN Y SE GUARDAN LOS DATOS DEL appointment CUYA ID SE RECIVIO*/
public function update(Request $request, $id)
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

        //SE BUSCA EL CITA Y SE GURDAN LOS DTAOS RECIBIDOS
   $appointment = Appointments::find($id);
   $appointment->date = $request->input('date');
   $appointment->price = $request->input('price') ;
   $appointment->dentist_id = $request->input('dentist_id') ;
   $appointment->patient_id = $request->input('patient_id') ;
   $appointment->service_id = $request->input('service_id') ;
   $appointment->save();
        //SE REDIRIGE AL INDEX
   return Redirect::to('/appointments');
}

/* SE ELIMINA EL CITA CUYA ID ES RECIBIDA*/ 
public function destroy($id)
{
        //SE BUSCA LA CITA POR LA ID RECIBIDA Y SE ELIMINA DE LA BD
    $appointment = Appointments::find($id);
    $appointment->delete();
    return Redirect::to('/appointments');
    
}

}

