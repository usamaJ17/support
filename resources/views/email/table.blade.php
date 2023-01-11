@section('css')
    @include('layout.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-hover table-bordered table-striped table-sm text-nowrap']) !!}

@section('scripts')
    @include('layout.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection



