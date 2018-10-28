@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="container">
        <div class="panel panel-default">
        @include('common.errors')

        <!-- New member Form -->

            <form method="POST" action="{{ route('members.update', ['member' => $id]) }}" data-parsley-validate class="form-horizontal form-label-left">
            {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
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
                            <input type="text" name="firstname" id="firstname" class="form-control" value="{{ $member->firstname }}">
                    </div>
                    <div class="col">
                            <label for="lastname">{{__('member.lastname')}}</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $member->lastname }}">
                    </div>

                </div>
                <div class="form-group">
                </div>

                <div class="row">

                    <div class="col">
                        <label for="birthdate">{{__('member.birthdate')}}</label>


                        <div class="input-append date form_date">
                            <input size="16" type="text" value="{{ \Carbon\Carbon::parse($member->birthdate)->format('d-m-Y') }}" readonly id="birthdate" name="birthdate">
                            <span class="add-on"><i class="fa fa-calendar"></i></span>
                        </div>


                    </div>
                    <div class="form-group">
                    </div>
                    <div class="col">
                        <label for="email">{{__('member.email')}}</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ $member->email }}">
                    </div>
                </div>
                <div class="col-xs-12">
                    <label for="address">{{__('member.address')}}</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ $member->address }}">
                </div>
                <div class="row">
                    <div class="col">
                        <label for="zip">{{__('member.zip')}}</label>
                        <input type="number" name="zip" id="zip" class="form-control" min="1000" max="9999" value="{{ $member->zip }}">
                    </div>
                    <div class="col">
                        <label for="city">{{__('member.city')}}</label>
                        <input type="text" name="city" id="city" class="form-control" value="{{ $member->city }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="phone">{{__('member.phone')}}</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $member->phone }}">
                    </div>
                    <div class="col">
                        <label for="mobile">{{__('member.mobile')}}</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" value="{{ $member->mobile }}">
                    </div>
                </div>
                <div class="col-xs-6">
                    <label for="work">{{__('member.work')}}</label>
                    <input type="text" name="work" id="work" class="form-control" value="{{ $member->work }}">
                </div>


                <div class="form-group">
                </div>

                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <!-- Add Member Button -->
                <div class="form-group">

                        <button type="submit" class="btn btn-primary">
                            <i class="fa"></i> {{__('member.update')}}
                        </button>

                </div>
            </form>
        </div>
    </div>


@endsection