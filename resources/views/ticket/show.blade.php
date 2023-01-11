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
              <h1 class="m-0">Ticket</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">tickets</a></li>
                <li class="breadcrumb-item active">show</li>
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
                  <h3 class="card-title">Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">	<!-- Name Field -->
                            <li class="callout callout-info list-group-item mb-3 shadow">
                                <b>Name</b> <br><a class="text-left">{{$ticket->name}}</a>
                            </li>
                            <!-- Subject Field -->
                        </div>
                        <div class="col-md-4 col-sm-4">	<!-- Name Field -->
                            <li class="callout callout-info list-group-item mb-3 shadow">
                                <b>Email</b> <br><a class="text-left">{{$ticket->email}}</a>
                            </li>
                            <!-- Subject Field -->
                        </div>
                        <div class="col-md-4 col-sm-4">	<!-- Name Field -->
                            <li class="callout callout-info list-group-item mb-3 shadow">
                                <b>Status</b> <br><a class="text-left">{{($ticket->status)? "Open" : "Closed"}}</a>
                            </li>
                            <!-- Subject Field -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">	<!-- Name Field -->
                            <li class="callout callout-info list-group-item mb-3 shadow">
                                <b>Subject</b> <br><a class="text-left">{{$ticket->subject}}</a>
                            </li>
                            <!-- Subject Field -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">	<!-- Name Field -->
                            <li class="callout callout-info list-group-item mb-3 shadow">
                                <b>Department</b> <br><a class="text-left">{{$ticket->department}}</a>
                            </li>
                            <!-- Subject Field -->
                        </div>
                        <div class="col-md-4 col-sm-4">	<!-- Name Field -->
                            <li class="callout callout-info list-group-item mb-3 shadow">
                                <b>Service</b> <br><a class="text-left">{{$ticket->service}}</a>
                            </li>
                            <!-- Subject Field -->
                        </div>
                        <div class="col-md-4 col-sm-4">	<!-- Name Field -->
                            <li class="callout callout-info list-group-item mb-3 shadow">
                                <b>Priority</b> <br><a class="text-left">{{$ticket->priority}}</a>
                            </li>
                            <!-- Subject Field -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">	<!-- Name Field -->
                            <li class="callout callout-info list-group-item mb-3 shadow">
                                <b>Message</b><span class="float-right">{{$ticket->created_at->diffForHumans() }}</span>
                                <br>
                                {!!$ticket->message!!}
                                <br><br><b>Files</b><br><br>
                                @foreach ($ticket->getMedia() as $item)
                                        <a href="{{ $item->getFullUrl() }}" target="_blank">
                                                <img class="" src="{{ $item->getFullUrl() }}" style="width:150px;height:auto;border-left:thin solid #363636">
                                        </a>
                                @endforeach
                            </li>
                            <!-- Subject Field -->
                        </div>
                    </div>
                    @foreach ($replies as $reply)
                        @if ($loop->first)
                            <b>Replies :</b>
                        @endif
                        <div class="row">
                            <div class="col-md-12 col-sm-12">	<!-- Name Field -->
                                <li class="callout callout-info list-group-item mb-3 shadow">
                                    <b>{{($reply->user->id==session()->get('id'))? "You" : $reply->user->name}}</b> <span class="float-right">{{$reply->created_at->diffForHumans() }}</span> 
                                    <br>
                                    {!!$reply->message!!}
                                    @foreach ($reply->getMedia() as $item)
                                            <b>Files</b><br>
                                            <a href="{{ $item->getFullUrl() }}" target="_blank">
                                                    <img class="" src="{{ $item->getFullUrl() }}" style="width:150px;height:auto;border-left:thin solid #363636">
                                            </a>
                                    @endforeach
                                </li>
                                <!-- Subject Field -->
                            </div>
                        </div>
                    @endforeach
                    <div class="card card-primary collapsed-card" id="reply_div">
                        <div class="card-header">
                          <h3 class="card-title">Reply</h3>
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                            </button>
                          </div>
                      
                        </div>
                      
                        <div class="card-body">
                            {!! Form::open(['route' => 'reply.store', 'files' => true , 'id'=>'reply_form']) !!}
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                      {!! Form::textarea('message', null , ['id' => 'summernote']) !!}
                                  </div>
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
                            <div >
                                {!! Form::submit("Submit", ['class'=>"btn btn-primary" , 'id'=>'reply_submit']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                      
                    </div>
                </div>
                
            </div>
          </div>

        </div><!-- /.container-fluid -->
    </div>
</div>
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
        var url = "{{ route('reply.store') }}";
        $('#reply_form').on('submit', function (e) {
            e.preventDefault();
            $("#reply_submit").text('Sending ...');
            $.ajax({
                type: "POST",
                url: url,
                data: new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (msg) {
                    $("#reply_submit").text('Submit');
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
                        title: 'Reply Send Successfully!'
                    });
                    $("#reply_form")[0].reset();
                    $('#summernote').summernote('code', "");
                },
                error: function (data) {
                    $("#reply_submit").text('Submit');
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

