
<!-- Bootstrap core JavaScript

================================================= -->

<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('js/jQuery/jquery-3.3.1.min.js') }}" ></script>
<script src="{{ asset('js/tether/tether.min.js') }}" ></script>
<script src="{{ asset('js/bootstrap-4.0/bootstrap.min.js') }}" ></script>
<!-- Bootstrap Core CSS -->
<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="{{ asset('css/bootstrap-4.0/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">

<link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">


<link rel="stylesheet" href="{{ asset('/plugins/datatables/datatables.css')}}">
<script src="{{ asset('/plugins/datatables/datatables.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('js/datetimepicker/bootstrap-datetimepicker.js') }}" charset="UTF-8"></script>

<script src="{{ asset('js/jQuery/jquery-ui.min.js') }}" charset="UTF-8"></script>
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">

<link href={{ asset('css/bootstrap-datetimepicker.css')}} rel="stylesheet" media="screen">
<script type="text/javascript" src="{{ asset('js/datetimepicker/locales/bootstrap-datetimepicker.it.js') }}" charset="UTF-8"></script>



<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
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

<!--
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable({
            responsive: true,

            "language": {
                "url": "{{ asset('/plugins/datatables/lang').'/'.Config::get('app.locale').'.json'}}"
            },

            "processing": true,
            "serverSide": true,
            "ajax": "{{ Illuminate\Support\Facades\URL::to('/').'/api/member'}}"

        });
    });


<script type="text/javascript">

    $(document).ready(function() {
        $('#datatable-member').DataTable({
            responsive: true,

            "language": {
                "url": "{{ asset('/plugins/datatables/lang').'/'.Config::get('app.locale').'.json'}}"
            },
            processing: true,
            serverSide: true,
            ajax: '{{ route('members.index') }}',
            columns: [
                { data: 'email', name: 'email' },
                { data: 'firstname', name: 'firstname' },
                { data: 'lastname', name: 'lastname' },
                { data: 'address', name: 'address' },
                { data: 'zip', name: 'zip' },
                { data: 'city', name: 'city' },
                { data: 'phone', name: 'phone' },
                { data: 'mobile', name: 'mobile' },
                { data: 'work', name: 'work' },
                { data: 'birthdate', name: 'birthdate' }
            ]
        });
    });
</script>
-->

<script type="text/javascript">

    var table = $('#datatable-member').DataTable({
        responsive: true,
        "language": {
            "url": "{{ asset('/plugins/datatables/lang').'/'.Config::get('app.locale').'.json'}}"
        },
        processing: true,
        serverSide: true,
        ajax: '{{ route('members.anydata') }}',
        columns: [
            {
                "className": 'details-control',
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": ''
            },
            { data: 'id', name: 'id' },
            { data: 'email', name: 'email' },
            { data: 'firstname', name: 'firstname' },
            { data: 'lastname', name: 'lastname' },
            { data: 'address', name: 'address' },
            { data: 'zip', name: 'zip' },
            { data: 'city', name: 'city' },
            { data: 'phone', name: 'phone' },
            { data: 'mobile', name: 'mobile' },
            { data: 'work', name: 'work' },
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
        if (confirm('{{__('member.sure_to_delete')}}')) {
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


    //table.on('draw.dt', function (e) {alert('test')});
    $('div.timerHide').delay(4000).slideUp(300);



</script>
