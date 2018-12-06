<div class="container-fluid">
    <div class="panel panel-default p-3 mb-2 bg-light text-dark">
        @include('common.errors')
        <div class="table-responsive" id="edit_licenses">
            @if (count($member->licenses) > 0)
                <table class="table">
                    <tr>
                        <th scope="row">{{__('license.description')}}</th>
                        <th scope="row">{{__('license.long_description')}}</th>
                        <th scope="row">{{__('license.month_duration')}}</th>
                        <th scope="row">{{__('license.valid_from')}}</th>
                        <th scope="row"></th>
                        <th scope="row"></th>
                        <th scope="row"></th>
                    </tr>
                    @foreach($member->licenseMember as $licenseMember)
                        <tr>
                            <td>{{$licenseMember->license->description}}</td>
                            <td>{{$licenseMember->license->long_description}}</td>
                            <td>{{$licenseMember->license->month_duration}}</td>
                            <td>{{ $licenseMember->valid_from }}</td>
                            <td>
                                <a href="{{ route('members.editLessonInscription', ['licenseMemberId' => $licenseMember->id]) }}"
                                   class="btn btn-primary">
                                    <i class="fa"></i> {{__('member.edit__lesson_inscription')}}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('members.editLicense', ['licenseMemberId' => $licenseMember->id]) }}"
                                   class="btn btn-info btn-xs edit"><i class="fa fa-pencil"
                                                                       title="{{__('license.edit')}}"></i></a>
                            <td>
                                <form class="delete" action="{{ route('members.removeLicense',['member'=>$licenseMember->id]) }}"
                                      method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-xs btn-delete">
                                        <i class="fa fa-trash-o" title="{{__('license.delete')}}"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <div class="form-group"></div>
                <div class="alert alert-warning">{{__('member.no_license')}}</div>
            @endif
            <div class="form-group">
                <a href="{{ url()->previous() }}" class="btn btn-primary"><i
                            class="fa fa-angle-double-left"></i>{{__('general.back')}}</a>
                <a href="{{ route('members.addLicense', ['memberId' => $member->id]) }}" class="btn btn-primary">
                    <i class="fa"></i> {{__('member.addLicense')}}
                </a>

            </div>
        </div>
    </div>
</div>
