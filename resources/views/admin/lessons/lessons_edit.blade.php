@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="container-fluid">
            <h5>{{__('lesson.edit')}}</h5>
        </div>
    </div>
    <br>
    <div class="form-group">
    </div>
    <div class="container-fluid" id="main-wrapper">
        <!-- Start Page Content -->

            <div class="row">
                <div class="col-12">
                    <div class="panel panel-white">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist" id="tabMenu">
                                <li class="nav-item"><a class="nav-link active" href="#tab1" data-toggle="tab">{{__('lesson.detail')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab2" data-toggle="tab">{{__('lesson.members')}}</a></li>
                            </ul>
                                <div class="tab-content">
                                        <div class="tab-pane active" id="tab1" role="tabpanel">
                                            <form method="POST" action="{{ route('lessons.update', ['lesson' => $id]) }}" data-parsley-validate class="form-horizontal form-label-left">
                                                <p hidden id="maxMembers">{{$lesson->course->type->max_members}}</p>
                                                {{ csrf_field() }}
                                                <input name="_method" type="hidden" value="PUT">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>#{{$lesson->id}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">{{__('lesson.date_time')}}</th>
                                                            <td>
                                                                <div class="input-append date form_datetime ">
                                                                    <input size="16" type="text" value="{{ \Carbon\Carbon::parse($lesson->date_time)->format('d-m-Y h:i') }}" readonly id="date_time" name="date_time">
                                                                    <span class="add-on" id="dateTimePic"><i class="fa fa-calendar"></i></span>
                                                                    <div class="alert alert-danger" id="errorDateTime" style="display:none;"></div>
                                                                </div>


                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">{{__('lesson.number')}}</th>
                                                            <td>
                                                                <select name="number">
                                                                    @foreach ($availablesLessons as $number)
                                                                        <option value="{{ $number }}"
                                                                                @if ($number == $lesson->number)
                                                                                selected="selected"
                                                                                @endif
                                                                        >{{ $number }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">{{__('lesson.instructor')}}</th>
                                                            <td>{!! Form::select('instructor', $instructors, $lesson->instructor->id) !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">{{__('lesson.status')}}</th>
                                                            <td>{!! Form::select('status', $status, $lesson->status->id) !!}</td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <a href="{{ route('lessons.index',['type'=>$lesson->course->type->description]) }}#{{$lesson->course->id}}"class="btn btn-primary"><i class="fa fa-angle-double-left"></i>{{__('general.back')}}</a>&nbsp;

                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa"></i> {{__('lesson.update')}}
                                                </button>
                                            </form>
                                        </div>
                                    <div class="tab-pane" id="tab2" role="tabpanel">

                                        @if(count($lesson->LessonLicenseMember)>0)

                                                <div class="table-responsive">
                                                    <table class="table" id="actual-members">
                                                        <tr>
                                                            <th scope="row" ># {{__('member.id')}}</th>
                                                            <th scope="row" >{{__('member.nip')}}</th>
                                                            <th scope="row" >{{__('member.firstname')}}</th>
                                                            <th scope="row" >{{__('member.lastname')}}</th>
                                                            <th scope="row" >{{__('member.birthdate')}}</th>
                                                            <th scope="row" >{{__('member.phone')}}</th>
                                                            <th scope="row" >{{__('lesson.notes')}}</th>
                                                            <th scope="row" ></th>
                                                        </tr>
                                                        @foreach($lesson->LessonLicenseMember as $llm)
                                                            <tr>
                                                                <td scope="row" >{{$llm->licenseMember->member->id}}</td>
                                                                <td scope="row" >{{$llm->licenseMember->member->nip}}</td>
                                                                <td scope="row" >{{$llm->licenseMember->member->firstname}}</td>
                                                                <td scope="row" >{{$llm->licenseMember->member->lastname}}</td>
                                                                <td scope="row" >{{$llm->licenseMember->member->birthdate}}</td>
                                                                @if (!empty($llm->licenseMember->member->mobile))
                                                                    <td class="table-text"><div><a href="tel:{{ $llm->licenseMember->member->mobile }}">{{ $llm->licenseMember->member->mobile }}</a></div></td>
                                                                @else
                                                                    <td class="table-text"><div><a href="tel:{{ $llm->licenseMember->member->phone }}">{{ $llm->licenseMember->member->phone }}</a></div></td>
                                                                @endif
                                                                <td scope="row" >{{$llm->notes}}</td>
                                                                <td>
                                                                    <form class="delete" action="{{ route('lessons.removeMember', ['licenseMemberId' => $llm->id]) }}" method="POST">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('DELETE') }}
                                                                        <button class="btn btn-danger btn-xs btn-delete" >
                                                                            <i class="fa fa-trash-o" title="{{__('lesson.remove_member_from_lesson')}}"></i>
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                        @endforeach
                                                    </table>
                                                </div>



                                        @else
                                            <div class="form-group"></div>
                                            <div class="alert alert-warning">{{__('lesson.no_members')}}</div>
                                        @endif
                                            <a href="{{ route('lessons.index',['type'=>$lesson->course->type->description]) }}#{{$lesson->course->id}}"class="btn btn-primary"><i class="fa fa-angle-double-left"></i>{{__('general.back')}}</a>&nbsp;


                                            <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    data-toggle="modal"
                                                    data-target="#membersModal">
                                                {{__('lesson.addMember')}}
                                            </button>

                                            <div class="panel-body" id="allMembers" style="display: none;">

                                                <div class="form-group">
                                                </div>

                                                <hr>
                                                <div class="form-group">
                                                </div>
                                                <h6><b>{{__('member.list')}}</b></h6>
                                         {{-- @include('admin.lessons.lessons_members_direct') --}}
                                            </div>






                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>


    @include('admin.lessons.lessons_members_direct')

@endsection