@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="">
        <div class="panel panel-default">
        @include('common.errors')

        <!-- New member Form -->
            <form action="/member" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Member Name -->
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Nome</label>

                    <div class="col-sm-6">
                        <input type="text" name="firstname" id="firstname" class="form-control">
                    </div>
                </div>

                <!-- Add Member Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i> Add Member
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if (count($members) > 0)
            <div class="panel-body">
                <div class="panel-heading">
                    Current Members
                </div>

                <div class="panel-body">
                    <table class="table table-striped member-table">

                        <!-- Table Headings -->
                        <thead>
                        <th>Member</th>
                        <th>&nbsp;</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $member->firstname }}</div>
                                </td>

                                <td>
                                    <form action="/member/{{ $member->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button>Delete Member</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    @endif
@endsection