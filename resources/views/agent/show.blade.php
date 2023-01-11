@extends('layout.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Question</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">question</a></li>
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
                        <div class="col-md-12 col-sm-12">	<!-- Name Field -->
                            <li class="callout callout-info list-group-item mb-3 shadow">
                                <b>Question</b> <br><a class="text-left">{{$question->question}}</a>
                            </li>
                            <!-- Subject Field -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">	<!-- Name Field -->
                            <li class="callout callout-info list-group-item mb-3 shadow">
                                <b>Answer</b><span class="float-right">Author : {{$question->user->name}}</span>
                                <br>
                                {!!$question->answer!!}
                                @foreach ($question->getMedia() as $item)
                                    @if ($loop->first)
                                        <br><br><b>Files</b><br><br>
                                    @endif
                                    <a href="{{ $item->getFullUrl() }}" target="_blank">
                                        <img class="" src="{{ $item->getFullUrl() }}" style="width:250px;height:auto;border-left:thin solid #363636">
                                    </a>
                                @endforeach
                            </li>
                            <!-- Subject Field -->
                        </div>
                    </div>
                </div>
                
            </div>
          </div>

        </div><!-- /.container-fluid -->
    </div>
</div>
@endsection

