@extends('layout.main')
@section('css')
   <!-- summernote -->
   <link rel="stylesheet" href="{{url('plugins/summernote/summernote-bs4.min.css')}}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Edit Question</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('question.index')}}">knowledge-base</a></li>
                <li class="breadcrumb-item active">edit</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Enter Details</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::model($question , ['route' => ['question.update', $question->id],'method' => 'patch', 'files' => true , 'id'=>'question_form']) !!}
                  @include('question.fields')
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </div>
</div>
      <!-- /.content -->
@endsection
@section('scripts')
<script src="{{url('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Page specific script -->
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote({
        height: 200,                 // set editor height
        focus: true                  // set focus to editable area after initializing summernote
    });
  })
</script>
@endsection
