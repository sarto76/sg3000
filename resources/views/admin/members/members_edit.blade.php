@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="container-fluid">
            <h5>{{__('member.edit')}}</h5>
        </div>
    </div>
    <div class="form-group">
    </div>
    <div class="container-fluid">
        @include('common.errors')
        <div class="row">
            <div class="col-12">
                <div class="panel panel-white">
                    <div class="form-group"></div>
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" href="#tab1"
                                                    data-toggle="tab">{{__('member.details')}}</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab2"
                                                    data-toggle="tab">{{__('member.licenses')}}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1" role="tabpanel">
                                <div class="panel panel-default p-3 mb-2 bg-light text-dark">
                                    <div class="form-group"></div>
                                    {!! Form::model($member, ['method' => 'PUT','route' => ['members.update', $member->id]]) !!}
                                    @include('admin.members.members_form', ['submitButtonText' => __('member.edit')])
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2" role="tabpanel">
                                @include('admin.members.members_edit_licenses')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection