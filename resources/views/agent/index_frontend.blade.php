@extends('layout.main')
@section('css')
@parent
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Knowldege Base</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <section class="content">
          <div class="container-fluid">
              <h2 class="text-center display-4">Search</h2>
              <div class="row">
                  <div class="col-md-8 offset-md-2">
                        {!! Form::open(['route' => 'question.search' , 'method'=>'post' , 'id'=>'question_form']) !!}
                            <div class="input-group">
                                {!! Form::select('search', $name, null, ['class'=>"form-control form-control-lg" ,'placeholder' => "Type your keywords here",'id'=>'search']) !!}
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                  </div>
              </div>
          </div>
        </section>
        <br>        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@section('scripts')
@parent
    <script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script type="text/javascript">
        $('#search').select2({
            theme: 'bootstrap4',
        })
    </script>
@endsection