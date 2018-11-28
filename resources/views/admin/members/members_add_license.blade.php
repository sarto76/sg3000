@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="container-fluid">
            <h5>{{__('member.addLicense')}}:
            </h5>
        </div>
    </div>
    <br>

    <div class="container-fluid">
        <div class="panel panel-default p-3 mb-2 bg-light text-dark">
        @include('common.errors')

        <!-- New lesson Form -->
            <form action="{{ route('members.storeLicense') }}" method="POST" class="form-horizontal ">
                {{ csrf_field() }}
                <div class="form-group">
                </div>

                <div class="row">

                    <div class="col-sm-5">
                        <label for="type">{{__('member.licenses')}}</label><p>
                        {!! Form::select('license', $licenses, null) !!}
                    </div>
                    <div class="col-sm-5">
                        <label for="valid_from">{{__('license.valid_from')}}</label>
                        <div class="input-append date form_date">
                            <input size="16" type="text" value="{{ old('valid_from') }}" readonly id="valid_from" name="valid_from">
                            <span class="add-on"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                </div>
                <input type="hidden" name="memberId" value="{{$memberId}}">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <!-- Add lesson Button -->
                <div class="form-group">
                    <a href="{{ url()->previous() }}"class="btn btn-primary"><i class="fa fa-angle-double-left"></i>{{__('general.back')}}</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> {{__('license.add')}}
                    </button>

                </div>
            </form>
        </div>
    </div>


@endsection