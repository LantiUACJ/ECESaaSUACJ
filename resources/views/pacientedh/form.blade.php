<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('pacientes_id') }}
            {{ Form::text('pacientes_id', $pacientedh->pacientes_id, ['class' => 'form-control' . ($errors->has('pacientes_id') ? ' is-invalid' : ''), 'placeholder' => 'Pacientes Id']) }}
            {!! $errors->first('pacientes_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('derechoHabiencias_id') }}
            {{ Form::text('derechoHabiencias_id', $pacientedh->derechoHabiencias_id, ['class' => 'form-control' . ($errors->has('derechoHabiencias_id') ? ' is-invalid' : ''), 'placeholder' => 'Derechohabiencias Id']) }}
            {!! $errors->first('derechoHabiencias_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('createdUser_id') }}
            {{ Form::text('createdUser_id', $pacientedh->createdUser_id, ['class' => 'form-control' . ($errors->has('createdUser_id') ? ' is-invalid' : ''), 'placeholder' => 'Createduser Id']) }}
            {!! $errors->first('createdUser_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updateUser_id') }}
            {{ Form::text('updateUser_id', $pacientedh->updateUser_id, ['class' => 'form-control' . ($errors->has('updateUser_id') ? ' is-invalid' : ''), 'placeholder' => 'Updateuser Id']) }}
            {!! $errors->first('updateUser_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>