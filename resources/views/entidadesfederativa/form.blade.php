<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('catalogKey') }}
            {{ Form::text('catalogKey', $entidadesfederativa->catalogKey, ['class' => 'form-control' . ($errors->has('catalogKey') ? ' is-invalid' : ''), 'placeholder' => 'Catalogkey']) }}
            {!! $errors->first('catalogKey', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('entidad') }}
            {{ Form::text('entidad', $entidadesfederativa->entidad, ['class' => 'form-control' . ($errors->has('entidad') ? ' is-invalid' : ''), 'placeholder' => 'Entidad']) }}
            {!! $errors->first('entidad', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('abreviatura') }}
            {{ Form::text('abreviatura', $entidadesfederativa->abreviatura, ['class' => 'form-control' . ($errors->has('abreviatura') ? ' is-invalid' : ''), 'placeholder' => 'Abreviatura']) }}
            {!! $errors->first('abreviatura', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>