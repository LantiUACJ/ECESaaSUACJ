<div class="scroll-section">

<div class="form-group">
    <h5>Datos Generales</h5>
    <div class="row no-mar">
        <div class="col s12">
            <div class="row no-mar">
                <div class="input-field col s12 m12 l4">
                    <input id="nombre" name ="nombre" type="text" class="validate" value="{{old('nombre', $paciente->nombre)}}" onkeypress = "return /[A-Z Ñ]/i.test(event.key)" oninput = "this.value = this.value.toUpperCase()" maxlength = 40>
                    <label for="nombre">Nombre(s)</label>
                    @error('nombre')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m12 l4">
                    <input id="primerApellido" name ="primerApellido" type="text" class="validate" value="{{old('primerApellido', $paciente->primerApellido)}}" onkeypress = "return /[A-Z Ñ]/i.test(event.key)" oninput = "this.value = this.value.toUpperCase()" maxlength = 40>
                    <label for="primerApellido">Primer Apellido</label>
                    @error('primerApellido')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m12 l4">
                    <input id="segundoApellido" name = "segundoApellido" type="text" class="validate" value="{{old('segundoApellido', $paciente->segundoApellido)}}" onkeypress = "return /[A-Z Ñ]/i.test(event.key)" oninput = "this.value = this.value.toUpperCase()" maxlength = 40>
                    <label for="segundoApellido">Segundo Apellido</label>
                    @error('segundoApellido')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row no-mar">
                <div class="input-field col s12 m12 l4">
                    <input id="curp" name = "curp" type="text" class="validate" value="{{old('curp', $paciente->curp)}}" onkeypress = "return /[A-Z0-9]/i.test(event.key)" oninput = "this.value = this.value.toUpperCase()" pattern = '[A-Z]{4}[0-9]{8}[A-Z]{6}[A-J0-9]{1}[0-9]{1}' title = "El formato de la CURP es: XXXX999999XXXXXXX9" maxlength = 18>                    
                    <label for="curp">CURP <small><a href="https://www.gob.mx/curp/" target="_blank" >
                        <span> Consulta tu CURP</span>
                    </a></small></label>
                    @error('curp')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col s12 m12 l8 date-container">
                    <div class="input-field date-input">
                        <input id="fechaNacimiento" name = "fechaNacimiento" type="text" class="validate datepicker" value="{{old('fechaNacimiento', $paciente->fechaNacimiento != null? date('d-m-Y',strtotime($paciente->fechaNacimiento)): "")}}"
                         onkeypress = "return false" >
                        <label for="fechaNacimiento">Fecha de nacimiento</label>
                        <i class="material-icons prefix" for="fechaNacimiento" style="right: 0; opacity: 0.8; pointer-events: none; cursor: initial; user-select: none; background-color: white;">date_range</i>
                        @error('fechaNacimiento')
                            <span class="helper-text show">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field date-display">
                        <p id="edad" name = "edad">Edad: </p>
                    </div>
                </div>
            </div>
            <div class="row no-mar">
                <div class="input-field col s12 m6 l4">
                    <select id="gruposanguineo_id" name="gruposanguineo_id" >
                        <option value="" disabled selected>Elije una opción</option>
                        @foreach ($gruposanguineos as $gruposanguineo)                       
                            <option value="{{ $gruposanguineo->id }}" {{ old('gruposanguineo_id') == $gruposanguineo->id ? 'selected' : ($gruposanguineo->id == $paciente->gruposanguineo_id ? 'selected' : '') }} >{{ $gruposanguineo->slug }}</option>                        
                        @endforeach         
                    </select>
                    <label>Tipo de sangre</label>
                    @error('gruposanguineo_id')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6 l4">
                    <select id="sexo_id" name="sexo_id" >
                        <option value="" disabled selected>Elije una opción</option>
                        @foreach ($sexos as $sexo)                       
                            <option value="{{ $sexo->id }}" {{ old('sexo_id') == $sexo->id ? 'selected' : ($sexo->id == $paciente->sexo_id ? 'selected' : '') }} >{{ $sexo->descripcion }}</option>                        
                        @endforeach  
                    </select>
                    <label style="display: flex; align-items: center; grid-gap: 0.5rem;">Sexo <i class="material-icons tooltipped" data-position="top" data-tooltip="Sexo del paciente, corresponde la condición biológica y fisiológica de nacimiento.">info</i></label>
                    @error('sexo_id')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6 l4">
                    <select id="genero_id" name="genero_id" >
                        <option value="" disabled selected>Elije una opción</option>
                        @foreach ($generos as $genero)                       
                            <option value="{{ $genero->id }}" {{ old('genero_id') == $genero->id ? 'selected' : ($genero->id == $paciente->genero_id ? 'selected' : '') }} >{{ $genero->descripcion }}</option>                        
                        @endforeach     
                    </select>
                    <label style="display: flex; align-items: center; grid-gap: 0.5rem;">Género <i class="material-icons tooltipped" data-position="top" data-tooltip="Identidad de género del paciente o atributos sociales aprendidos o adoptados por la persona.">info</i></label>
                    @error('genero_id')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row no-mar">
                <div class="input-field col s12 m6 l4">
                    <select id="indigena_id" name="indigena_id" >
                        <option value="" disabled selected>Elije una opción</option>
                        @foreach ($indigenas as $indigena)                       
                            <option value="{{ $indigena->id }}" {{ old('indigena_id') == $indigena->id ? 'selected' : ($indigena->id == $paciente->indigena_id ? 'selected' : '') }} >{{ $indigena->opcion }}</option>                        
                        @endforeach     
                    </select>
                    <label>¿Se considerá indigena?</label>
                    @error('indigena_id')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6 l4">
                    <select id="afromexicano_id" name="afromexicano_id" >
                        <option value="" disabled selected>Elije una opción</option>
                        @foreach ($afromexicanos as $afromexicano)                       
                                <option value="{{ $afromexicano->id }}" {{ old('afromexicano_id') == $afromexicano->id ? 'selected' : ($afromexicano->id == $paciente->afromexicano_id ? 'selected' : '') }} >{{ $afromexicano->opcionAfro }}</option>                        
                            @endforeach     
                    </select>
                    <label>¿Se autodenomina afromexicano?</label>
                    @error('afromexicano_id')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6 l4">
                    <input id="email" name = "email" type="email" class="validate" value="{{old('email', $paciente->email)}}" maxlength = 255 title = "El valor introducido no corresponde al formato del correo electrónico">                    
                    <label for="email">Correo electrónico</label>
                    @error('email')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row no-mar">
                <div class="input-field col s12 m6 l4">
                    <input id="phone" name = "phone" type="text" class="validate" value="{{old('phone', $paciente->phone)}}" onkeypress = "return /[0-9]/i.test(event.key)" pattern = '[0-9]{10}' title = "El formato del teléfono: 9999999999" maxlength = 10>                    
                    <label for="phone">Número de teléfono <small>  (10 dígitos)</small></label>
                    @error('phone')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6 l4">
                    <select id="entidadNac_id" name="entidadNac_id">
                        <option value="">Elije una opción</option>
                        @foreach ($entidades as $entidad)                
                            <option value="{{ $entidad->id }}" {{ old('entidadNac_id') == $entidad->id ? 'selected' : ($entidad->id == $paciente->entidadNac_id ? 'selected' : '') }}>{{ $entidad->entidad }}</option>
                        @endforeach
                    </select>
                    <label>Entidad de nacimiento</label>
                    @error('entidadNac_id')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-field col s12 m6 l4">
                    <select id="municipioNac_id" name="municipioNac_id">
                        <option value="">Elije una opción</option>
                        @foreach ($municipiosnac as $municipionac)                       
                            <option value="{{ $municipionac->id }}" {{ old('municipioNac_id') ==  $municipionac->id ? 'selected' : ( $municipionac->id == $paciente->municipioNac_id ? 'selected' : '') }}>{{ $municipionac->municipio }}</option>                        
                        @endforeach  
                    </select>
                    <label>Municipio de Nacimiento</label>
                    @error('municipioNac_id')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col s12 m12 l12">
                    <p style="font-weight: bold;">Derechohabiencia</p>
                    <input name="dhcount" id="dhcount" hidden>
                    @error('dh')
                        <span class="helper-text show"><small>Selecciona al menos una opción</small></span>
                    @enderror
                    <div class="input-field responsive-check">
                        @foreach($derechohabiencias as $derechohabiencia)
                            <p>
                                <label>
                                    <input class="filled-in" type="checkbox" name="dh[{{$derechohabiencia->id}}]" id="dh{{$derechohabiencia->id}}" value= "{{$derechohabiencia->id}}" 
                                    @if(old('dh.'.$derechohabiencia->id) == $derechohabiencia->id)
                                        checked
                                    @else
                                        {
                                            @foreach($paciente->dhp as $pdh)
                                                @if($pdh->derechoHabiencias_id == $derechohabiencia->id)
                                                    checked
                                                @endif  
                                            @endforeach
                                        }
                                    @endif />
                                    <span for="dh{{$derechohabiencia->id}}">{{ $derechohabiencia->siglaDH }}</span>
                                </label>
                            </p>                    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <h5>Domicilio Actual</h5>
    <div class="row no-mar">
        <div class="col s12">
            <div class="row no-mar">
                <div class="input-field col s12 m6 l4">
                    <input id="calle" name = "calle" type="text" class="validate" value="{{old('calle', $paciente->calle)}}" oninput="this.value = this.value.toUpperCase()" maxlength = 100>
                    <label for="calle">Calle</label>
                    @error('calle')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6 l4">
                    <input id="numero" name = "numero" type="text" class="validate" value="{{old('numero', $paciente->numero)}}" maxlength = 50>
                    <label for="numero">Número</label>
                    @error('numero')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field col s12 m6 l4">
                    <input id="colonia" name = "colonia" type="text" class="validate" value="{{old('colonia', $paciente->colonia)}}" oninput="this.value = this.value.toUpperCase()" maxlength = 100>
                    <label for="colonia">Colonia</label>
                    @error('colonia')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row no-mar">
                <div class="input-field col s12 m6 l4">
                    <select id="entidadFederativa_id" name="entidadFederativa_id">
                        <option value="">Elije una opción</option>
                        @foreach ($entidades as $entidad)                       
                            <option value="{{ $entidad->id }}" {{ old('entidadFederativa_id') == $entidad->id ? 'selected' : ($entidad->id == $paciente->entidadFederativa_id ? 'selected' : '') }}>{{ $entidad->entidad }}</option>                        
                        @endforeach
                    </select>
                    <label>Entidad</label>
                    @error('entidadFederativa_id')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-field col s12 m6 l4">
                    <select id="municipio_id" name="municipio_id">
                        <option value="">Elije una opción</option>
                        @foreach ($municipios as $municipio)                       
                            <option value="{{ $municipio->id }}" {{ old('municipio_id') ==  $municipio->id ? 'selected' : ( $municipio->id == $paciente->municipio_id ? 'selected' : '') }}>{{ $municipio->municipio }}</option>                        
                        @endforeach   
                    </select>
                    <label>Municipio</label>
                    @error('municipio_id')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <button class="waves-light btn" type="submit">
            <i class="material-icons left">save</i>Guardar
        </button>
        <a href="{{ route('pacientes.index') }}" class="waves-light btn red darken-3">
            <i class="material-icons left">close</i>Cancelar registro
        </a>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
    </script>

<script> 
    //LUIS
    
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.tooltipped');
    var instances = M.Tooltip.init(elems);
  });

        let today = Date.now();
        let maxDate = new Date(today); 
        let currenYear = new Date(today).getFullYear();
        let minYear= currenYear - 150;

        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.dropdown-trigger');
            var instances = M.Dropdown.init(elems);
        });
        $(document).ready(function() {
        $('.datepicker').datepicker({ 
                    maxDate,
                    yearRange: [minYear, currenYear],
                    firstDay: true, 
                    format: 'dd-mm-yyyy',
                    i18n: {
                        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
                        weekdays: ["Domingo","Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                        weekdaysShort: ["Dom","Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                        weekdaysAbbrev: ["D","L", "M", "M", "J", "V", "S"],
                        cancel: 'Cancelar',
                        done: 'Aceptar',
                    }
        });
        
    });
        document.addEventListener('DOMContentLoaded', function() {
            var sele = document.querySelectorAll('select');
            var instance = M.FormSelect.init(sele);
        });

        document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems, {dismissible: false});
        });
        function toggleMenu() {
            var element = document.getElementById("menusidebar");
            element.classList.toggle("showmenu");
            var elementtwo = document.getElementById("menubg");
            elementtwo.classList.toggle("showbg");
        }

        var elems = null;
        document.addEventListener('DOMContentLoaded', function() {
            elems = document.querySelectorAll('.collapsible');
            var options = {};
            var instances = M.Collapsible.init(elems, options);

        });

    $(window).resize(function () {
        if ($(window).width() <= 960) {
            elems.forEach((elmnt, i) => {
            });
        }
    });
    </script>
<script type="text/javascript"> 
    
    //CESAR -  YOC
    function myFunctionEdad()
    {
        if($('#fechaNacimiento').val() == '')
            $('#edad').text("Edad: 0 años");
        else
        { 
        var realdate = $('#fechaNacimiento').val().split('-');
        var fulldate = realdate[2]+'-'+realdate[1]+'-'+realdate[0];
        var hoy = new Date();
        var cumpleanos = new Date(fulldate);
        cumpleanos.setDate(cumpleanos.getDate()+1);
        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();
         
            if (m < 0 || (m === 0 && hoy.getDate() < (cumpleanos.getDate()+1)))
                edad--;
                $('#edad').text("Edad: "+edad+" años");
        }
    };

    function myFunctiondh()
    {  
        if($("#dh1").is(':checked'))
        {
            $('#dh2').prop('disabled', true);
            $('#dh2').prop('checked', false);
            $('#dh3').prop('disabled', true);
            $('#dh3').prop('checked', false);
        }
        else{
            if($("#dh2").is(':checked'))
            {
                $('#dh1').prop('disabled', true);
                $('#dh1').prop('checked', false);
                $('#dh3').prop('disabled', true);
                $('#dh3').prop('checked', false);
            }
            else{
                if($("#dh3").is(':checked'))
                {
                    $('#dh2').prop('disabled', true);
                    $('#dh2').prop('checked', false);
                    $('#dh1').prop('disabled', true);
                    $('#dh1').prop('checked', false);
                }
            }
        }
        if($("#dh1").is(':checked')||$("#dh2").is(':checked') || $("#dh3").is(':checked'))
        {            
            $('#dh4').prop('disabled', true);
            $('#dh4').prop('checked', false);
            $('#dh5').prop('disabled', true);
            $('#dh5').prop('checked', false);
            $('#dh6').prop('disabled', true);
            $('#dh6').prop('checked', false);
            $('#dh7').prop('disabled', true);
            $('#dh7').prop('checked', false);
            $('#dh8').prop('disabled', true);
            $('#dh8').prop('checked', false);
            $('#dh9').prop('disabled', true);
            $('#dh9').prop('checked', false);
            $('#dh10').prop('disabled', true);
            $('#dh10').prop('checked', false);
            $('#dh11').prop('disabled', true);
            $('#dh11').prop('checked', false);
            $('#dh12').prop('disabled', true);
            $('#dh12').prop('checked', false);
        }
        else
        {   
            if($("#dh4").is(':checked')||$("#dh5").is(':checked') || $("#dh6").is(':checked') || $("#dh7").is(':checked') || $("#dh8").is(':checked')|| $("#dh9").is(':checked') || $("#dh10").is(':checked')|| $("#dh11").is(':checked')|| $("#dh12").is(':checked'))
            {            
                $('#dh1').prop('disabled', true);
                $('#dh1').prop('checked', false);
                $('#dh2').prop('disabled', true);
                $('#dh2').prop('checked', false);
                $('#dh3').prop('disabled', true);
                $('#dh3').prop('checked', false);
            }
            else
            {
                $('#dh1').prop('disabled', false);
                $('#dh1').prop('checked', false);
                $('#dh2').prop('disabled', false);
                $('#dh2').prop('checked', false);
                $('#dh3').prop('disabled', false);
                $('#dh3').prop('checked', false);         
                $('#dh4').prop('disabled', false);
                $('#dh4').prop('checked', false);
                $('#dh5').prop('disabled', false);
                $('#dh5').prop('checked', false);
                $('#dh6').prop('disabled', false);
                $('#dh6').prop('checked', false);
                $('#dh7').prop('disabled', false);
                $('#dh7').prop('checked', false);
                $('#dh8').prop('disabled', false);
                $('#dh8').prop('checked', false);
                $('#dh9').prop('disabled', false);
                $('#dh9').prop('checked', false);
                $('#dh10').prop('disabled', false);
                $('#dh10').prop('checked', false);
                $('#dh11').prop('disabled', false);
                $('#dh11').prop('checked', false);
                $('#dh12').prop('disabled', false);
                $('#dh12').prop('checked', false);
            }
        }
        myFunctiondhcount();
    };
    function myFunctiondhcount()
    {  
        var sumdh=0;
        if($("#dh1").is(':checked')) {
            sumdh = sumdh + 1;
        }
        if($("#dh2").is(':checked')) {
            sumdh = sumdh + 1;
        }
        if($("#dh4").is(':checked')) {
            sumdh = sumdh + 1;
        }
        if($("#dh3").is(':checked')) {
            sumdh = sumdh + 1;
        }
        if($("#dh5").is(':checked')){            
            sumdh = sumdh + 1;
        }
        if($("#dh6").is(':checked')){            
            sumdh = sumdh + 1;
        }
        if($("#dh7").is(':checked')){            
            sumdh = sumdh + 1;
        }
        if($("#dh8").is(':checked')){            
            sumdh = sumdh + 1;
        }
        if($("#dh9").is(':checked')){            
            sumdh = sumdh + 1;
        }
        if($("#dh10").is(':checked')){            
            sumdh = sumdh + 1;
        }
        if($("#dh11").is(':checked')){            
            sumdh = sumdh + 1;
        }
        if($("#dh12").is(':checked')){            
            sumdh = sumdh + 1;
        }
        $('#dhcount').prop('value', sumdh);
    };
   
    $(document).ready(function() {
        myFunctionEdad();
        myFunctiondh();

        $('#fechaNacimiento').change(function(){
            myFunctionEdad();
        });
        
        $('#dh1').on('click', function() {
            myFunctiondh();
        });
        $('#dh2').on('click', function() {
            myFunctiondh();
        });
        $('#dh3').on('click', function() {
            myFunctiondh();
        });
        $('#dh4').on('click', function() {
            myFunctiondh();
        });
        $('#dh5').on('click', function() {
            myFunctiondh();
        });
        $('#dh6').on('click', function() {
            myFunctiondh();
        });
        $('#dh7').on('click', function() {
            myFunctiondh();
        });
        $('#dh8').on('click', function() {
            myFunctiondh();
        });
        $('#dh9').on('click', function() {
            myFunctiondh();
        });
        $('#dh10').on('click', function() {
            myFunctiondh();
        });
        $('#dh11').on('click', function() {
            myFunctiondh();
        });
        $('#dh12').on('click', function() {
            myFunctiondh();
        });
        var entidad_id = $("#entidadFederativa_id").val();
        var oldMunicipio = $("#municipio_id").val();
        //console.log('municipio: '+oldMunicipio);
            if (entidad_id == '') {
                $('select#municipio_id').formSelect().attr('disabled', true);
                $('select#municipio_id').formSelect().append("<option value = ''> Elige una opción </option>");
            }
            else{
                $('#municipio_id').prop('disabled', false);
                $.get("{{ url('select_municipio')}}/"+entidad_id, function (data) 
                {
                    $('select#municipio_id').formSelect().empty();
                    $('select#municipio_id').formSelect().attr('disabled', false);
                    $('select#municipio_id').formSelect().append("<option value = ''> Elige una opción </option>");
                    data.forEach(element => {
                        if(oldMunicipio == element.id)
                            $('select#municipio_id').formSelect().append("<option value='" + element.id + "' selected>"+ element.municipio +" </option>");
                        else
                            $('select#municipio_id').formSelect().append("<option value='" + element.id + "'>"+ element.municipio +" </option>");
                    });
                });
            }
        var entidadnac_id = $("#entidadNac_id").val();
        var oldMunicipioNac = $("#municipioNac_id").val();
        
            if (entidadnac_id == '') {
                $('select#municipioNac_id').formSelect().attr('disabled', true);
                $('select#municipioNac_id').formSelect().append("<option value = ''> Elige una opción </option>");
            }
            else {
                $('#municipioNac_id').prop('disabled', false);
                $.get("{{ url('select_municipio')}}/"+entidadnac_id, function (data) 
                {
                    $('select#municipioNac_id').formSelect().empty();
                    $('select#municipioNac_id').formSelect().attr('disabled', false);
                    $('select#municipioNac_id').formSelect().append("<option value = ''> Elige una opción </option>");
                    data.forEach(element => {
                        if(oldMunicipioNac == element.id)
                            $('select#municipioNac_id').formSelect().append("<option value='" + element.id + "' selected>"+ element.municipio +" </option>");
                        else
                        $('select#municipioNac_id').formSelect().append("<option value='" + element.id + "' >"+ element.municipio +" </option>");
                    });
                });
            }
        $('#entidadFederativa_id').on('change', function() {
            var entidad_id = $("#entidadFederativa_id").val();
            if (entidad_id != '') {
                $.get("{{ url('select_municipio')}}/"+entidad_id, function (data) 
                {
                    $('select#municipio_id').formSelect().empty();
                    $('select#municipio_id').formSelect().attr('disabled', false);
                    $('select#municipio_id').formSelect().append("<option value = ''> Elige una opción </option>");
                    data.forEach(element => {
                        $('select#municipio_id').formSelect().append("<option value='" + element.id + "'>"+ element.municipio +" </option>");
                    });
                });
            } else {
                const select = document.querySelector('select#municipio_id');
                select.querySelectorAll('option')[0].selected = true;
                select.querySelectorAll('option')[0].value = 0;
                $('select#municipio_id').formSelect().attr('disabled', true);
                M.FormSelect.init(document.getElementById('municipio_id'));
            }               
        }); 
        
        $('#entidadNac_id').on('change',function(){
            var entidadNac_id = $("#entidadNac_id").val();
            if (entidadNac_id != '') {
                $.get("{{ url('select_municipio')}}/"+entidadNac_id, function (data) 
                {
                    $('select#municipioNac_id').formSelect().empty();
                    $('select#municipioNac_id').formSelect().attr('disabled', false);
                    $('select#municipioNac_id').formSelect().append("<option value = ''> Elige una opción </option>");
                    data.forEach(element => {
                        $('select#municipioNac_id').formSelect().append("<option value='" + element.id + "'>"+ element.municipio +" </option>");
                    });
                });
            } else {
                const select = document.querySelector('select#municipioNac_id');
                select.querySelectorAll('option')[0].selected = true;
                select.querySelectorAll('option')[0].value = 0;
                $('select#municipioNac_id').formSelect().attr('disabled', true);
                M.FormSelect.init(document.getElementById('municipioNac_id')); 
            } 
        });
    });

</script>
