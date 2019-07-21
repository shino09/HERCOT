        <!-- JS Y CCS QUE SE USARAN , BOOTSTRAP JQUERY Y DATABLES-->

        <link href="{!! asset('bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
        <link href="{!! asset('datatables.net-bs/css/dataTables.bootstrap.min.css') !!}" rel="stylesheet">

        <script src="{{ asset('jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('datatables.net-bs/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>


        <!-- SE DIBUJA LA TABLA CON LOS DATOS DE LOS PACIENTES-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary col-xs-10">
                    <!-- BOTON PARA AGREGAR UN NUEVO PACIENTE-->
                    <a href="{{ route('appointments.index') }}" class="btn  btn-default">LISTADO DE CITAS</a>
                    <a href="{{ route('patients.index') }}" class="btn  btn-default">PACIENTES</a>
                    <a href="{{ route('dentists.index') }}" class="btn  btn-default">DENTISTAS</a>
                    <a href="{{ route('services.index') }}" class="btn  btn-default">SERVICIOS</a>
                    <div>                    <a href="{{ route('patients.create') }}" class="btn  btn-success">CREAR NUEVO PACIENTE</a>
                    </div>
                    <div class="box-header">
                        <h3 class="box-title">Lista de pacientes</h3>
                    </div>
                    <!--MOSTAR LISTADO EN LA TABLA Y APLICARLE DATATABLES-->
                    <div class="box-body">
                        @if(count($patients)>0)
                        <table id="patients" class="table table-bordered table-hover">

                            <!-- CABEZERA DE LA TABLA-->
                            <thead>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- CONTENIDO DE LA TABLA-->
                                @foreach($patients as $pat)
                                <tr>
                                    <td>{{$pat->name}}</td>
                                    

                                    <!-- SE LLAMA AL METOO EDIT CON LA ID DEL PACIENTE-->
                                    <td>
                                        <a href="{{ route('patients.edit',$pat->id) }}" class="btn  btn-warning glyphicon glyphicon-pencil">              
                                        </td>

                                        <!-- SE LLAMA AL METODO DESTROY PARA LA ELIMINACION DEL PACIENTE-->
                                        <td>
                                            <form action="{{ url('/patients', ['id' => $pat->id]) }}" method="post">
                                                <button type="submit" class="btn btn-danger glyphicon glyphicon-trash"   onclick="return confirm('¿Esta seguro que desea eliminar este registro?')"></button>
                                                {!! method_field('delete') !!}
                                                {!! csrf_field() !!}
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- SI NO HAY PACIENTES SE MUESTRA UN MENSAJE-->
                            @else
                            <br/>
                            <div class='alert alert-warning'>
                                <label>No existe ningún paciente dentro de la lista</label>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>


            <!-- CONVERTIR MI TABLA  EN  UNA DATATABLE PARA TENER BUSQUEDA, ORDENAMIENTO Y PAGINACION-->
            <script type="text/javascript">
                $(function () {
                //SE EJECUTA DATATABLE PARA LA TABLA DE ID PACIENTE
                $('#patients').DataTable()

            })
        </script>

