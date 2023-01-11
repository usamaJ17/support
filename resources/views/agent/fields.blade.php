<input type="hidden" name="role" value="agent">
<div class="card-body">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {!! Form::label('name',"Name") !!}
        {!! Form::text('name', null, ['class' =>  'form-control', 'id' => 'name']) !!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
          {!! Form::label('email',"Email") !!}
          {!! Form::email('email', null , ['class' =>  'form-control','id' => 'email']) !!}
      </div>
    </div>
    <!-- /.col-->
  </div> 
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
          {!! Form::label('password',"Password") !!}
          {!! Form::password('password', ['class' =>  'form-control','id' => 'password']) !!}
      </div>
    </div>
    <!-- /.col-->
  </div>  
<div >
  {!! Form::submit("Submit", ['class'=>"btn btn-primary" , 'id'=>'agent_submit']) !!}
</div>