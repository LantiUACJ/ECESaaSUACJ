<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('valor') }}
            {{ Form::text('valor', $indigena->valor, ['class' => 'form-control' . ($errors->has('valor') ? ' is-invalid' : ''), 'placeholder' => 'Valor']) }}
            {!! $errors->first('valor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('opcion') }}
            {{ Form::text('opcion', $indigena->opcion, ['class' => 'form-control' . ($errors->has('opcion') ? ' is-invalid' : ''), 'placeholder' => 'Opcion']) }}
            {!! $errors->first('opcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('createdUser_id') }}
            {{ Form::text('createdUser_id', $indigena->createdUser_id, ['class' => 'form-control' . ($errors->has('createdUser_id') ? ' is-invalid' : ''), 'placeholder' => 'Createduser Id']) }}
            {!! $errors->first('createdUser_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updateUser_id') }}
            {{ Form::text('updateUser_id', $indigena->updateUser_id, ['class' => 'form-control' . ($errors->has('updateUser_id') ? ' is-invalid' : ''), 'placeholder' => 'Updateuser Id']) }}
            {!! $errors->first('updateUser_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>