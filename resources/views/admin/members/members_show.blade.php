@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="container-fluid">
            <h5>{{__('member.list')}}</h5>
        </div>
        <div class="form-group">
        </div>
    </div>
    <div class="container-fluid">
        <div class="search p bg-light m-b-sm">
            <form method="GET" action="{{ route('members.search') }}">
                @csrf
                <div class="input-group">
                    <input name="search" class="form-control input-search" type="text" placeholder="{{__('member.search')}}" value="{{ app('request')->input('search') }}">
                    &nbsp;
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div><!-- Input Group -->
            </form><!-- Search Form -->
        </div>
        @if (count($members) > 0)
            <div class="panel-body">

                <div class="form-group">
                </div>
                <div class="pull-left">
                    <a class="btn btn-success" href="{{ route('members.create') }}">{{__('member.add')}}</a>
                </div>
                <div class="table-responsive">

                    <div class="form-group">
                    </div>
                        <table class="table table-striped responsive-table" id="dt">

                            <!-- Table Headings -->
                            <thead>
                            <th>{{__('member.lastname')}}</th>
                            <th>{{__('member.firstname')}}</th>
                            <th>{{__('member.address')}}</th>
                            <th>{{__('member.zip')}}</th>
                            <th>{{__('member.city')}}</th>
                            <th>{{__('member.phone')}}</th>
                            <th>&nbsp;</th>
                            <th></th>
                            <th></th>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td class="table-text"><div>{{ $member->lastname }}</div></td>
                                    <td class="table-text"><div>{{ $member->firstname }}</div></td>
                                    <td class="table-text"><div>{{ $member->address }}</div></td>
                                    <td class="table-text"><div>{{ $member->zip }}</div></td>
                                    <td class="table-text"><div>{{ $member->city }}</div></td>
                                    @if (!empty($member->mobile))
                                        <td class="table-text"><div><a href="tel:{{ $member->mobile }}">{{ $member->mobile }}</a></div></td>
                                    @else
                                     <td class="table-text"><div><a href="tel:{{ $member->phone }}">{{ $member->phone }}</a></div></td>
                                    @endif
                                    <td>
                                        <a href="{{ route('members.show',['member'=>$member->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-eye" title="{{__('member.show')}}"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('members.edit',['member'=>$member->id]) }}" class="btn btn-info btn-xs edit"><i class="fa fa-pencil" title="{{__('member.edit')}}"></i></a>
                                    </td>
                                    <td>
                                        <form class="delete" action="{{ route('members.destroy',['member'=>$member->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-danger btn-xs btn-delete" >
                                                <i class="fa fa-trash-o" title="{{__('member.delete')}}"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    <div class="pull-right align-bottom">
                        {{ $members->links() }}
                    </div>
                </div>
            </div>
    </div>
    @endif

@endsection