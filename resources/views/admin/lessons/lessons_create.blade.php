@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="container-fluid">
            <h5>{{__('lesson.add')}}:
                @if(!is_null($course->firstLesson))
                    {{__('lesson.course')}}
                    {{__('lesson.of')}}
                    {{\Carbon\Carbon::parse($course->firstLesson->first_lesson)->format('d-m-Y')}}
                    {{__('lesson.at')}}
                    {{\Carbon\Carbon::parse($course->firstLesson->first_lesson)->format('H:i')}}
                @else
                          ( {{__('course.no_lesson')}} )
                @endif
            </h5>
            <p hidden id="maxMembers">{{$course->type->max_members}}</p>
        </div>
    </div>
    <br>

    <div class="container-fluid">
        <div class="panel panel-default p-3 mb-2 bg-light text-dark">
        @include('common.errors')

        <!-- New lesson Form -->
            <form action="{{ route('lessons.store') }}" method="POST" class="form-horizontal " id="formInsertLesson"
                  name="formInsertLesson" onsubmit="return validateLessonsCreateForm()">
                {{ csrf_field() }}


                <div class="form-group">
                </div>

                <div class="row">

                    <div class="col-sm-3">
                        <label for="instructor_id">{{__('lesson.instructor')}}</label>
                        <p>
                        {!! Form::select('instructor_id', $instructors, null) !!}
                    </div>

                    <div class="col-sm-3">
                        <label for="date_time">{{__('lesson.date_time')}}</label>
                        <div class="input-append date form_datetime ">
                            <input size="16" type="text" value="{{ old('date_time') }}" readonly id="date_time"
                                   name="date_time">
                            <span class="add-on" id="dateTimePic"><i class="fa fa-calendar"></i></span>
                            <div class="alert alert-danger" id="errorDateTime" style="display:none;"></div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="number">{{__('lesson.number')}}</label>
                        <p>
                        {!! Form::select('number', $availablesLessons, null) !!}
                    </div>
                    <div class="col-sm-3">
                        <label for="status_id">{{__('lesson.status')}}</label>
                        <p>
                        {!! Form::select('status_id', $status, null) !!}
                    </div>
                </div>


                <div class="row">
                    @include('admin.lessons.lesson_actual_members')
                </div>
                <div class="form-group">
                </div>
                <div class="row">
                    <div class="container" style="background-color: #f2f4f7;">
                        <div class="panel-body">

                            <div class="form-group">
                            </div>

                            <hr>
                            <div class="form-group">
                            </div>
                            <h6><b>{{__('member.list')}}</b></h6>
                            @include('admin.lessons.lessons_members')
                        </div>
                    </div>
                </div>


                <div class="form-group">
                </div>
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <!-- Add lesson Button -->
                <div class="form-group">
                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i
                                class="fa fa-angle-double-left"></i>{{__('general.back')}}</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> {{__('lesson.add')}}
                    </button>

                </div>
            </form>
        </div>
    </div>


@endsection