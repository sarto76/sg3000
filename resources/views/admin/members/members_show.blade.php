@extends('layouts.app')

@section('content')

    <div class="container">
        @if (count($members) > 0)
            <div class="panel-body">

                <div class="form-group">
                </div>
                <div class="pull-left">
                    <a class="btn btn-success" href="{{ route('member.create') }}">{{__('member.add')}}</a>
                </div>
                <div class="table-responsive">

                    <div class="form-group">
                    </div>

                    <table class="table table-striped" id="datatable-member" name ="datatable">

                        <!-- Table Headings -->
                        <thead>
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

                        <th>&nbsp;</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td class="table-text"><div>{{ $member->email }}</div></td>
                                <td class="table-text"><div>{{ $member->firstname }}</div></td>
                                <td class="table-text"><div>{{ $member->lastname }}</div></td>
                                <td class="table-text"><div>{{ $member->address }}</div></td>
                                <td class="table-text"><div>{{ $member->zip }}</div></td>
                                <td class="table-text"><div>{{ $member->city }}</div></td>
                                <td class="table-text"><div>{{ $member->phone }}</div></td>
                                <td class="table-text"><div>{{ $member->mobile }}</div></td>
                                <td class="table-text"><div>{{ $member->work }}</div></td>
                                <td class="table-text"><div>{{ $member->birthdate }}</div></td>

                                <td>
                                    <form action="/member/{{ $member->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button>{{__('member.delete')}}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    <div class="pull-right align-bottom">
                        {-- !!  $members->links()  !! --}
                    </div>

                </div>
            </div>
    </div>
    @endif

@endsection