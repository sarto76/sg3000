@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="container">
            <h4>{{__('member.add')}}</h4>
        </div>
    </div>
    <br>
    <div class="form-group">
    </div>
    <div class="container">
        <div class="panel panel-default p-3 mb-2 bg-light text-dark">
        @include('common.errors')

        <!-- New member Form -->
            <form action="{{ route('members.store') }}" method="POST" class="form-horizontal ">
            {{ csrf_field() }}


                <div class="form-group">
                </div>
                <div class="row">
                    <div class="form-group">
                    </div>
                    <div class="col">
                    <label for="title">{{__('member.title')}}</label>
                    {!! Form::select('title', array('m' => \Illuminate\Support\Facades\Lang::get('member.mr'), 'f' => \Illuminate\Support\Facades\Lang::get('member.ms')), 'm'); !!}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                    </div>
                    <div class="col">
                        <label for="firstname">{{__('member.firstname')}}</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname') }}">
                    </div>
                    <div class="col">
                            <label for="lastname">{{__('member.lastname')}}</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}">
                    </div>

                </div>
                <div class="form-group">
                </div>

                <div class="row">

                    <div class="col">
                        <label for="birthdate">{{__('member.birthdate')}}</label>


                        <div class="input-append date form_date">
                            <input size="16" type="text" value="{{ old('birthdate') }}" readonly id="birthdate" name="birthdate">
                            <span class="add-on"><i class="fa fa-calendar"></i></span>
                        </div>


                    </div>
                    <div class="form-group">
                    </div>
                    <div class="col">
                        <label for="email">{{__('member.email')}}</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="col-xs-12">
                    <label for="address">{{__('member.address')}}</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                </div>
                <div class="row">
                    <div class="col">
                        <label for="zip">{{__('member.zip')}}</label>
                        <input type="number" name="zip" id="zip" class="form-control" min="1000" max="9999" value="{{ old('zip') }}">
                    </div>
                    <div class="col">
                        <label for="city">{{__('member.city')}}</label>
                        <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="phone">{{__('member.phone')}}</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                    <div class="col">
                        <label for="mobile">{{__('member.mobile')}}</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile') }}">
                    </div>
                </div>
                <div class="col-xs-6">
                    <label for="work">{{__('member.work')}}</label>
                    <input type="text" name="work" id="work" class="form-control" value="{{ old('work') }}">
                </div>


                <div class="form-group">
                </div>

                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <!-- Add Member Button -->
                <div class="form-group">
                    <a href="{{ url()->previous() }}"class="btn btn-primary"><i class="fa fa-angle-double-left"></i>{{__('general.back')}}</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> {{__('member.add')}}
                        </button>

                </div>
            </form>
        </div>
    </div>


@endsection