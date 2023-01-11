@extends('layout.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Submit Ticket</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/ticket')}}">tickets</a></li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        {{-- @include('flash::message') --}}
        <div class="bg-white card-primary">
            <div class="card-header">
                <h3 class="card-title">Tickets Detail</h3>
            </div>
            <div class="card-body table-responsive" >
                @include('ticket.table')
            </div>
        </div>
</div>
@endsection
