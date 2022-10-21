<div class="form-group">
    <h5>Datos</h5>
    <div class="row no-mar">
        <div class="col s12">
            <div class="row no-mar">
                <div class="input-field col s12 m12 l6">
                    <input id="numero" name = "numero" type="text" class="validate" value="{{old('numero', $sexo->numero)}}" onkeypress = "return /[0-9]/i.test(event.key)" maxlength = 2>
                    <label for="numero">Catalog Key</label>
                    <label for="numero" style="display: flex; align-items: center; grid-gap: 0.5rem;">Catalog Key <i class="material-icons tooltipped" data-position="top" data-tooltip="Número con el que se identifica el sexo en los catálogos de la DGIS">info</i></label>
                    @error('numero')
                        <span class="helper-text show">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row no-mar">
        <div class="col s12">
            <div class="row no-mar">
                <div class="input-field col s12 m12 l6">
                    <input id="descripcion" name= "descripcion" type="text" class="validate" value="{{old('descripcion', $sexo->descripcion)}}" onkeypress = "return /[A-Z ÁÉÍÓÚÜÑ]/i.test(event.key)" maxlength= 25 >
                    <label for="descripcion">Descripción</label>
                    @error('descripcion')
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
        <a href="{{ route('sexos.index') }}" class="waves-light btn red darken-3">
            <i class="material-icons left">close</i>Cancelar registro
        </a>
    </div>
</div>