<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
/*SE AGREGAN EM MODELO PATIENTS*/
use App\Patients;

class PatientsController extends Controller
{
    
    public function __construct()
    {
    }

    /*SE PASAN TODOS LOS USARIOS AL INDEX*/
    public function index()
    {
        $patients = Patients::all();
        return view('patients.index',['patients'   =>  $patients]);
    }
   
    /*EL FORM CREATE VA VACIO*/
    public function create()
    {
        return view('patients.create');
    }


   /*SE VALIDAN Y SE GURDAN LOS DATOS*/
    public function store(Request $request)
    {

        //REGLAS DE VALIDACION DE LARAVEL
        $rules = [
            'name' => 'required',
        ];

        //MENSAJES DE LAS VALIDACIONES
        $messages = [
            'name.required' => 'Debe ingresar un nombre',
        ];

        $this->validate($request, $rules, $messages);

        $patient=new Patients();
        $patient->name = $request->input('name') ;
        $patient->save();

        return redirect('/patients')->with('mensaje','Patient registrado exitósamente');
    }
 
    /*SE BUSCAN TODOS LOS DATOS DEL Patient CUYA ID ES RECIBIDA Y SE PASAN AL FORM*/
    public function edit($id)
    {
        $patient = Patients::find($id);
        //print_r($patient);
        //die('edit');
        return view("patients.edit")->with("patient", $patient);
    }
  
    /*SE VALIDAN Y SE GUARDAN LOS DATOS DEL Patient CUYA ID SE RECIVIO*/
    public function update(Request $request, $id)
    {
        //print_r($request);
        //echo ($id);
        //die('edit');
        //REGLAS DE VALIDACION DE LARAVEL
        $rules = [
            'name' => 'required',
        ];

        //MENSAJES DE LAS VALIDACIONES
        $messages = [
             'name.required' => 'Debe ingresar un nombre',
            
        ];

        $this->validate($request, $rules, $messages);

        //SE BUSCA EL PACIENTE Y SE GURDAN LOS DTAOS RECIBIDOS
        $patient = Patients::find($id);
        $patient->name = $request->input('name');
        $patient->save();
        return Redirect::to('/patients');
    }

     /* SE ELIMINA EL PACIENTE CUYA ID ES RECIBIDA*/ 
     public function destroy($id)
    {
        //echo $id;
        //die('llego al metodo destroy');
        $patient = Patients::find($id);
        $patient->delete();
        return Redirect::to('/patients');
        
    }

}

