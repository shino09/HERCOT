<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
/*SE AGREGAN EM MODELO dentists*/
use App\Dentists;

class DentistsController extends Controller
{
    
    public function __construct()
    {
    }

    /*SE PASAN TODOS LOS USARIOS AL INDEX*/
    public function index()
    {
        $dentists = Dentists::all();
        return view('dentists.index',['dentists'   =>  $dentists]);
    }
   
    /*EL FORM CREATE VA VACIO*/
    public function create()
    {
        return view('dentists.create');
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

        $dentist=new Dentists();
        $dentist->name = $request->input('name') ;
        $dentist->save();

        return redirect('/dentists')->with('mensaje','dentist registrado exitósamente');
    }
 
    /*SE BUSCAN TODOS LOS DATOS DEL dentist CUYA ID ES RECIBIDA Y SE PASAN AL FORM*/
    public function edit($id)
    {
        $dentist = Dentists::find($id);
        //print_r($dentist);
        //die('edit');
        return view("dentists.edit")->with("dentist", $dentist);
    }
  
    /*SE VALIDAN Y SE GUARDAN LOS DATOS DEL dentist CUYA ID SE RECIVIO*/
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
        $dentist = Dentists::find($id);
        $dentist->name = $request->input('name');
        $dentist->save();
        return Redirect::to('/dentists');
    }

     /* SE ELIMINA EL PACIENTE CUYA ID ES RECIBIDA*/ 
     public function destroy($id)
    {
        //echo $id;
        //die('llego al metodo destroy');
        $dentist = Dentists::find($id);
        $dentist->delete();
        return Redirect::to('/dentists');
        
    }

}

