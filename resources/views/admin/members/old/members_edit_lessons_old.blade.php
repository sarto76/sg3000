<div class="table-responsive" id="edit_licenses">
    @if (count($member->licenseMember) > 0)
        @foreach($member->licenseMember as $licenseMember)
            <div class="form-group"></div>
            <h5>
                {{__('license.category')}}
                {{ $licenseMember->license->description}}
            </h5>
            <div class="form-group"></div>
        <table class="table">
            <tr>
                <th scope="row">lessonLicenseMemberID</th>
                <th scope="row">course_id</th>
                <th scope="row">{{__('lesson.type')}}</th>
                <th scope="row">{{__('lesson.date_time')}}</th>
                <th scope="row">{{__('lesson.number')}}</th>
                <th scope="row">{{__('instructor.fullname')}}</th>

                <th scope="row"></th>
            </tr>
            @foreach($licenseMember->lessonLicenseMember as $lessonLicenseMember)
                <tr>
                    <td>{{$lessonLicenseMember->id}}</td>
                    <td>{{$lessonLicenseMember->lesson->course->id}}</td>
                    <td>{{$lessonLicenseMember->lesson->course->type->description}}</td>
                    <td>{{ $lessonLicenseMember->lesson->date_time }}</td>
                    <td>{{$lessonLicenseMember->lesson->number}}</td>
                    <td>{{ $lessonLicenseMember->lesson->instructor->firstname }} {{ $lessonLicenseMember->lesson->instructor->lastname }}</td>
                    <td>

                        <form class="delete" action="/admin/members/unsuscribe/{{ $lessonLicenseMember->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger btn-xs btn-delete" >
                                <i class="fa fa-trash-o" title="{{__('member.no_lesson')}}"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        @endforeach
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

