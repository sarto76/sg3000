@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="container-fluid">
            <h5>{{__('course.create')}}:
            </h5>
        </div>
    </div>
    <br>

    <div class="container-fluid">
        <div class="panel panel-default p-3 mb-2 bg-light text-dark">
        @include('common.errors')

        <!-- New lesson Form -->
            <form action="{{ route('courses.store') }}" method="POST" class="form-horizontal " id="formInsertCourse" name="formInsertCourse">
            {{ csrf_field() }}



                <div class="form-group">
                </div>

                <div class="row">

                    <div class="col-sm-5">
                        <label for="type">{{__('course.type')}}</label><p>
                        {!! Form::select('type', $type, $actualTypeId) !!}
                    </div>
                    <div class="col-sm-5">
                        <label for="facebook">{{__('course.facebook')}}</label>
                        <input type="text" name="facebook" id="facebook" class="form-control" value="{{ old('facebook') }}">
                    </div>

                </div>

                <div class="form-group">
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <!-- Add lesson Button -->
                <div class="form-group">
                    <a href="{{ url()->previous() }}"class="btn btn-primary"><i class="fa fa-angle-double-left"></i>{{__('general.back')}}</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> {{__('course.create')}}
                        </button>

                </div>
            </form>
        </div>
    </div>


@endsection