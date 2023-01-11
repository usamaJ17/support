<input type="hidden" name='user_id' value="{{session()->get('id')}}">
<div class="card-body">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {!! Form::label('question',"Question") !!}
        {!! Form::text('question', null, ['class' =>  'form-control', 'id' => 'question']) !!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
          {!! Form::label('answer',"Answer Detail") !!}
          {!! Form::textarea('answer', null , ['id' => 'summernote']) !!}
      </div>
    </div>
    <!-- /.col-->
  </div>  
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <div class="custom-file">
            {!! Form::file('file',  ['class' => 'custom-file-input']) !!}
            {!! Form::label('Optional File',"Choose file",['class' => 'custom-file-label']) !!}
        </div>
      </div>
    </div>
    <!-- /.col-->
  </div>
<div >
  {!! Form::submit("Submit", ['class'=>"btn btn-primary" , 'id'=>'question_submit']) !!}
</div>