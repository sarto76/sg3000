@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="container">
        <div class="panel panel-default">
        @include('common.errors')

        <!-- New member Form -->
            <form action="{{ route('member.store') }}" method="POST" class="form-horizontal ">
            {{ csrf_field() }}


                <div class="form-group">
                </div>
                <div class="col-xs-8">
                    <label for="title">{{__('member.title')}}</label>
                    {!! Form::select('title', array('m' => \Illuminate\Support\Facades\Lang::get('member.mr'), 'f' => \Illuminate\Support\Facades\Lang::get('member.ms')), 'm'); !!}
                </div>

                <div class="row">
                    <div class="form-group">
                    </div>
                    <div class="col">
                        <label for="firstname">{{__('member.firstname')}}</label>
                            <input type="text" name="firstname" id="firstname" class="form-control">
                    </div>
                    <div class="col">
                            <label for="lastname">{{__('member.lastname')}}</label>
                            <input type="text" name="lastname" id="lastname" class="form-control">
                    </div>

                </div>
                <div class="form-group">
                </div>

                <div class="row">

                    <div class="col">
                        <label for="birthdate">{{__('member.birthdate')}}</label>
                        <div class="form-group">
                        {!! Form::text('date', '', array('class' => 'form_date','id' => 'birthdate','name' => 'birthdate','data-date-format' =>'dd-mm-yyyy')) !!}
                        </div>

                        <input size="16" type="text" value="2012-06-15" readonly class="form_date" id="birthdate" data-date-format="yyyy-mm-dd" name="birthdate">

                    </div>
                    <div class="form-group">
                    </div>
                    <div class="col">
                        <label for="email">{{__('member.email')}}</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12">
                    <label for="address">{{__('member.address')}}</label>
                    <input type="text" name="address" id="address" class="form-control">
                </div>
                <div class="row">
                    <div class="col">
                        <label for="zip">{{__('member.zip')}}</label>
                        <input type="number" name="zip" id="zip" class="form-control" min="1000" max="9999">
                    </div>
                    <div class="col">
                        <label for="city">{{__('member.city')}}</label>
                        <input type="text" name="city" id="city" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="phone">{{__('member.phone')}}</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>
                    <div class="col">
                        <label for="mobile">{{__('member.mobile')}}</label>
                        <input type="text" name="mobile" id="mobile" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6">
                    <label for="work">{{__('member.work')}}</label>
                    <input type="text" name="work" id="work" class="form-control">
                </div>


                <div class="form-group">
                </div>

                <!-- Add Member Button -->
                <div class="form-group">

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> {{__('member.add')}}
                        </button>

                </div>
            </form>
        </div>
    </div>


@endsection