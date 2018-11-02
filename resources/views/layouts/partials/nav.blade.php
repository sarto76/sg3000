<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">{{__('navigation.title')}}</a>
    <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class=" {{Request::is('/')? 'nav-link active' : 'nav-link'}}" href="/home">{{__('navigation.home')}}</a>
                </li>
                <li class="nav-item">
                    <a class="{{Request::is('lesson')? 'nav-link active' : 'nav-link'}}" href="{{route('lessons.index')}}">{{__('navigation.courses')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">{{__('navigation.socc')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#team">{{__('navigation.sens')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">{{__('navigation.moto')}}</a>
                </li>
                <li class="nav-item">
                    <a class="{{Request::is('member')? 'nav-link active' : 'nav-link'}}" href="{{route('members.index')}}">{{__('navigation.all')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">{{__('navigation.stat')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">{{__('navigation.ann')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">{{__('navigation.setup')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">{{__('navigation.logout')}}</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>
<div class="form-group">
</div>