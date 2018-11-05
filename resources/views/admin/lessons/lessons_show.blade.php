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
        @if (count($lessons) > 0)
            <div class="panel-body">

                <div class="form-group">
                </div>
                <div class="pull-left">
                    <a class="btn btn-success" href="{{ route('lessons.create') }}">{{__('lesson.add')}}</a>
                </div>
                <div class="table-responsive">

                    <div class="form-group">
                    </div>
                        <table class="table table-striped responsive-table" id="datatable-member">

                            <!-- Table Headings -->
                            <thead>
                            <th>{{__('lesson.id')}}</th>
                            <th>{{__('lesson.course')}}</th>
                            <th>{{__('lesson.date_time')}}</th>
                            <th>{{__('lesson.number')}}</th>
                            <th>{{__('lesson.type')}}</th>
                            <th>{{__('lesson.status')}}</th>

                            </thead>

                            <!-- Table Body -->
                            <tbody>
                            @foreach ($lessons as $lesson)
                                <tr>
                                    <td class="table-text"><div>#{{ $lesson->id }}</div></td>
                                    <td class="table-text"><div>{{ $lesson->course }}</div></td>
                                    <td class="table-text"><div>{{ \Carbon\Carbon::parse($lesson->date_time)->format('d-m-Y H:i') }}</div></td>
                                    <td class="table-text"><div>{{ $lesson->number }}</div></td>
                                    <td class="table-text"><div>{{ $lesson->type }}</div></td>
                                    <td class="table-text"><div>{{ $lesson->status }}</div></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    <div class="pull-right align-bottom">
                        {{ $lessons->links() }}
                    </div>
                </div>
            </div>
    </div>
    @endif

@endsection