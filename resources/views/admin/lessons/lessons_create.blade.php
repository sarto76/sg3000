@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="container-fluid">
            <h5>{{__('lesson.add')}}:
                {{__('lesson.course')}}
                {{__('lesson.of')}}
                {{\Carbon\Carbon::parse($course->firstLesson->first_lesson)->format('d-m-Y')}}
                {{__('lesson.at')}}
                {{\Carbon\Carbon::parse($course->firstLesson->first_lesson)->format('H:i')}}
            </h5>
        </div>
    </div>
    <br>

    <div class="container-fluid">
        <div class="panel panel-default p-3 mb-2 bg-light text-dark">
        @include('common.errors')

        <!-- New lesson Form -->
            <form action="{{ route('lessons.store') }}" method="POST" class="form-horizontal ">
            {{ csrf_field() }}

                <div class="row">
                    <div class="form-group">
                    </div>
                    <div class="col">
                    <label for="title">{{__('lesson.instructor')}}</label>
                        {!! Form::select('instructor', $instructors, null) !!}
                    </div>
                </div>

                <div class="form-group">
                </div>

                <div class="row">

                    <div class="col">
                        <label for="date_time">{{__('lesson.date_time')}}</label>


                        <div class="input-append date form_datetime">
                            <input size="16" type="text" value="{{ old('date_time') }}" readonly id="date_time" name="date_time">
                            <span class="add-on"><i class="fa fa-calendar"></i></span>
                        </div>


                    </div>
                    <div class="form-group">
                    </div>
                    <div class="col">
                        <label for="number">{{__('lesson.number')}}</label>
                        <input type="number" max="10" name="number" id="number" class="form-control" value="{{ old('number') }}">
                    </div>
                </div>



                <div class="form-group">
                </div>
                <input type="hidden" name="course_status_id" value="{{ $course->course_status_id }}">
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <!-- Add lesson Button -->
                <div class="form-group">
                    <a href="{{ url()->previous() }}"class="btn btn-primary"><i class="fa fa-angle-double-left"></i>{{__('general.back')}}</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> {{__('lesson.add')}}
                        </button>

                </div>
            </form>
        </div>
    </div>


@endsection