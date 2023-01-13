@extends('layouts.eceadminapp')

@section('content')
<script src="{{ asset('js/tenants.js')."?v=2.1" }}" defer></script>

<form method="POST" action="{{ route('eceadmin.storetenant') }}"  role="form" enctype="multipart/form-data">
    @csrf
    <h5 class="section-title title">Registrar tenant</h5>
    <p class="breadcrumbs">
        <a href="{{ url('eceadmin.home') }}">Inicio</a> >
        <a href="{{ route('eceadmin.tenants') }}">Tenants</a> >
        Registrar tenant
    </p>
    <hr class="opactity3">
    <div class="scroll-section">
        <div class="form-group">
            <h6>Datos del Tenant</h6>
            <div class="row no-mar">
                <div class="col s12">
                    <div class="row no-mar">
                        <div class="input-field col s12 m12 l4">
                            <input id="nombre" name ="nombre" type="text" class="validate" value="{{old('nombre')}}" onkeypress="return /[a-zA-Z0-9 ñÑ]/i.test(event.key)" maxlength="255" required>
                            <label for="nombre">Nombre del Tenant</label>
                            @error('nombre')
                                <span class="helper-text show">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 m12 l4">
                            <input id="alias" name ="alias" type="text" class="validate" value="{{old('alias')}}" onkeypress="return /[a-zA-Z0-9 ñÑ]/i.test(event.key)" maxlength="255">
                            <label for="alias">Alias del Tenant</label>
                            @error('alias')
                                <span class="helper-text show">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 m12 l4">
                            <input id="clues" name = "clues" type="text" class="validate" value="{{old('clues')}}" onkeypress="return /[0-9a-zA-Z ñÑ]/i.test(event.key)" maxlength="11" required>
                            <label for="clues" style="display: flex; align-items: center; grid-gap: 0.5rem;">Clave Clues <i class="material-icons tooltipped" data-position="top" data-tooltip="Clues - Clave unica de establecimientos en salud.">info</i></label>
                            @error('clues')
                                <span class="helper-text show">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row no-mar">
                        <div class="input-field col s12 m12 l4">
                            <input id="address" name = "address" type="text" class="validate" value="{{old('address')}}" onkeypress="return /[a-zA-Z ñÑ]/i.test(event.key)" maxlength="255" required>
                            <label for="address">Dirección</label>
                            @error('address')
                                <span class="helper-text show">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field col s12 m6 l4">
                            <input id="phone" name = "phone" type="text" class="validate" value="{{old('phone')}}" onkeypress="return /[0-9]/i.test(event.key)" pattern='[0-9]{10}' title="Eg. El formato del teléfono es: 6562451874" maxlength="10" required>                    
                            <label for="phone">Número de teléfono <small>  (10 dígitos)</small></label>
                            @error('phone')
                                <span class="helper-text show">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col s12 m12 l12">
                            <p style="font-weight: bold;">Tipo de Tenant <i class="material-icons tooltipped" data-position="top" data-tooltip="Selecciona el tipo de tenant">info</i></p>
                            @error('tenanttype')
                                <span class="helper-text show"><small>Selecciona al menos una opción</small></span>
                            @enderror
                            <div class="input-field responsive-check" style="display: block">
                                <p>
                                    <label>
                                        <input class="filled-in" type="radio" name="tenanttype" id="institutotype" onclick="changetype(1)" value="1" required {{ old('tenanttype') == 1? 'checked': ''}}>
                                        <span for="instituto">Institución</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input class="filled-in" type="radio" name="tenanttype" id="particulartype" onclick="changetype(2)" value="2" required {{ old('tenanttype') == 2? 'checked': ''}}>
                                        <span for="particular">Particular</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group {{ old('tenanttype') == 1? '': 'hide'}}" id="instituto">
            <div class="{{ old('includeadmin1') == 1 && old('includeadmin2') == 1? 'hide': '' }}" id="adminbutton">
                <a type="button" class="waves-light btn" onclick="addAdmin()">
                    <i class="material-icons left">add</i>Agregar Administrador
                </a>
                <hr class="opactity3">
            </div>
            @php
                $count = 0;
                if(old('includeadmin1') == 1){
                    $count++;
                }
                if(old('includeadmin2') == 1){
                    $count++;
                }
            @endphp
            <input type="hidden" id="numAdmins" name="numAdmins" value="{{ $count }}">
            <br>

            <div class="{{ old('includeadmin1') == 1? '': 'hide' }}" id="admin1">
                <h6>Administrador 01</h6>
                <a type="button" class="waves-light btn red lighten-1" onclick="removeAdmin1()" style="margin-top: 5px; margin-bottom: 12px">
                    <i class="material-icons left">cancel</i>Cancelar Admin 1
                </a>
                <input type="hidden" id="includeadmin1" name="includeadmin1" value="{{ old('includeadmin1') == 1? '1': '' }}">
                <div class="row no-mar">
                    <div class="col s12">
                        <div class="row no-mar">
                            <div class="input-field col s12 m6 l4">
                                <input id="adminname1" name="adminname1" type="text" class="validate" value="{{old('adminname1')}}" maxlength="255" {{ old('includeadmin1') == 1? 'required': 'required disabled' }}>
                                <label for="adminname1">Nombre</label>
                                @error('adminname1')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12 m6 l4">
                                <input id="adminemail1" name="adminemail1" type="email" class="validate" value="{{old('adminemail1')}}" maxlength="255" {{ old('includeadmin1') == 1? 'required': 'required disabled' }}>
                                <label for="adminemail1">Correo</label>
                                @error('adminemail1')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12 m6 l4">
                                <input id="adminphone1" name="adminphone1" type="text" class="validate" value="{{old('adminphone1')}}" onkeypress="return /[0-9]/i.test(event.key)" pattern='[0-9]{10}' title="Eg. El formato del teléfono es: 6562451874" maxlength="10" {{ old('includeadmin1') == 1? 'required': 'required disabled' }}>                    
                                <label for="adminphone1">Número de teléfono <small>  (10 dígitos)</small></label>
                                @error('adminphone1')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="row no-mar">
                            <div class="input-field col s12 m6 l4">
                                <input id="adminpassword1" name="adminpassword1" type="password" class="validate" value="{{old('adminpassword1')}}" maxlength="255" {{ old('includeadmin1') == 1? 'required': 'required disabled' }}>
                                <label for="adminpassword1">Contraseña</label>
                                @error('adminpassword1')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="{{ old('includeadmin2') == 1? '': 'hide' }}" id="admin2">
                <h6>Administrador 02</h6>
                <a type="button" class="waves-light btn red lighten-1" onclick="removeAdmin2()" style="margin-top: 5px; margin-bottom: 12px">
                    <i class="material-icons left">cancel</i>Cancelar Admin 2
                </a>
                <input type="hidden" id="includeadmin2" name="includeadmin2" value="{{ old('includeadmin2') == 1? '1': '' }}">
                <div class="row no-mar">
                    <div class="col s12">
                        <div class="row no-mar">
                            <div class="input-field col s12 m6 l4">
                                <input id="adminname2" name="adminname2" type="text" class="validate" value="{{old('adminname2')}}" maxlength="255" {{ old('includeadmin2') == 1? 'required': 'required disabled' }}>
                                <label for="adminname2">Nombre</label>
                                @error('adminname2')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12 m6 l4">
                                <input id="adminemail2" name = "adminemail2" type="email" class="validate" value="{{old('adminemail2')}}" maxlength="255" {{ old('includeadmin2') == 1? 'required': 'required disabled' }}>
                                <label for="adminemail2">Correo</label>
                                @error('adminemail2')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12 m6 l4">
                                <input id="adminphone2" name="adminphone2" type="text" class="validate" value="{{old('adminphone2')}}" onkeypress="return /[0-9]/i.test(event.key)" pattern='[0-9]{10}' title="Eg. El formato del teléfono es: 6562451874" maxlength="10" {{ old('includeadmin2') == 1? 'required': 'required disabled' }}>                    
                                <label for="adminphone2">Número de teléfono <small>  (10 dígitos)</small></label>
                                @error('adminphone2')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="row no-mar">
                            <div class="input-field col s12 m6 l4">
                                <input id="adminpassword2" name="adminpassword2" type="password" class="validate" value="{{old('adminpassword2')}}" maxlength="255" {{ old('includeadmin2') == 1? 'required': 'required disabled' }}>
                                <label for="adminpassword2">Contraseña</label>
                                @error('adminpassword2')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group {{ old('tenanttype') == 2? '': 'hide'}}" id="particular">

            <div class="{{old('meds') == 1 ? 'hide': '' }}" id="medicobutton">
                <div class="row no-mar">
                    <div class="col s12">
                        <div class="input-field col s12 m12 l4">
                            <input id="lookcurp" name = "lookcurp" type="text" class="validate" value="{{old('lookcurp')}}" onkeypress="return /[A-Z0-9]/i.test(event.key)" oninput="this.value = this.value.toUpperCase()" pattern='[A-Z]{4}[0-9]{6}[A-Z]{6}[A-J0-9]{1}[0-9]{1}' title = "El formato de la CURP es: XXXX999999XXXXXXX9" maxlength="18">                    
                            <label for="lookcurp" style="display: flex; align-items: center; grid-gap: 0.5rem;">Curp Médico<i class="material-icons tooltipped" data-position="top" data-tooltip="Búsqueda del Médico">info</i>
                                <small><a href="https://www.gob.mx/curp/" target="_blank" ><span> Consultar CURP</span></a></small>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row no-mar">
                    <div class="col s12">
                        <div class="col s12 m12 l4">
                            <a type="button" class="waves-light btn" onclick="addMed()">
                                <i class="material-icons left">search</i>Buscar Médico
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="{{ old('meds1') == 1 ? '': 'hide' }}" id="user1">
                <h6>Usuario Médico</h6>
                <a type="button" class="waves-light btn red lighten-1" onclick="removeMed1()" style="margin-top: 5px; margin-bottom: 12px">
                    <i class="material-icons left">cancel</i>Cancelar Médico
                </a>
                <input type="hidden" id="includemed1" name="meds1" value="{{ old('meds1') == 1? '1': '' }}">
                <div class="row no-mar">
                    <div class="col s12">
                        <div class="row no-mar">
                            <div class="input-field col s12 m12 l4">
                                <input id="usercurp1" name = "usercurp1" type="text" class="validate" value="{{old('usercurp1')}}" onkeypress="return /[A-Z0-9]/i.test(event.key)" oninput="this.value = this.value.toUpperCase()" pattern='[A-Z]{4}[0-9]{6}[A-Z]{6}[A-J0-9]{1}[0-9]{1}' title = "El formato de la CURP es: XXXX999999XXXXXXX9" maxlength="18" readonly>                    
                                <label for="usercurp1">CURP <small><a href="https://www.gob.mx/curp/" target="_blank" >
                                    <span> Consultar CURP</span>
                                </a></small></label>
                                @error('usercurp1')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="{{ old('meds2') == 1 ? '': 'hide' }}" id="user2">
                <h6>Usuario Médico</h6>
                <a type="button" class="waves-light btn red lighten-1" onclick="removeMed2()" style="margin-top: 5px; margin-bottom: 12px">
                    <i class="material-icons left">cancel</i>Cancelar Médico
                </a>
                <input type="hidden" id="includemed2" name="meds2" value="{{ old('meds2') == 1? '1': '' }}">
                <div class="row no-mar">
                    <div class="col s12">
                        <div class="row no-mar">
                            <div class="input-field col s12 m12 l4">
                                <input id="usercurp" name = "usercurp" type="text" class="validate" value="{{old('usercurp')}}" onkeypress="return /[A-Z0-9]/i.test(event.key)" oninput="this.value = this.value.toUpperCase()" pattern='[A-Z]{4}[0-9]{6}[A-Z]{6}[A-J0-9]{1}[0-9]{1}' title = "El formato de la CURP es: XXXX999999XXXXXXX9" maxlength="18" {{ old('meds2') == 1? 'required': 'required disabled' }}>                    
                                <label for="usercurp">CURP <small><a href="https://www.gob.mx/curp/" target="_blank" >
                                    <span> Consultar CURP</span>
                                </a></small></label>
                                @error('usercurp')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12 m6 l4">
                                <input id="usercedula" name="usercedula" type="text" class="validate" value="{{old('usercedula')}}" maxlength="8" {{ old('meds2') == 1? 'required': 'required disabled' }}>
                                <label for="usercedula">Cédula</label>
                                @error('usercedula')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12 m6 l4">
                                <input id="userphone" name="userphone" type="text" class="validate" value="{{old('userphone')}}" onkeypress="return /[0-9]/i.test(event.key)" pattern='[0-9]{10}' title="Eg. El formato del teléfono es: 6562451874" maxlength="10" {{ old('meds2') == 1? 'required': 'required disabled' }}>                    
                                <label for="userphone">Número de teléfono <small>  (10 dígitos)</small></label>
                                @error('userphone')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row no-mar">
                            <div class="input-field col s12 m12 l4">
                                <input id="usernombre" name="usernombre" type="text" class="validate" value="{{old('usernombre')}}" onkeypress="return /[a-zA-Z ñÑ]/i.test(event.key)" maxlength="40" {{ old('meds2') == 1? 'required': 'required disabled' }}>
                                <label for="usernombre">Nombre(s)</label>
                                @error('usernombre')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12 m12 l4">
                                <input id="userprimerApellido" name ="userprimerApellido" type="text" class="validate" value="{{old('userprimerApellido')}}" onkeypress="return /[a-zA-Z ñÑ]/i.test(event.key)" maxlength="40" {{ old('meds2') == 1? 'required': 'required disabled' }}>
                                <label for="userprimerApellido">Primer Apellido</label>
                                @error('userprimerApellido')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12 m12 l4">
                                <input id="usersegundoApellido" name = "usersegundoApellido" type="text" class="validate" value="{{old('usersegundoApellido')}}" onkeypress="return /[a-zA-Z ñÑ]/i.test(event.key)" maxlength="40" {{ old('meds2') == 1? 'required': 'required disabled' }}>
                                <label for="usersegundoApellido">Segundo Apellido</label>
                                @error('usersegundoApellido')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="row no-mar">
                            <div class="input-field col s12 m6 l4">
                                <input id="useremail" name="useremail" type="email" class="validate" value="{{old('useremail')}}" maxlength="255" {{ old('meds2') == 1? 'required': 'required disabled' }}>
                                <label for="useremail">Correo</label>
                                @error('useremail')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12 m6 l4">
                                <input id="userpassword" name="userpassword" type="password" class="validate" value="{{old('userpassword')}}" minlength="4" maxlength="255" {{ old('meds2') == 1? 'required': 'required disabled' }}>
                                <label for="userpassword">Contraseña</label>
                                @error('userpassword')
                                    <span class="helper-text show">{{ $message }}</span>
                                @enderror
                            </div>
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
                <a href="{{ route('eceadmin.tenants') }}" class="waves-light btn red darken-3">
                    <i class="material-icons left">close</i>Cancelar registro
                </a>
            </div>
        </div>
    </div>
</form>

<div id="modalerror" class="modal">
    <div class="modal-content" style="padding: 1rem 2rem;">
        <p style="font-size: 1.5rem">¡A ocurrido un error intentelo mas tarde!</p>
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