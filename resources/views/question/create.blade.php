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
              <h1 class="m-0">Add Question</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('question.index')}}">knowledge-base</a></li>
                <li class="breadcrumb-item active">create</li>
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
               

                {!! Form::open(['route' => 'question.store', 'files' => true , 'id'=>'question_form']) !!}
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
    <script>
        var url = "{{ route('question.store') }}";
        $('#question_form').on('submit', function (e) {
            e.preventDefault();
            $("#question_submit").text('Sending ...');
            $.ajax({
                type: "POST",
                url: url,
                data: new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (msg) {
                    $("#question_submit").text('Submit');
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-right',
                        customClass: {
                            popup: 'colored-toast'
                        },
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true
                    })
                    Toast.fire({
                        iconColor: 'green',
                        icon: 'success',
                        title: 'Question Added Successfully!'
                    });
                    $("#question_form")[0].reset();
                    $('#summernote').summernote('code', "");
                },
                error: function (data) {
                    $("#question_submit").text('Submit');
                    var response = JSON.parse(data.responseText);
                    var errorString = '<ul class="list-disc">';
                    $.each(response.errors, function (key, value) {
                        errorString += '<li class="font-mono text-red-700">' + value + '</li>';
                    });
                    errorString += '</ul>';
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: errorString,
                    })                  
                }
            });
        });
    </script>
@endsection
