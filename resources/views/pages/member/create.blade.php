@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="container">
        <div class="panel panel-default">
        @include('common.errors')

        <!-- New member Form -->
            <form action="{{ route('member.store') }}" method="POST" class="form-horizontal ">
            {{ csrf_field() }}


                <div class="col-xs-8">
                    <label for="email">{{__('member.email')}}</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="col-xs-8">
                    <label for="nome">{{__('member.firstname')}}</label>
                        <input type="text" name="nome" id="nome" class="form-control">
                </div>
                <div class="col-xs-8">
                        <label for="cognome">{{__('member.lastname')}}</label>
                        <input type="text" name="cognome" id="cognome" class="form-control">
                </div>

                <div class="col-xs-8">
                    <label for="indirizzo">{{__('member.address')}}</label>
                    <input type="text" name="indirizzo" id="indirizzo" class="form-control">
                </div>
                <div class="col-xs-8">
                    <label for="NAP">{{__('member.zip')}}</label>
                    <input type="text" name="NAP" id="NAP" class="form-control">
                </div>
                <div class="col-xs-8">
                    <label for="citta">{{__('member.city')}}</label>
                    <input type="text" name="citta" id="citta" class="form-control">
                </div>
                <div class="col-xs-8">
                    <label for="telefono">{{__('member.phone')}}</label>
                    <input type="text" name="telefono" id="telefono" class="form-control">
                </div>
                <div class="col-xs-8">
                    <label for="cellulare">{{__('member.mobile')}}</label>
                    <input type="text" name="cellulare" id="cellulare" class="form-control">
                </div>
                <div class="col-xs-8">
                    <label for="lavoro">{{__('member.work')}}</label>
                    <input type="text" name="lavoro" id="lavoro" class="form-control">
                </div>
                <div class="col-xs-8">
                    <label for="nascita">{{__('member.birthdate')}}</label>
                    <input type="text" name="nascita" id="nascita" class="form-control">
                </div>

                <div class="form-group">
                </div>





                <!-- Add Member Button -->
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i> {{__('member.add')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>



@endsection