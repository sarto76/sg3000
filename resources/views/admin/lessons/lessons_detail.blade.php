@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="container-fluid">
            <h5>{{__('lesson.detail')}}</h5>
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
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" href="#tab1" data-toggle="tab">{{__('lesson.detail')}}</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab2" data-toggle="tab">{{__('lesson.members')}}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1" role="tabpanel">
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
                                            <td>{{ $lesson->date_time }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('lesson.number')}}</th>
                                            <td>{{$lesson->number}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('lesson.instructor')}}</th>
                                            <td>{{$lesson->instructor->firstname}} {{$lesson->instructor->lastname}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('lesson.status')}}</th>
                                            <td>{{ $lesson->status->description }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('lesson.type')}}</th>
                                            <td>{{$lesson->course->type->description}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('lesson.num_members')}}</th>
                                            <td>{{count($lesson->LessonLicenseMember)}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2" role="tabpanel">

                                @if(count($lesson->LessonLicenseMember)>0)

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th scope="row" ># {{__('member.id')}}</th>
                                                    <th scope="row" >{{__('member.nip')}}</th>
                                                    <th scope="row" >{{__('member.firstname')}}</th>
                                                    <th scope="row" >{{__('member.lastname')}}</th>
                                                    <th scope="row" >{{__('member.birthdate')}}</th>
                                                    <th scope="row" >{{__('member.phone')}}</th>
                                                    <th scope="row" >{{__('lesson.notes')}}</th>
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

                                                @endforeach
                                            </table>
                                        </div>

                                @else
                                    <div class="form-group"></div>
                                    <div class="alert alert-warning">{{__('lesson.no_members')}}</div>
                                @endif

                            </div>
                            <div class="tab-pane" id="tab4" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table">

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <a href="{{ url()->previous()}}#{{$lesson->course->id}}"class="btn btn-primary"><i class="fa fa-angle-double-left"></i>{{__('general.back')}}</a>
        </div>
    </div>


@endsection