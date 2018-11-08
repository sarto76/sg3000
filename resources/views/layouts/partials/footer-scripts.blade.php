
<!-- Bootstrap core JavaScript================================================= -->
<link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">

<link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<script src="{{ asset('js/tether/tether.min.js') }}" ></script>
<link rel="stylesheet" href="{{ asset('/plugins/datatables/datatables.css')}}">
<script src="{{ asset('/plugins/datatables/datatables.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('js/datetimepicker/bootstrap-datetimepicker.js') }}" charset="UTF-8"></script>

<script src="{{ asset('js/jQuery/jquery-ui.min.js') }}" charset="UTF-8"></script>
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">

<link href={{ asset('css/bootstrap-datetimepicker.css')}} rel="stylesheet" media="screen">
<script type="text/javascript" src="{{ asset('js/datetimepicker/locales/bootstrap-datetimepicker.it.js') }}" charset="UTF-8"></script>













<script type="text/javascript">
    $(document).ready(function() {
        $('.responsive-table').DataTable({
            responsive: true,
            "paging": false,
            "searching": false,
            "ordering": false,
            "language": {
                "url": "{{ asset('/plugins/datatables/lang').'/'.Config::get('app.locale').'.json'}}"
            }
        });
    });

</script>


<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: 'dd-mm-yyyy hh:ii',
        language: "<?php echo Config::get('app.locale'); ?>"
    });
</script>

<script type="text/javascript">
    $(".form_date").datetimepicker({
        minView: 2,
        format: 'dd-mm-yyyy',
        autoclose: true,
        language: "<?php echo Config::get('app.locale'); ?>"
    });
</script>


<script type="text/javascript">
    $('div.timerHide').delay(4000).slideUp(300);
</script>


<script type="text/javascript">
    $(".delete").on("submit", function(){
        return confirm('{{__('member.sureToDelete')}}');
    });

</script>

<script type="text/javascript">
    $('.coll').click(function(){
        if($(this).hasClass('fa-caret-square-o-up')){
            $(this).addClass('fa-caret-square-o-down');
            $(this).removeClass('fa-caret-square-o-up');
        }
        else if($(this).hasClass('fa-caret-square-o-down')){
            $(this).addClass('fa-caret-square-o-up');
            $(this).removeClass('fa-caret-square-o-down');
        }

    });

</script>

<script type="text/javascript">

    var table = $('#datatable-member').DataTable({
        responsive: true,
        "pageLength": 5,
        "language": {
            "url": "{{ asset('/plugins/datatables/lang').'/'.Config::get('app.locale').'.json'}}"
        },
        processing: true,
        serverSide: true,
        ajax: '{{ route('lessons.getMembers') }}',
        columns: [
            {
                "className": 'details-control',
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": ''
            },
            { data: 'id', name: 'id',visible : false },
            { data: 'nip', name: 'nip' },
            { data: 'firstname', name: 'firstname' },
            { data: 'lastname', name: 'lastname' },
            { data: 'birthdate', name: 'birthdate' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        order: [[1, 'asc']]
    });


    $('#datatable-member').on('click', '.btn-delete[data-remote]', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = $(this).data('remote');

        //alert(_token);
        if (confirm('{{__('member.sureToDelete')}}')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'json',
                data: {method: '_DELETE', submit: true}
            }).always(function (data) {
                $('#datatable-member').DataTable().draw(false);
            });
        }
    });



</script>