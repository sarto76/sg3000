@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="container-fluid">
            <h5>{{__('member.edit')}}</h5>
        </div>
    </div>
    <div class="form-group">
    </div>
    <div class="container-fluid">
        @include('common.errors')
        <div class="row">
            <div class="col-12">
                <div class="panel panel-white">
                    <div class="form-group"></div>
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" href="#tab1"
                                                    data-toggle="tab">{{__('member.details')}}</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab2"
                                                    data-toggle="tab">{{__('member.licenses')}}</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab3"
                                                    data-toggle="tab">{{__('member.courses')}}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1" role="tabpanel">
                                <div class="panel panel-default p-3 mb-2 bg-light text-dark">
                                    <div class="form-group"></div>

                                    {!! Form::model($member, ['method' => 'PUT','route' => ['members.update', $member->id]]) !!}
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="PUT">
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
                                    <!-- Add Member Button -->
                                    <div class="form-group">
                                        <a href="{{ url()->previous() }}" class="btn btn-primary"><i
                                                    class="fa fa-angle-double-left"></i>{{__('general.back')}}</a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa"></i> {{__('member.update')}}
                                        </button>

                                    </div>

                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2" role="tabpanel">
                                @include('admin.members.members_edit_licenses')
                            </div>
                            <div class="tab-pane" id="tab3" role="tabpanel">
                                @include('admin.members.members_edit_lessons')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection