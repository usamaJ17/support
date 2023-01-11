@extends('layout.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Send Email</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">email</a></li>
                <li class="breadcrumb-item active">send</li>
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
                          {!! Form::label('subject',"Subject") !!}
                          {!! Form::text('subject', null, ['class' =>  'form-control', 'id' => 'subject' ]) !!}
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('email',"Email") !!}
                            {!! Form::text('email',null, ['class' =>  'form-control', 'id' => 'email' ]) !!}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('body',"Mail Body") !!}
                            {!! Form::textarea('body', null, ['class' =>  'form-control', 'id' => 'body']) !!}
                        </div>
                      </div>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var url = "{{ route('email.store') }}";
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
                        title: 'Email Sent Successfully!'
                    });
                    $("#ticket_form")[0].reset();
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
