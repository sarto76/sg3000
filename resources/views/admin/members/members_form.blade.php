{{ csrf_field() }}
<div class="col-xs-8">
    <label for="title">{{__('member.title')}}</label>
    {!! Form::select('title', array('m' => \Illuminate\Support\Facades\Lang::get('member.mr'), 'f' => \Illuminate\Support\Facades\Lang::get('member.ms')), 'm'); !!}
</div>

<div class="row">
    <div class="form-group">
    </div>
    <div class="col">
        {!! Form::label('firstname', __('member.firstname'), array('class' => 'awesome')); !!}
        {!! Form::text('firstname', old('firstname'), array('class' => 'form-control')); !!}

    </div>
    <div class="col">
        {!! Form::label('lastname', __('member.lastname'), array('class' => 'awesome')); !!}
        {!! Form::text('lastname', old('lastname'), array('class' => 'form-control')); !!}
    </div>

</div>
<div class="form-group">
</div>

<div class="row">

    <div class="col">
        {!! Form::label('birthdate', __('member.birthdate'), array('class' => 'awesome')); !!}

        <div class="input-append date form_date">


            {!! Form::text('birthdate', old('birthdate'), array('size' => '16')); !!}
            <span class="add-on"><i class="fa fa-calendar"></i></span>
        </div>


    </div>
    <div class="form-group">
    </div>
    <div class="col">
        {!! Form::label('email', __('member.email'), array('class' => 'awesome')); !!}
        {!! Form::text('email', old('email'), array('class' => 'form-control')); !!}
    </div>
</div>
<div class="col-xs-12">
    {!! Form::label('address', __('member.address'), array('class' => 'awesome')); !!}
    {!! Form::text('address', old('address'), array('class' => 'form-control')); !!}
</div>
<div class="form-group">
</div>
<div class="row">
    <div class="col">
        {!! Form::label('zip', __('member.zip'), array('class' => 'awesome')); !!}
        {!! Form::text('zip', old('zip'), array('class' => 'form-control', 'min' => '1000', 'max' => '9999' )); !!}
    </div>
    <div class="col">
        {!! Form::label('city', __('member.city'), array('class' => 'awesome')); !!}
        {!! Form::text('city', old('city'), array('class' => 'form-control')); !!}
    </div>
</div>
<div class="row">
    <div class="col">
        {!! Form::label('phone', __('member.phone'), array('class' => 'awesome')); !!}
        {!! Form::text('phone', old('phone'), array('class' => 'form-control')); !!}
    </div>
    <div class="col">
        {!! Form::label('mobile', __('member.mobile'), array('class' => 'awesome')); !!}
        {!! Form::text('mobile', old('mobile'), array('class' => 'form-control')); !!}
    </div>
</div>
<div class="col-xs-6">
    {!! Form::label('work', __('member.work'), array('class' => 'awesome')); !!}
    {!! Form::text('work', old('work'), array('class' => 'form-control')); !!}
</div>


<div class="form-group">
</div>

<input type="hidden" name="_token" value="{{ Session::token() }}">

<div class="form-group">
    <a href="{{ url()->previous() }}" class="btn btn-primary"><i
                class="fa fa-angle-double-left"></i>{{__('general.back')}}</a>

    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
</div>

