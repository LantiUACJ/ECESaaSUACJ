<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">    
            {{ Form::label('valorDH') }}
            {{ Form::text('valorDH', $derechohabiencia->valorDH, ['class' => 'form-control' . ($errors->has('valorDH') ? ' is-invalid' : ''), 'placeholder' => 'Valordh', 'onkeypress' => "return /[0-9]/i.test(event.key)", 'maxlength' => 2]) }}
            {!! $errors->first('valorDH', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombreDH') }}
            {{ Form::text('nombreDH', $derechohabiencia->nombreDH, ['class' => 'form-control' . ($errors->has('nombreDH') ? ' is-invalid' : ''), 'placeholder' => 'Nombredh', 'onkeypress' => "return /[A-Z ÁÉÍÓÚÑ]/i.test(event.key)", 'oninput'=>"this.value = this.value.toUpperCase()", 'maxlength' => 200]) }}
            {!! $errors->first('nombreDH', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('siglaDH') }}
            {{ Form::text('siglaDH', $derechohabiencia->siglaDH, ['class' => 'form-control' . ($errors->has('siglaDH') ? ' is-invalid' : ''), 'placeholder' => 'Sigladh', 'onkeypress' => "return /[A-Z ÁÉÍÓÚÑ]/i.test(event.key)", 'oninput'=>"this.value = this.value.toUpperCase()", 'maxlength' => 50]) }}
            {!! $errors->first('siglaDH', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::text('createdUser_id', $derechohabiencia->createdUser_id, ['class' => 'form-control' . ($errors->has('createdUser_id') ? ' is-invalid' : ''), 'placeholder' => 'Createduser Id', 'readonly' => 'true', 'hidden'=>'true']) }}
            {!! $errors->first('createdUser_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::text('updateUser_id', $derechohabiencia->updateUser_id, ['class' => 'form-control' . ($errors->has('updateUser_id') ? ' is-invalid' : ''), 'placeholder' => 'Updateuser Id', 'readonly' => 'true', 'hidden'=>'true']) }}
            {!! $errors->first('updateUser_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>