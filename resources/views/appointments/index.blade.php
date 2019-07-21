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
                    <a href="{{ route('appointments.index') }}" class="btn  btn-default">LISTADO DE CITAS</a>
                    <a href="{{ route('patients.index') }}" class="btn  btn-default">PACIENTES</a>
                    <a href="{{ route('dentists.index') }}" class="btn  btn-default">DENTISTAS</a>
                    <a href="{{ route('services.index') }}" class="btn  btn-default">SERVICIOS</a>


                    <!-- FORMULARIO PARA FILTAR  POR FECHAS-->

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

                        <div class="form-group">
                            <button class="btn btn-success btn-submit">Filtrar entre 2 fechas</button>
                        </div>

                    </form>

                    <!-- BOTON PARA AGREGAR UN NUEVO CITA-->
                    <a href="{{ route('appointments.create') }}" class="btn  btn-success">CREAR NUEVO CITA</a>


                    <div class="box-header">
                        <h3 class="box-title">Lista de CITAs</h3>
                    </div>
                    <div class="box-body">

                        <!--AQUI SE MOSTRARA LA TABLA DE DATOS CON FILTRO CUANDO SE PRESIONE EL BOTON FILTRAR-->
                        <div id='confiltro' name="confiltro" class="confiltro">
                        </div>

                        <!-- TABLA DE DATOS SIN APLICARLE FITLRO-->
                        <div id='sinfiltro' name="sinfiltro" class="sinfiltro">

                            @if(count($appointments)>0)
                            <table id="appointments" class="table table-bordered table-hover">

                                <!-- CABEZERA DE LA TABLA-->
                                <thead>
                                    <tr>
                                        <th>Fecha Consulta</th>
                                        <th>Paciente</th> 
                                        <th>Servicio</th> 
                                        <th>Medico</th> 
                                        <th>Precio</th> 
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- CONTENIDO DE LA TABLA-->
                                    @foreach($appointments as $apt)
                                    <tr>
                                        <td>{{$apt->date}}</td>

                                        @foreach($patients as $pat)
                                        @if($apt->patient_id == $pat->id)
                                        <td>{{$pat->name}}</td>
                                        @endif
                                        @endforeach
                                        

                                        @foreach($services as $ser)
                                        @if($apt->service_id == $ser->id)
                                        <td>{{$ser->name}}</td>
                                        @endif
                                        @endforeach

                                        @foreach($dentists as $den)
                                        @if($apt->dentist_id == $den->id)
                                        <td>{{$den->name}}</td>
                                        @endif
                                        @endforeach

                                        <td>{{$apt->price}}</td>


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

                                <!-- LA GANANCIA ES LA SUMA DE TODOS LOS PRECIOS DE LAS CITAS - LA SUMA DE LOS COSTOS DE SERVICIOS-->
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


        <!-- SE CARGA EL  DATEPICKER PARA LAS FECHAS-->
        <script>
            $().ready(function() {

                $("#fecha_inicio").datepicker({
                    changeMonth: true,
                    changeYear: true,
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

        <!-- CUANDO SE PRESIONA EL FILTRAR SE CARGAN LOS DATOS DE LAS FECHAS Y SE ENVIAN AL CONTROLADOR PARA QUE ESTE FILTRE Y ENVIE DEVUELTA LOS DATOS DE LA TABLA CITAS QUE SE MOSTRARA EN EL DIV CONFILTRO-->
        <script type="text/javascript">
            //EL CSFT
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //CUANDO SE HACE CLICK EN EL BOTON SE EJECUTA TODO
            $(".btn-submit").click(function(e){
                //SE OBITIENEN LAS FECHAS DE LOS INPUT 
                e.preventDefault();
                var fecha_inicio = $("input[name=fecha_inicio]").val();
                var fecha_fin = $("input[name=fecha_fin]").val();

                //SE VALIDA QUE LAS 2 FECHAS TRAIGAN DATOS
                if (fecha_inicio == '' || fecha_fin == ''){
                    alert('por favor asegurece de ingresar  una fecha de inico y una fecha de fin');
                }
                //SE COMPRUEBA SI LA FECHA FINAL ES POSTERIOR A LA FECHA INICIO
                else{
                 if(comprobar_fechas(fecha_inicio,fecha_fin))
                 {
                     $.ajax({
                        //SE ENVIARAN LOS DATOS POR POST AL CONTROLADOR
                        type:'POST',
                        url:'index2',
                        data:{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin },

                        success:function(data){
                            //CUANDO SE RECIBEN LOS DATOS DEL CONTROLADOR SE PONEN EN EL DIV CONFILTRO, ESPECIFICAMENTE SE PONE LA TABLA CONLOS DATOS FILTRADOS
                            $('#confiltro').html(data);
                            //PARA QUE NO SE MUESTRE LA TABLA SIN FILTRAR JUNTO A LA MISMA TABLA FILTRADA PONGO COMO  HIDDEN EN DIV SINFILTRO
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
                   //SI LA FECHA FINAL NO ES POSTEIROR  A LA FECHA INICIO SE MUESTRA UN ERROR
                   else{
                    alert("La fecha de fin: "+fecha_fin+" debe ser posterior a la fecha de inicio: "+fecha_inicio);
                }
            }
        });
    </script>


    <!-- FUNCION PARA COMPROBAR QUE LA FECHA FIN SEA POSTERIOR A LA FECHA INICIO-->
    <script>
        function comprobar_fechas(fecha_inicio,fecha_fin)
        {
            //SE SACA CADA CARACTER DE LA FECHA (DIA.MES,AÑO) Y SE VA GUARDANDO EN UN ARREGLO
            inicio_valor=fecha_inicio.split("-");
            fin_valor=fecha_fin.split("-");

            //SE CONVIERTEN LOS ARREGLOS EN TIPO DATE
            var fecha_inicio=new Date(inicio_valor[2],(inicio_valor[1]-1),inicio_valor[0]);
            var fecha_fin=new Date(fin_valor[2],(fin_valor[1]-1),fin_valor[0]);
            //SE COMPARAN LAS DOS FECHAS, SI FECHA FIN ES POSTERIOR A FECHA INICIO SE RETORNA UN 1
            if(fecha_inicio>=fecha_fin)
            {
                return 0;
            }
            return 1;
        }
    </script>
