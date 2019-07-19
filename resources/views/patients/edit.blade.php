            <!-- JS Y CCS QUE SE USARAN , BOSTRATP, JQUERY, DATAPICKER-->



            <link href="{!! asset('bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
            <link href="{!! asset('bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}" rel="stylesheet">

            <script src="{{ asset('jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>


            <div class="container center">
              <div class="container tittle">
                  <h3>Ingresar nuevo Paciente</h3>
              </div>
              <?php echo $patient->id;?>
              <form class="form-horizontal" method="POST" action="{{ route('patients.update', ['id' => $patient->id]) }}">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="form-group">
                      <label class="control-label col-sm-2" for="name">Name:</label>
                      <div class="col-sm-4">
                        <input type="text" value="{{$patient->name}}" class="form-control" name="name" placeholder="Nombre del Paciente" >
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <p style="color: red; text-align: center">{{ $errors->first('name') }}</p>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary" name="envio">Guardar</button>
                      <a href="{{ route('patients.index') }}" class="btn  btn-danger">Cancelar</a>
                  </a>
              </div>
          </div>
      </form>
  </div>










