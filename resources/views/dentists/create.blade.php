         <!-- JS Y CCS QUE SE USARAN , BOSTRATP, JQUERY, DATAPICKER-->
        <link href="{!! asset('bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
        <link href="{!! asset('bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}" rel="stylesheet">

        <script src="{{ asset('jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>


        <div class="container center">
           <a href="{{ route('appointments.index') }}" class="btn  btn-default">LISTADO DE CITAS</a>
                    <a href="{{ route('patients.index') }}" class="btn  btn-default">PACIENTES</a>
                    <a href="{{ route('dentists.index') }}" class="btn  btn-default">DENTISTAS</a>
                    <a href="{{ route('services.index') }}" class="btn  btn-default">SERVICIOS</a>

          <div class="container tittle">
              <h3>Ingresar nuevo Dentista</h3>
          </div>
          <!--FORMULARIO DE CREACION DEL DENTISTA-->
          <form class="form-horizontal" method="POST" action="{{ route('dentists.store') }}">
              {{ csrf_field() }}
              <div class="form-group">
                  <label class="control-label col-sm-2" for="name">Nombre Dentista:</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" name="name" placeholder="Nombre del DENTISTA" >
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
                  <a href="{{ route('dentists.index') }}" class="btn  btn-danger">Cancelar</a>
              </a>
          </div>
      </div>
  </form>
</div>









