@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="container-fluid">
            <h5>{{__('member.manage_inscriptions')}}:
            </h5>
        </div>
    </div>
    <br>

    <div class="container-fluid">
        <div class="panel panel-default p-3 mb-2 bg-light text-dark">
            @include('common.errors')
            <div class="table-responsive" id="edit_license_member">
                <h5>
                    {{__('license.category')}}
                    {{ $licenseMember->license->description}}
                </h5>
                @if (count($courses) > 0)
                    @foreach($courses as $course)
                        <br>
                        <div class="form-group"></div>

                        <h6 style="display:inline;margin:0px;padding:0px;"><b>&nbsp;
                                #{{$course->id}}
                                {{__('lesson.course').' '.$course->type->description}}
                                @if(!is_null($course->firstLesson))
                                    {{__('lesson.of')}}
                                    {{\Carbon\Carbon::parse($course->firstLesson->first_lesson)->format('d-m-Y')}}
                                    {{__('lesson.at')}}
                                    {{\Carbon\Carbon::parse($course->firstLesson->first_lesson)->format('H:i')}}
                                @else
                                   ( {{__('course.no_lesson')}} )
                                @endif
                            </b>
                        </h6>
                        <div class="form-group"></div>
                        <table class="table table-active">
                            <tr>
                                <th scope="row">{{__('lesson.type')}}</th>
                                <th scope="row">{{__('lesson.date_time')}}</th>
                                <th scope="row">{{__('lesson.number')}}</th>
                                <th scope="row">{{__('instructor.fullname')}}</th>

                                <th scope="row"></th>
                            </tr>
                            @foreach($course->lessons as $lesson)
                                @if(in_array($lesson->id,$lessonsId))
                                    <tr>
                                        <td>{{$lesson->course->type->description}}</td>
                                        <td>{{$lesson->date_time }}</td>
                                        <td>{{$lesson->number}}</td>
                                        <td>{{ $lesson->instructor->firstname }} {{ $lesson->instructor->lastname }}</td>
                                        <td>
                                            <form class="delete"
                                                  action="{{ route('members.removeMember', ['lessonLicenseMemberId' => $lesson->getLessonLicenseMemberIdByLicenseMemberId($licenseMember->id)]) }}"
                                                  method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger btn-xs btn-delete">
                                                    <i class="fa fa-trash-o" title="{{__('member.unsuscribe')}}"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    @endforeach
                @else
                    <div class="form-group"></div>
                    <div class="alert alert-warning">{{__('member.no_lesson')}}</div>
                @endif
                <div class="form-group">
                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i
                                class="fa fa-angle-double-left"></i>{{__('general.back')}}</a>
                    <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#coursesModal">
                        {{__('member.add_inscription')}}
                    </button>

                </div>
            </div>
        </div>
    </div>

    @include('admin.members.members_show_courses_modal')
@endsection
