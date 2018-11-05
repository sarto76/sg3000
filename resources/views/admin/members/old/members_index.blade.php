@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="panel-body">

            <div class="form-group">
            </div>
            <div class="pull-left">
                <a class="btn btn-success" href="{{ route('members.create') }}">{{__('member.add')}}</a>
            </div>

            <div class="form-group">
            </div>
            <table id="datatable-member" class="table table-hover table-bordered table-striped" name ="datatable">
                <thead>
                <th></th>
                <th>{{__('member.id')}}</th>
                <th>{{__('member.email')}}</th>
                <th>{{__('member.firstname')}}</th>
                <th>{{__('member.lastname')}}</th>
                <th>{{__('member.address')}}</th>
                <th>{{__('member.zip')}}</th>
                <th>{{__('member.city')}}</th>
                <th>{{__('member.phone')}}</th>
                <th>{{__('member.mobile')}}</th>
                <th>{{__('member.work')}}</th>
                <th>{{__('member.birthdate')}}</th>
                <th></th>

                </thead>
            </table>


        </div>
    </div>

@endsection
