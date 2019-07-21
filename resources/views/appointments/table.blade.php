                      <!-- SI HAY CITAS USANDO EL  FILTRO-->
                      <?php if($appointments == NULL && $appointments_filtradas != NULL){?>
                        <h3>CON FILTRO</h3>
                        <table id="appointments_filtradas" class="table table-bordered table-hover">

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
                                @foreach($appointments_filtradas as $apt)
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
                        <?php }?>

                          <!-- LA GANANCIA ES LA SUMA DE TODOS LOS PRECIOS DE LAS CITAS - LA SUMA DE LOS COSTOS DE SERVICIOS, PERO EN ESTE CASO SOLO SE APLICA A LAS CITAS FILTRADAS-->
                        <h1> GANANCIA TOTAL: <?php echo $ganancia;?>$ .

                            <!-- SI NO HAY CITAS SE MUESTRA UN MENSAJE-->
                            <?php if($appointments_filtradas == NULL){?>
                                <br/>
                                <div class='alert alert-warning'>
                                    <label>No existe ningún CITA dentro de la lista</label>
                                </div>
                            <?php }?>



        <!-- CONVERTIR MI TABLA  EN  UNA DATATABLE PARA TENER BUSQUEDA, ORDENAMIENTO Y PAGINACION-->
        <script type="text/javascript">
            $(function () {
            //SE EJECUTA DATATABLE PARA LA TABLA DE ID CITA
            $('#appointments_filtradas').DataTable()
            })
        </script>
