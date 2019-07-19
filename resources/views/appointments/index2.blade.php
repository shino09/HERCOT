        <!-- JS Y CCS QUE SE USARAN , BOOTSTRAP JQUERY Y DATABLES-->

        <link href="{!! asset('bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
        <link href="{!! asset('datatables.net-bs/css/dataTables.bootstrap.min.css') !!}" rel="stylesheet">

        <script src="{{ asset('jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('datatables.net-bs/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>


        <!-- SE DIBUJA LA TABLA CON LOS DATOS DE LOS CITAS-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary col-xs-10">
                    <!-- BOTON PARA AGREGAR UN NUEVO CITA-->
                    <a href="{{ route('appointments.create') }}" class="btn  btn-success">CREAR NUEVO CITA</a>
                    <a href="{{ route('patients.index') }}" class="btn  btn-default">PACIENTES</a>
                    <a href="{{ route('dentists.index') }}" class="btn  btn-default">DENTISTAS</a>
                    <a href="{{ route('services.index') }}" class="btn  btn-default">SERVICIOS</a>
                <form class="form-horizontal" method="POST" action="{{ route('appointments.index2') }}">
              {{ csrf_field() }}
                                {{ method_field('PUT') }}
               <div class="form-group">
                  <label class="control-label col-sm-2" for="date">Date:</label>
                  <div class="col-sm-3">
                        <input type="text" class="date form-control" name="date">
                      @if ($errors->has('date'))
                      <span class="help-block">
                        <p style="color: red; text-align: center">{{ $errors->first('date') }}</p>
                    </span>
                    @endif
                </div>
                   <label class="control-label col-sm-2" for="date">Date:</label>
                  <div class="col-sm-3">
                        <input type="text" class="date form-control" name="date">
                      @if ($errors->has('date'))
                      <span class="help-block">
                        <p style="color: red; text-align: center">{{ $errors->first('date') }}</p>
                    </span>
                    @endif
                </div>
                  <button type="submit" class="btn btn-primary" name="envio">Filtar</button>
                  <a href="{{ route('appointments.index') }}" class="btn  btn-danger">Cancelar</a>
              </a>
            </div>
            </form>
                    <div class="box-header">
                        <h3 class="box-title">Lista de CITAs</h3>
                    </div>
                    <div class="box-body">
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


            <!-- CONVERTIR MI TABLA  EN  UNA DATATABLE PARA TENER BUSQUEDA, ORDENAMIENTO Y PAGINACION-->
            <script type="text/javascript">
                $(function () {
                //SE EJECUTA DATATABLE PARA LA TABLA DE ID CITA
                $('#appointments').DataTable()

            })
        </script>
