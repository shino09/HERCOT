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
          <h3>Agendar Consulta Dental</h3>
        </div>

        <!--FORMULARIO DE CREACION DEL DENTISTA-->
        <form class="form-horizontal" method="POST" action="{{ route('appointments.store') }}">
          {{ csrf_field() }}
          <div class="form-group">
           <div class="form-group">
            <label class="control-label col-sm-2" for="price">Servicio:</label>
            <div class="col-sm-4">
             <select name="service_id" id="service_id" class="form-control">
              @foreach($services as $ser)
              <option value="{{ $ser->id }}">{{ $ser->name }}</option>
              @endforeach
            </select>                      
            @if ($errors->has('service_id'))
            <span class="help-block">
              <p style="color: red; text-align: center">{{ $errors->first('service_id') }}</p>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="price">Médico Tratante:</label>
          <div class="col-sm-4">
           <select name="dentist_id" id="dentist_id" class="form-control">
            @foreach($dentists as $den)
            <option value="{{ $den->id }}">{{ $den->name }}</option>
            @endforeach
          </select>                      
          @if ($errors->has('dentist_id'))
          <span class="help-block">
            <p style="color: red; text-align: center">{{ $errors->first('dentist_id') }}</p>
          </span>
          @endif
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="price">Nombre Paciente:</label>
        <div class="col-sm-4">
         <select name="patient_id" id="patient_id" class="form-control">
          @foreach($patients as $pat)
          <option value="{{ $pat->id }}">{{ $pat->name }}</option>
          @endforeach
        </select>                      
        @if ($errors->has('patient_id'))
        <span class="help-block">
          <p style="color: red; text-align: center">{{ $errors->first('patient_id') }}</p>
        </span>
        @endif
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="price">Costo Servicio:</label>
      <div class="col-sm-4">
        <input type="number" class="form-control" name="price" placeholder="Precio del servicio" >
        @if ($errors->has('price'))
        <span class="help-block">
          <p style="color: red; text-align: center">{{ $errors->first('price') }}</p>
        </span>
        @endif
      </div>
    </div>


    <label class="control-label col-sm-2" for="date">Fecha Servicio:</label>
    <div class="col-sm-4">
      <input type="text" class="date form-control" name="date">
      @if ($errors->has('date'))
      <span class="help-block">
        <p style="color: red; text-align: center">{{ $errors->first('date') }}</p>
      </span>
      @endif
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary" name="envio">Agendar Consulta</button>
      <a href="{{ route('appointments.index') }}" class="btn  btn-danger">Cancelar</a>
    </a>
  </div>
</div>
</form>

<script type="text/javascript">

  $('.date').datepicker({  

   format: 'dd-mm-yyyy'

 });  

</script>  
</div>








