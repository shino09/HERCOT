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


class AppointmentsFiltroController extends Controller
{
    
    public function __construct()
    {
    }

  

   
    //metodo para realizar el filtro de fechas en proceso
    public function index()
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
        //echo $ganancia;
        $appointments_filtradas = Appointments::select("appointments.*")
        ->whereBetween('date', [$fecha_inicio, $fecha_fin])
        ->get();
        //print_r($appointments_filtradas);
        //dd($appointments_filtradas);
        //die('dsd');
        if($appointments_filtradas==NULL){
            return view('appointmentsFiltro.index',['appointments'   =>  $appointments , 'patients'   =>  $patients,
            'dentists'   =>  $dentists, 'services'   =>  $services, 'ganancia'   =>  $ganancia]);    
        }
         else{
         
 return view('appointmentsFiltro.index',['appointments'   =>  $appointments_filtradas , 'patients'   =>  $patients,
            'dentists'   =>  $dentists, 'services'   =>  $services, 'ganancia'   =>  $ganancia]);
        }
    }


   
    public function create()
    {
      
    }


    public function store(Request $request)
    {

      
    }
 
    public function edit($id)
    {
    }
  
    public function update(Request $request, $id)
    {
     
    }

     public function destroy($id)
    {
      
    }

}

