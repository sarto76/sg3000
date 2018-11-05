@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="container-fluid">
            <h5>{{__('member.detail')}}</h5>
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
                            <li class="nav-item"><a class="nav-link active" href="#tab1" data-toggle="tab">{{__('member.details')}}</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab2" data-toggle="tab">{{__('member.licenses')}}</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab3" data-toggle="tab">{{__('member.courses')}}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>#{{$member->id}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{__('member.nip')}}</th>
                                            <td>{{$member->nip}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('member.firstname')}}</th>
                                            <td>{{$member->firstname}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('member.lastname')}}</th>
                                            <td>{{$member->lastname}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('member.birthdate')}}</th>
                                            <td>{{ \Carbon\Carbon::parse($member->birthdate)->format('d-m-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('member.email')}}</th>
                                            <td>{{$member->email}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('member.address')}}</th>
                                            <td>{{$member->address}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('member.city')}}</th>
                                            <td>{{$member->zip}} {{$member->city}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('member.phone')}}</th>
                                            <td>{{$member->phone}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('member.mobile')}}</th>
                                            <td>{{$member->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__('member.work')}}</th>
                                            <td>{{$member->work}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2" role="tabpanel">
                                <div class="table-responsive">
                                    @if (count($member->licenses) > 0)
                                        <table class="table">
                                            <tr>
                                                <th scope="row" >{{__('member.license_description')}}</th>
                                                <th scope="row" >{{__('member.license_long_description')}}</th>
                                                <th scope="row" >{{__('member.license_valid_from')}}</th>
                                            </tr>
                                            @foreach($member->licenses as $license)
                                                <tr>
                                                    <td>{{\App\Models\LicenseType::find($license->license_type_id)->description}}</td>
                                                    <td>{{\App\Models\LicenseType::find($license->license_type_id)->long_description}}</td>
                                                    <td>{{ \Carbon\Carbon::parse($license->pivot->valid_from)->format('d-m-Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <div class="form-group"></div>
                                        <div class="alert alert-warning">{{__('member.no_license')}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table">
                                        <table class="table">
                                            <tr>
                                                <th scope="row" >{{__('member.license_description')}}</th>
                                                <th scope="row" >{{__('member.license_long_description')}}</th>
                                                <th scope="row" >{{__('member.license_valid_from')}}</th>
                                            </tr>
                                            @foreach($member->licenses as $license)
                                                <tr>

                                                </tr>
                                            @endforeach
                                        </table>

                                    </table>
                                </div>
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


            <a href="{{ url()->previous() }}"class="btn btn-primary"><i class="fa fa-angle-double-left"></i>{{__('general.back')}}</a>
        </div>
    </div>


@endsection