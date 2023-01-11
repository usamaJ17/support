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
              <h1 class="m-0">Submit Ticket</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">tickets</a></li>
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
               

                {!! Form::open(['route' => 'ticket.store', 'files' => true , 'id'=>'ticket_form']) !!}
                <input type="hidden" name='user_id' value="{{session()->get('id')}}">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          {!! Form::label('name',"Name") !!}
                          {!! Form::text('name', session()->get('name'), ['class' =>  'form-control', 'id' => 'name' ,"readonly" ]) !!}
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('email',"Email") !!}
                            {!! Form::text('email', session()->get('email'), ['class' =>  'form-control', 'id' => 'name' ,"readonly" ]) !!}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('subject',"Subject") !!}
                            {!! Form::text('subject', null, ['class' =>  'form-control', 'id' => 'subject']) !!}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('department',"Department") !!}
                            {!! Form::select('department', config('enum.ticket_department'),null, ['class' =>  'form-control', 'id' => 'department']) !!}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('service',"Service") !!}
                            {!! Form::select('service', config('enum.ticket_service'), null, ['class' =>  'form-control', 'id' => 'department']) !!}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('priority',"Priority") !!}
                            {!! Form::select('priority', config('enum.ticket_priority'),null, ['class' =>  'form-control', 'id' => 'department']) !!}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('message',"Message") !!}
                            {!! Form::textarea('message', null , ['id' => 'summernote']) !!}
                        </div>
                      </div>
                      <!-- /.col-->
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="custom-file">
                                {!! Form::file('file',  ['class' => 'custom-file-input']) !!}
                                {!! Form::label('file',"Choose file",['class' => 'custom-file-label']) !!}
                            </div>
                          </div>
                        </div>
                        <!-- /.col-->
                      </div>
                  <!-- /.card-body -->
  
                  <div >
                    {!! Form::submit("Submit", ['class'=>"btn btn-primary" , 'id'=>'ticket_submit']) !!}
                  </div>
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
        var url = "{{ route('ticket.store') }}";
        $('#ticket_form').on('submit', function (e) {
            e.preventDefault();
            $("#ticket_submit").text('Sending ...');
            $.ajax({
                type: "POST",
                url: url,
                data: new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (msg) {
                    $("#ticket_submit").text('Submit');
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
                        title: 'Ticket Created Successfully!'
                    });
                    $("#ticket_form")[0].reset();
                    $('#summernote').summernote('code', "");
                },
                error: function (data) {
                    $("#ticket_submit").text('Submit');
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
