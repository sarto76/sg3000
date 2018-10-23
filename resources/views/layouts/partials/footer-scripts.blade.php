
<!-- Bootstrap core JavaScript

================================================= -->

<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('js/jQuery/jquery-3.3.1.min.js') }}" ></script>
<script src="{{ asset('js/tether/tether.min.js') }}" ></script>
<script src="{{ asset('js/bootstrap-4.0/bootstrap.min.js') }}" ></script>
<!-- Bootstrap Core CSS -->
<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="{{ asset('css/bootstrap-4.0//bootstrap.min.css') }}">

<!-- Personal Scripts

================================================= -->



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



