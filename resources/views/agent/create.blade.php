@extends('layout.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Add Agent</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('agent.index')}}">agent</a></li>
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
               

                {!! Form::open(['route' => 'agent.store', 'files' => true , 'id'=>'agent_form']) !!}
                  @include('agent.fields')
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
<!-- Page specific script -->
    <script>
        var url = "{{ route('agent.store') }}";
        $('#agent_form').on('submit', function (e) {
            e.preventDefault();
            $("#agent_submit").text('Sending ...');
            $.ajax({
                type: "POST",
                url: url,
                data: new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (msg) {
                    $("#agent_submit").text('Submit');
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
                        title: 'Agent Added Successfully!'
                    });
                    $("#agent_form")[0].reset();
                    $('#summernote').summernote('code', "");
                },
                error: function (data) {
                    $("#agent_submit").text('Submit');
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
