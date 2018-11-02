@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="search p bg-light m-b-sm">
            <form method="GET" action="{{ route('lessons.search') }}">
                @csrf
                <div class="input-group">
                    <input name="search" class="form-control input-search" type="text" placeholder="{{__('lessons.search')}}" value="{{ app('request')->input('type') }}">

                </div>
                <div class="input-group">
                    <input name="search" class="form-control input-search" type="text" placeholder="{{__('lessons.search')}}" value="{{ app('request')->input('search') }}">
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
                    <a class="btn btn-success" href="{{ route('lessons.create') }}">{{__('lessons.add')}}</a>
                </div>
                <div class="table-responsive">

                    <div class="form-group">
                    </div>
                        <table class="table table-striped responsive-table" id="datatable-member">

                            <!-- Table Headings -->
                            <thead>
                            <th>{{__('lesson.lessons')}}</th>
                            <th>{{__('lesson.lessons')}}</th>
                            <th>{{__('lesson.lessons')}}</th>

                            </thead>

                            <!-- Table Body -->
                            <tbody>
                            @foreach ($lessons as $lesson)
                                <tr>
                                    <td class="table-text"><div>{{ $lesson->course }}</div></td>
                                    <td class="table-text"><div>{{ $lesson->number }}</div></td>
                                    <td class="table-text"><div>{{ $lesson->date_time }}</div></td>
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