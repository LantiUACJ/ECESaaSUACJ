<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('Número') }}
            {{ Form::text('numero', $sexo->numero, ['class' => 'form-control' . ($errors->has('numero') ? ' is-invalid' : ''), 'placeholder' => 'Número', 'onkeypress' => "return /[0-9]/i.test(event.key)",'maxlength' => 2, 'readonly' =>  true ]) }}
        </div>
        <div class="form-group">
            {{ Form::label('Descripción') }}
            {{ Form::text('descripcion', $sexo->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripción', 'onkeypress' => "return /[a-z A-ZáéíóúüñÁÉÍÓÚÑ]/i.test(event.key)",'maxlength' => 50, 'readonly' => ( $sexo->pacientes->count() > 1) ? true : false]) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>