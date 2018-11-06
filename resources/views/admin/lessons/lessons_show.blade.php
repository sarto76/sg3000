@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="container-fluid">
            <h5>{{__('lesson.list').' '.$typ}}</h5>
        </div>
    </div>
    <div class="form-group">
    </div>
    <div class="container-fluid">
        <div class="search p bg-light m-b-sm">
            <form method="GET" action="{{ route('lessons.search') }}">
                @csrf
                <div class="input-group">
                    <input name="search" class="form-control input-search" type="text" placeholder="{{__('lesson.search')}}" value="{{ app('request')->input('search') }}">
                    <span class="input-group-btn">
                     <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
        @if (count($courses) > 0)


                <div class="form-group">
                </div>
                <div >
                    <a class="btn btn-success" href="{{ route('lessons.create') }}">{{__('lesson.add')}}</a>
                </div>


                    <div class="form-group">
                    </div>

                @foreach ($courses as $course)
                @if (count($course->lessons) > 0)
                    <h5>{{__('lesson.course').' '.$course->type->description}}</h5>

                    <div class="row">
                        @foreach ($course->lessons->sortBy('number') as $lesson)

                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{__('lesson.lesson')}} {{__('lesson.number')}} {{$lesson->number}}</h5>
                                        <h5 class="card-title">{{$lesson->id}}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{\Carbon\Carbon::parse($lesson->date_time)->format('d-m-Y H:i') }}</h6>
                                        <p>{{__('instructor.instructor')}}: {{$lesson->instructor->firstname }} {{$lesson->instructor->lastname }}</p>
                                        <p style="font-size: smaller">{{__('lesson.remaining_places')}}
                                        @if(count($lesson->LessonLicenseMember)<($course->type->max_members/2))
                                            <span class="badge badge-pill badge-success">{{count($lesson->LessonLicenseMember) }}/{{$course->type->max_members }}</span>
                                                @elseif(count($lesson->LessonLicenseMember)<($course->type->max_members))
                                                <span class="badge badge-pill badge-warning">{{count($lesson->LessonLicenseMember) }}/{{$course->type->max_members }}</span>
                                            @elseif(count($lesson->LessonLicenseMember)==($course->type->max_members))
                                                <span class="badge badge-pill badge-danger">{{count($lesson->LessonLicenseMember) }}/{{$course->type->max_members }}</span>
                                        @endif
                                        </p>
                                            <a href="/admin/members/{{ $lesson->id }}" class="btn btn-info btn-xs"><i class="fa fa-eye" title="{{__('lesson.show')}}"></i></a>
                                            <a href="/admin/members/{{ $lesson->id }}/edit" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="{{__('lesson.edit')}}"></i></a>

                                            <form action="/admin/lessons/{{ $lesson->id }}" method="POST" style="display:inline;margin:0px;padding:0px;">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger btn-xs btn-delete" >
                                                    <i class="fa fa-trash-o" title="{{__('lesson.delete')}}"></i>
                                                </button>
                                            </form>


                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                    </div>
                    <hr>
                @endif
                @endforeach



            <div class="pull-right align-bottom">
                {{ $courses->appends(request()->input())->links() }}
            </div>
                </div>


    </div>


    @endif

@endsection