@section('css')
    @include('layout.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-hover table-bordered table-striped table-sm text-nowrap']) !!}

@section('scripts')
    @include('layout.datatables_js')
    {!! $dataTable->scripts() !!}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // console.log($('#status_form'));
        function changeStatus(id){
            var url = "{{ route('ticket.status')}}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    type: "POST",
                    url: url,
                    data: {"id":id},
                    success: function (msg) {
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
                            title: 'Ticket Status Changed Successfully!'
                        });
                        window.LaravelDataTables["dataTableBuilder"].draw(false);
                    },
                    error: function (data) {
                        $("#ticket_submit").text('Submit');
                        var response = JSON.parse(data.responseText);
                        var errorString = 'There is some error in updation';
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: errorString,
                        })                  
                    }
                });
        }
        function change(agent_id,id){
            var url = "{{ route('ticket.agent_update')}}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    "id":id,
                    "agent_id":agent_id
                },
                success: function (msg) {
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
                        title: 'Ticket Agent Changed Successfully!'
                    });
                    window.LaravelDataTables["dataTableBuilder"].draw(false);
                },
                error: function (data) {
                    $("#ticket_submit").text('Submit');
                    var response = JSON.parse(data.responseText);
                    var errorString = 'There is some error in updation';
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: errorString,
                    })                  
                }
            });
        }
        // $(function () {
        //     $('#status_form').on('submit', function (e) {
        //         e.preventDefault();
        //     });
        // })

    </script>
@endsection



