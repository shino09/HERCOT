        <!-- JS Y CCS QUE SE USARAN , BOOTSTRAP JQUERY Y DATABLES-->

        <link href="{!! asset('bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
        <link href="{!! asset('datatables.net-bs/css/dataTables.bootstrap.min.css') !!}" rel="stylesheet">
        <link href="{!! asset('bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}" rel="stylesheet">

      
        <script src="{{ asset('jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
          <script src="{{ asset('bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('datatables.net-bs/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- SE DIBUJA LA TABLA CON LOS DATOS DE LOS CITAS-->
        <div class="row">
            <div class="col-xs-12">
                   
                <div class="box box-primary col-xs-10">
                    <!-- BOTON PARA AGREGAR UN NUEVO CITA-->
                    <a href="{{ route('appointments.create') }}" class="btn  btn-success">CREAR NUEVO CITA</a>
                    <a href="{{ route('patients.index') }}" class="btn  btn-default">PACIENTES</a>
                    <a href="{{ route('dentists.index') }}" class="btn  btn-default">DENTISTAS</a>
                    <a href="{{ route('services.index') }}" class="btn  btn-default">SERVICIOS</a>

                    <!-- FILTAR POR RANGO DE FECHAS EN PROCESO -->
                     <!--   <form class="form-horizontal" method="POST" action="{{ route('appointments.index') }}">
              {{ csrf_field() }}
                                {{ method_field('PUT') }}

               <div class="form-group">
                  <label class="control-label col-sm-2" for="fecha_inicio">Fecha inicio:</label>
                  <div class="col-sm-3">
                        <input type="text" class="date form-control" id="fecha_inicio" name="fecha_inicio">
                      @if ($errors->has('fecha_inicio'))
                      <span class="help-block">
                        <p style="color: red; text-align: center">{{ $errors->first('fecha_inicio') }}</p>
                    </span>
                    @endif
                </div>
                   <label class="control-label col-sm-2" for="fecha_fin">fecha fin:</label>
                  <div class="col-sm-3">
                        <input type="text" class="date form-control" id="fecha_fin"name="fecha_fin">
                      @if ($errors->has('fecha_fin'))
                      <span class="help-block">
                        <p style="color: red; text-align: center">{{ $errors->first('fecha_fin') }}</p>
                    </span>
                    @endif
                </div>
                  <button type="submit" class="btn btn-primary" name="envio">Filtar</button>
                  <a href="{{ route('appointments.index') }}" class="btn  btn-danger">Cancelar</a>
              </a>
            </div>
            </form>-->

            <form >

            <label class="control-label col-sm-2" for="fecha_inicio">Fecha inicio:</label>
                  <div class="col-sm-3">
                        <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="fecha inicio" required="">
                      @if ($errors->has('fecha_inicio'))
                      <span class="help-block">
                        <p style="color: red; text-align: center">{{ $errors->first('fecha_inicio') }}</p>
                    </span>
                    @endif
                </div>

                 <label class="control-label col-sm-2" for="fecha_fin">fecha fin:</label>
                  <div class="col-sm-3">
                        <input type="text" class="form-control" id="fecha_fin"name="fecha_fin" placeholder="fecha fin" required="">
                      @if ($errors->has('fecha_fin'))
                      <span class="help-block">
                        <p style="color: red; text-align: center">{{ $errors->first('fecha_fin') }}</p>
                    </span>
                    @endif
                </div>
                <!--<input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">-->



            <div class="form-group">

                <button class="btn btn-success btn-submit">Filtrar entre 2 fechas</button>

            </div>

        </form>

                    <div class="box-header">
                        <h3 class="box-title">Lista de CITAs</h3>
                    </div>
                    <div class="box-body">
                          <div id='confiltro' name="confiltro" class="confiltro">
                                </div>

                     <div id='sinfiltro' name="sinfiltro" class="sinfiltro">

                        @if(count($appointments)>0)
                        <table id="appointments" class="table table-bordered table-hover">

                            <!-- CABEZERA DE LA TABLA-->
                            <thead>
                                <tr>
                                    <!--<th>Id</th>-->
                                    <th>Fecha Consulta</th>
                                    <th>Precio</th> 
                                    <th>Paciente</th> 
                                    <th>Medico</th> 
                                    <th>Servicio</th> 
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>

                            <!-- CONTENIDO DE LA TABLA-->
                                @foreach($appointments as $apt)
                                <tr>
                                    <!--<td>{{$apt->id}}</td>-->
                                    <td>{{$apt->date}}</td>
                                    <td>{{$apt->price}}</td>

                                    @foreach($patients as $pat)
                                    @if($apt->patient_id == $pat->id)
                                    <td>{{$pat->name}}</td>
                                    @endif
                                    @endforeach
                                    

                                 
                                    @foreach($dentists as $den)
                                    @if($apt->dentist_id == $den->id)
                                    <td>{{$den->name}}</td>
                                    @endif
                                    @endforeach


                                    @foreach($services as $ser)
                                    @if($apt->service_id == $ser->id)
                                    <td>{{$ser->name}}</td>
                                    @endif
                                    @endforeach




                                    <!-- SE LLAMA AL METOO EDIT CON LA ID DEL CITA-->
                                    <td>
                                        <a href="{{ route('appointments.edit',$apt->id) }}" class="btn  btn-warning glyphicon glyphicon-pencil">              
                                    </td>

                                        <!-- SE LLAMA AL METODO DESTROY PARA LA ELIMINACION DEL CITA-->
                                        <td>
                                            <form action="{{ url('/appointments', ['id' => $apt->id]) }}" method="post">
                                                <button type="submit" class="btn btn-danger glyphicon glyphicon-trash"   onclick="return confirm('¿Esta seguro que desea eliminar este registro?')"></button>
                                                {!! method_field('delete') !!}
                                                {!! csrf_field() !!}
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           
                            <h1> GANANCIA TOTAL: <?php echo $ganancia;?>$ .

                            <!-- SI NO HAY CITAS SE MUESTRA UN MENSAJE-->
                            @else
                            <br/>
                                <div class='alert alert-warning'>
                                    <label>No existe ningún CITA dentro de la lista</label>
                                </div>
                            @endif
                                                    </div>


                        </div>
                    </div>
                </div>
            </div>
        


            <!-- CONVERTIR MI TABLA  EN  UNA DATATABLE PARA TENER BUSQUEDA, ORDENAMIENTO Y PAGINACION-->
            <script type="text/javascript">
                $(function () {
                //SE EJECUTA DATATABLE PARA LA TABLA DE ID CITA
                $('#appointments').DataTable()

            })
        </script>

     

<script>

 


$().ready(function() {

$("#fecha_inicio").datepicker({
    changeMonth: true,
    changeYear: true,
    //dateFormat: "dd-mm-yy",
format: 'dd-mm-yyyy',

    yearRange: "2010:2030",
    onSelect: function(dateText, inst) { 
    $("#fecha_inicio_value").val(dateText);
    }
});




$("#fecha_fin").datepicker({
    changeMonth: true,
    changeYear: true,
format: 'dd-mm-yyyy',
    yearRange: "2010:2030",
    onSelect: function(dateText, inst) { 
    $("#fecha_fin_value").val(dateText);
    }
});


});

</script>

<script type="text/javascript">



    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });



    $(".btn-submit").click(function(e){

        e.preventDefault();



        var fecha_inicio = $("input[name=fecha_inicio]").val();

        var fecha_fin = $("input[name=fecha_fin]").val();
         



        if (fecha_inicio == '' || fecha_fin == ''){
            alert('por favor asegurece de ingresar  una fecha de inico y una fecha de fin');
        }
        else{
             if(validate_fechaMayorQue(fecha_inicio,fecha_fin))
        {
             $.ajax({

           type:'POST',
           url:'index2',
           data:{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin },

           success:function(data){

    $('#confiltro').html(data);
    let sinfiltro = document.querySelector('#sinfiltro');
            sinfiltro.style.visibility = 'visible';
                if(sinfiltro.style.visibility === 'visible'){
                    sinfiltro.style.visibility = 'hidden';
                }else{
                    sinfiltro.style.visibility = 'visible';
                }
           }


        });

}

        else{
        alert("La fecha de fin: "+fecha_fin+" no es superior a la fecha de inicio: "+fecha_inicio);

        }
      
}
     });




      function validate_fechaMayorQue(fechaInicial,fechaFinal)
        {
            valuesStart=fechaInicial.split("-");
            valuesEnd=fechaFinal.split("-");
 
            // Verificamos que la fecha no sea posterior a la actual
            var dateStart=new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
            var dateEnd=new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);
            if(dateStart>=dateEnd)
            {
                return 0;
            }
            return 1;
        }

</script>
