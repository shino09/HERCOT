<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
/*SE AGREGAN EM MODELO serviceS*/
use App\Services;

class ServicesController extends Controller
{
    
    public function __construct()
    {
    }

    /*SE PASAN TODOS LOS USARIOS AL INDEX*/
    public function index()
    {
        $services = Services::all();
        return view('services.index',['services'   =>  $services]);
    }
   
    /*EL FORM CREATE VA VACIO*/
    public function create()
    {
        return view('services.create');
    }


   /*SE VALIDAN Y SE GURDAN LOS DATOS*/
    public function store(Request $request)
    {

        //REGLAS DE VALIDACION DE LARAVEL
        $rules = [
            'name' => 'required',
            'price' => 'required',

        ];

        //MENSAJES DE LAS VALIDACIONES
        $messages = [
            'name.required' => 'Debe ingresar un nombre',
            'price.required' => 'Debe ingresar un precio',

        ];

        $this->validate($request, $rules, $messages);

        $service=new Services();
        $service->name = $request->input('name') ;
        $service->price = $request->input('price') ;
        $service->save();

        return redirect('/services')->with('mensaje','service registrado exitósamente');
    }
 
    /*SE BUSCAN TODOS LOS DATOS DEL service CUYA ID ES RECIBIDA Y SE PASAN AL FORM*/
    public function edit($id)
    {
        $service = Services::find($id);
        //print_r($service);
        //die('edit');
        return view("services.edit")->with("service", $service);
    }
  
    /*SE VALIDAN Y SE GUARDAN LOS DATOS DEL service CUYA ID SE RECIVIO*/
    public function update(Request $request, $id)
    {
        //print_r($request);
        //echo ($id);
        //die('edit');
        //REGLAS DE VALIDACION DE LARAVEL
        $rules = [
            'name' => 'required',
            'price' => 'required',

        ];

        //MENSAJES DE LAS VALIDACIONES
        $messages = [
             'name.required' => 'Debe ingresar un nombre',
            'price.required' => 'Debe ingresar un precio',

            
        ];

        $this->validate($request, $rules, $messages);

        //SE BUSCA EL servicio Y SE GURDAN LOS DTAOS RECIBIDOS
        $service = Services::find($id);
        $service->name = $request->input('name');
        $service->price = $request->input('price') ;
        $service->save();
        return Redirect::to('/services');
    }

     /* SE ELIMINA EL servicio CUYA ID ES RECIBIDA*/ 
     public function destroy($id)
    {
        //echo $id;
        //die('llego al metodo destroy');
        $service = Services::find($id);
        $service->delete();
        return Redirect::to('/services');
        
    }

}

