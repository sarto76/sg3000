

@if (Session::has('info'))
    <div class="clearfix"></div>
    <div class="alert alert-info timerHide" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! Session::get('info') !!}
    </div>
@endif

@if (Session::has('success'))
    <div class="clearfix"></div>
    <div class="alert alert-success timerHide" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! Session::get('success') !!}
    </div>
@endif

@if (Session::has('warning'))
    <div class="clearfix"></div>
    <div class="alert alert-warning timerHide" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! Session::get('warning') !!}
    </div>
@endif

@if (Session::has('error'))
    <div class="clearfix"></div>
    <div class="alert alert-danger timerHide" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! Session::get('error') !!}
    </div>
@endif