<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('catalogKey') }}
            {{ Form::text('catalogKey', $municipio->catalogKey, ['class' => 'form-control' . ($errors->has('catalogKey') ? ' is-invalid' : ''), 'placeholder' => 'Catalogkey']) }}
            {!! $errors->first('catalogKey', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('municipio') }}
            {{ Form::text('municipio', $municipio->municipio, ['class' => 'form-control' . ($errors->has('municipio') ? ' is-invalid' : ''), 'placeholder' => 'Municipio']) }}
            {!! $errors->first('municipio', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('entidadFederativa_id') }}
            {{ Form::text('entidadFederativa_id', $municipio->entidadFederativa_id, ['class' => 'form-control' . ($errors->has('entidadFederativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Entidadfederativa Id']) }}
            {!! $errors->first('entidadFederativa_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>