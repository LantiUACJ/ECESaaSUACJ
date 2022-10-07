<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('valorAfro') }}
            {{ Form::text('valorAfro', $afromexicano->valorAfro, ['class' => 'form-control' . ($errors->has('valorAfro') ? ' is-invalid' : ''), 'placeholder' => 'Valorafro']) }}
            {!! $errors->first('valorAfro', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('opcionAfro') }}
            {{ Form::text('opcionAfro', $afromexicano->opcionAfro, ['class' => 'form-control' . ($errors->has('opcionAfro') ? ' is-invalid' : ''), 'placeholder' => 'Opcionafro']) }}
            {!! $errors->first('opcionAfro', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('createdUser_id') }}
            {{ Form::text('createdUser_id', $afromexicano->createdUser_id, ['class' => 'form-control' . ($errors->has('createdUser_id') ? ' is-invalid' : ''), 'placeholder' => 'Createduser Id']) }}
            {!! $errors->first('createdUser_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updateUser_id') }}
            {{ Form::text('updateUser_id', $afromexicano->updateUser_id, ['class' => 'form-control' . ($errors->has('updateUser_id') ? ' is-invalid' : ''), 'placeholder' => 'Updateuser Id']) }}
            {!! $errors->first('updateUser_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>