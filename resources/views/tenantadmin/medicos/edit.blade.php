@extends('layouts.tenantadminapp')

@section('content')

<script src="{{ asset('js/tenantadmin.js')."?v=2.1" }}" defer></script>

<form method="POST" action="{{ route('tenantadmin.updatemedico', $medico->id) }}"  role="form" enctype="multipart/form-data">
    @csrf
    <h5 class="section-title title">Editar Médico</h5>
    <p class="breadcrumbs">
        <a href="{{ url('tenantadmin.home') }}">Inicio</a> >
        <a href="{{ route('tenantadmin.medicos') }}">Médicos</a> >
        Editar Médico
    </p>
    <hr class="opactity3">
    <div class="scroll-section">
        <div class="form-group">
            <div class="row no-mar">
                <div class="col s12" id="user2">
                    <h6>Datos del Médico</h6>
                    <div class="row no-mar">
                        <div class="input-field col s12 m12 l4">
                            <input id="usernombre" name="usernombre" type="text" class="validate" value="{{old('usernombre')?old('usernombre'): $medico->name}}" onkeypress="return /[a-zA-Z ñÑ]/i.test(event.key)" maxlength="255" required>
                            <label for="usernombre">Nombre</label>
                            @error('usernombre')
                                <span class="helper-text show">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 m12 l4">
                            <input id="userprimerApellido" name ="userprimerApellido" type="text" class="validate" value="{{old('userprimerApellido')?old('userprimerApellido'): $medico->primerApellido}}" onkeypress="return /[a-zA-Z ñÑ]/i.test(event.key)" maxlength="255" required>
                            <label for="userprimerApellido">Primer Apellido</label>
                            @error('userprimerApellido')
                                <span class="helper-text show">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 m12 l4">
                            <input id="usersegundoApellido" name="usersegundoApellido" type="text" class="validate" value="{{old('usersegundoApellido')?old('usersegundoApellido'): $medico->segundoApellido}}" onkeypress="return /[a-zA-Z ñÑ]/i.test(event.key)" maxlength="11" required>
                            <label for="usersegundoApellido">Segundo Apellido</label>
                            @error('usersegundoApellido')
                                <span class="helper-text show">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row no-mar">
                        <div class="input-field col s12 m12 l4">
                            <input id="usercurp" name="usercurp" type="text" class="validate" value="{{old('usercurp')?old('usercurp'): $medico->curp}}" onkeypress="return /[A-Z0-9]/i.test(event.key)" oninput="this.value = this.value.toUpperCase()" pattern='[A-Z]{4}[0-9]{6}[A-Z]{6}[A-J0-9]{1}[0-9]{1}' title = "El formato de la CURP es: XXXX999999XXXXXX99" maxlength="18" required>                    
                            <label for="usercurp">CURP <small><a href="https://www.gob.mx/curp/" target="_blank" >
                                <span> Consulta tu CURP</span>
                            </a></small></label>
                            @error('usercurp')
                                <span class="helper-text show">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 m12 l4">
                            <input id="usercedula" name="usercedula" type="text" class="validate" value="{{old('usercedula')?old('usercedula'): $medico->cedula}}" onkeypress="return /[0-9]/i.test(event.key)" minlength="7" maxlength="8" required>
                            <label for="usercedula">Cédula</label>
                            @error('usercedula')
                                <span class="helper-text show">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 m6 l4">
                            <input id="userphone" name="userphone" type="text" class="validate" value="{{old('userphone')?old('userphone'): $medico->phone}}" onkeypress="return /[0-9]/i.test(event.key)" pattern='[0-9]{10}' title="Eg. El formato de teléfono es: 6562451874" maxlength="10" required>                    
                            <label for="userphone">Número de teléfono <small>  (10 dígitos)</small></label>
                            @error('userphone')
                                <span class="helper-text show">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row no-mar">
                        <div class="input-field col s12 m6 l4">
                            <input id="useremail" name="useremail" type="email" class="validate" value="{{old('useremail')?old('useremail'): $medico->email}}" maxlength="255" required>
                            <label for="useremail">Correo</label>
                            @error('useremail')
                                <span class="helper-text show">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 m6 l4">
                            <input id="userpassword" name="userpassword" type="password" class="validate" value="{{old('userpassword')}}" minlength="4" maxlength="255">
                            <label for="userpassword">Contraseña</label>
                            @error('userpassword')
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
                <a href="{{ route('tenantadmin.medicos') }}" class="waves-light btn red darken-3">
                    <i class="material-icons left">close</i>Cancelar registro
                </a>
            </div>
        </div>
    </div>
</form>

<div id="modalerror" class="modal">
    <div class="modal-content" style="padding: 1rem 2rem;">
        <p style="font-size: 1.5rem" id="errormsg">¡A ocurrido un error intentelo mas tarde!</p>
    </div>
    <div class="modal-footer" style="padding: 1rem 1rem;">
        <a href="#!" class="modal-close waves-effect teal waves-green btn-flat" style="color: white;">Cerrar</a>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script> 
    //LUIS
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.tooltipped');
        var instances = M.Tooltip.init(elems);
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems, {dismissible: false});
    });

    $(window).resize(function () {
        if ($(window).width() <= 960) {
            elems.forEach((elmnt, i) => {
            });
        }
    });
</script>
@endsection