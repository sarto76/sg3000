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
            <form method="GET" action="{{ route('lessons.search',['type'=>$typ]) }}">
                @csrf
                <div class="input-group">
                    <input name="search" class="form-control" type="text" placeholder="{{__('lesson.search')}}" value="{{ app('request')->input('search') }}">
                    &nbsp;
                    <span class="input-group-btn">
                     <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div>

        @if (count($courses) > 0)


                <div class="form-group">
                </div>
                    <div class="form-group">
                    </div>

                @foreach ($courses as $course)
                @if (count($course->lessons) > 0)

                    <button class="btn btn-lg" type="button" data-toggle="collapse" data-target="#{{$course->id}}" aria-expanded="false" aria-controls="multiCollapseExample2"
                            style="display:inline;margin:0px;padding:0px;" title="{{__('general.expand')}}">
                    <i class="fa fa-caret-square-o-down coll"></i>
                    </button>
                    <h6 style="display:inline;margin:0px;padding:0px;"><b>&nbsp;

                            <div class="pull-right">
                            <i class="fa fa-circle" aria-hidden="true" style="color:{{$course->status->color}};" title="{{$course->status->description}}"></i>
                            </div>
                            #{{$course->id}}
                            {{__('lesson.course').' '.$course->type->description}}
                            {{__('lesson.of')}}
                            {{\Carbon\Carbon::parse($course->firstLesson->first_lesson)->format('d-m-Y')}}
                            {{__('lesson.at')}}
                            {{\Carbon\Carbon::parse($course->firstLesson->first_lesson)->format('H:i')}}
                        </b>
                    </h6>
                    <div class="form-group">
                    </div>
                    <div class="collapse multi-collapse" id="{{$course->id}}">
                        <div class="row">
                            @foreach ($course->lessons->sortBy('number') as $lesson)
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">#{{$lesson->id}}</h6>
                                            <h6 class="card-title">{{__('lesson.lesson')}} {{__('lesson.number')}} {{$lesson->number}}</h6>
                                            <h7 class="card-subtitle mb-2 text-muted">{{\Carbon\Carbon::parse($lesson->date_time)->format('d-m-Y H:i') }}</h7>
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
                                                <a href="/admin/lessons/{{ $lesson->id }}" class="btn btn-info btn-xs"><i class="fa fa-eye" title="{{__('lesson.show')}}"></i></a>
                                                <a href="/admin/lessons/{{ $lesson->id }}/edit" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="{{__('lesson.edit')}}"></i></a>

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

                                <div class="pull-right" style="display:inline;margin:2px;padding:2px;">

                                    <a class="btn btn-success" href="{{ route('lessons.create',['idCourse'=>$course->id,'type'=>$typ]) }}"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                </div>
                        </div>
                    </div>
                    <div class="form-group">
                    </div>
                    <hr>
                @endif
                @endforeach



            <div class="pull-right align-bottom">
                {{ $courses->appends(['typ' => $typ])->links() }}
            </div>

    </div>

    @else
        <div class="form-group">
        </div>
        <div class="clearfix"></div>
        <div class="alert alert-info timerHide" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{__('lesson.not_found')}}
        </div>
        <div class="form-group">
        </div>
    @endif



@endsection