<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('valorProg') }}
            {{ Form::text('valorProg', $programasmymg->valorProg, ['class' => 'form-control' . ($errors->has('valorProg') ? ' is-invalid' : ''), 'placeholder' => 'Valorprog']) }}
            {!! $errors->first('valorProg', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('opcionProg') }}
            {{ Form::text('opcionProg', $programasmymg->opcionProg, ['class' => 'form-control' . ($errors->has('opcionProg') ? ' is-invalid' : ''), 'placeholder' => 'Opcionprog']) }}
            {!! $errors->first('opcionProg', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('createdUser_id') }}
            {{ Form::text('createdUser_id', $programasmymg->createdUser_id, ['class' => 'form-control' . ($errors->has('createdUser_id') ? ' is-invalid' : ''), 'placeholder' => 'Createduser Id']) }}
            {!! $errors->first('createdUser_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updateUser_id') }}
            {{ Form::text('updateUser_id', $programasmymg->updateUser_id, ['class' => 'form-control' . ($errors->has('updateUser_id') ? ' is-invalid' : ''), 'placeholder' => 'Updateuser Id']) }}
            {!! $errors->first('updateUser_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>